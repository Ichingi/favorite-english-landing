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

    public function saveApplication($name, $email, $level)
    {
        $query = "INSERT INTO applications (name, email, level) VALUES (:name, :email, :level)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':level', $level);

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
}