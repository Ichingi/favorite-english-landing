<?php
require_once '../app/Database.php';
require_once '../app/Application.php';

session_start();

$verification_code = $_GET['code'] ?? '';

if (!empty($verification_code)) {
    if (preg_match('/^[a-zA-Z0-9]{6,}$/', $verification_code)) {
        $db = new Database();
        $application = new Application($db->getConnection());

        if ($application->verifyEmail($verification_code)) {
            $_SESSION['message'] = 'Ваша електронна пошта успішно підтверджена!';
            $_SESSION['success'] = 1;
        } else {
            $_SESSION['message'] = 'Невірний код підтвердження!';
            $_SESSION['success'] = 0;
        }
    } else {
        $_SESSION['message'] = 'Невірний формат коду підтвердження!';
        $_SESSION['success'] = 0;
    }
} else {
    $_SESSION['message'] = 'Код підтвердження відсутній!';
    $_SESSION['success'] = 0;
}

header('Location: /');