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
    
    $_SESSION['message'] = 'Анкета успішно надіслана!';
    header('Location: index.html');
}
else
{
    header('Location: index.html');
}