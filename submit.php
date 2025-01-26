<?php
require_once 'app/Database.php';
require_once 'app/Application.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $level = htmlspecialchars($_POST['level']);

    $db = new Database();
    $application = new Application($db->getConnection());

    $application->saveApplication($name, $email, $level);
    
    $botToken = "6997983154:AAGstWEtEw-Z_dv-zV5qIyWTl9AF3YCfvko";
    $chatId = "-1002019592901";

    $message = "✅ *Нова заявка*!\n➖➖➖➖➖➖➖➖➖➖➖\n\n";
    $message .= "*Ім'я*: $name\n";
    $message .= "*Email*: $email\n";
    $message .= "*Рівень*: $level";

    $url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message) . "&parse_mode=Markdown";

    file_get_contents($url);

    $_SESSION['message'] = 'Анкета успішно надіслана!';
    header('Location: /');
}
else
{
    header('Location: /');
}