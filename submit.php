<?php
require_once 'app/Database.php';
require_once 'app/Application.php';
require_once 'app/Mailer.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $level = htmlspecialchars($_POST['level']);

    // Перевірка коректності електронної пошти
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Невірний формат електронної пошти!';
        $_SESSION['success'] = 0;
        header('Location: /');
        exit;
    }

    $db = new Database();
    $application = new Application($db->getConnection());

    // Генерація унікального коду підтвердження
    $verification_code = md5(uniqid(rand(), true));

    // Збереження заявки з кодом підтвердження (статус "не підтверджено")
    if ($application->saveApplication($name, $email, $level, $verification_code)) {
        $mailer = new Mailer();
        $verification_link = "https://favorite-english.com/verify?code=$verification_code";
        $mailer->sendVerificationEmail($email, $verification_link);

        $_SESSION['message'] = 'Будь ласка, перевірте свою електронну пошту для підтвердження!';
        $_SESSION['success'] = 1;
    }

    header('Location: /');
    exit;
} 
else 
{
    header('Location: /');
    exit;
}