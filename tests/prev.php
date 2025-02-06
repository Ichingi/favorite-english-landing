<?php
session_start();
require_once "../app/Database.php";

$db = new Database();
$conn = $db->getConnection();

if (isset($_SESSION['question_number']) && $_SESSION['question_number'] > 0) {
    $_SESSION['question_number'] -= 1;
}

header("Location: /tests/index.php");
exit();