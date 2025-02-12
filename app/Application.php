<?php
class Application
{
    private $conn;
    private $telegramToken = '';
    private $chatId = '';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function saveApplication($name, $email, $level, $verification_code)
    {
        // Перевірка чи є така пошта в базі
        $status = $this->checkEmailStatus($email);

        if ($status === 'confirmed') {
            $_SESSION['message'] = 'Ця електронна пошта вже зареєстрована.';
            $_SESSION['success'] = 0;
            return false;
        } elseif ($status === 'pending') {
            $_SESSION['message'] = 'Ця електронна пошта не підтверджена. Перевірте свій email та перейдіть за посиланням у листі для підтвердження.';
            $_SESSION['success'] = 0;
            return false;
        }

        $query = "INSERT INTO applications (name, email, level, verification_code, status) VALUES (:name, :email, :level, :verification_code, 'pending')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':verification_code', $verification_code);

        if ($stmt->execute()) {
            $this->sendToTelegram($name, $email, $level);
            return true;
        }
        
        return false;
    }

    private function sendToTelegram($name, $email, $level)
    {
        $message = "✅ *Нова заявка*! \n";
        $message .= "➖➖➖➖➖➖➖➖➖➖➖\n\n";
        $message .= "*Ім'я*: $name\n";
        $message .= "*Email*: $email\n";
        $message .= "*Рівень*: $level";

        $url = "https://api.telegram.org/bot{$this->telegramToken}/sendMessage";
        $data = [
            'chat_id' => $this->chatId,
            'text' => $message,
            'parse_mode' => 'Markdown'
        ];

        file_get_contents($url . "?" . http_build_query($data));
    }

    public function checkEmailStatus($email)
    {
        $query = "SELECT status FROM applications WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $status = $stmt->fetchColumn();
        
        return $status ?: false;
    }

    public function verifyEmail($verification_code)
    {
        $query = "UPDATE applications SET status = 'confirmed' WHERE verification_code = :verification_code";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':verification_code', $verification_code);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }

    public function emailExists($email)
    {
        $query = "SELECT COUNT(*) FROM applications WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}
