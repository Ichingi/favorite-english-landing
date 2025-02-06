<?php
session_start();
require_once "../app/Database.php";

$db = new Database();
$conn = $db->getConnection();

$question_id = $_POST['question_id'];
$user_answer = $_POST['answer'];

$query = $conn->prepare("SELECT correct_answer, difficulty FROM tests WHERE id = :id");
$query->execute(['id' => $question_id]);
$question = $query->fetch(PDO::FETCH_ASSOC);

if ($question) 
{
    if ((int)$user_answer === (int)$question['correct_answer']) 
    {
        $_SESSION['correct_answers'] += $question['difficulty'];
    }
}

$_SESSION['question_number']++;

if ($_SESSION['question_number'] >= $_SESSION['total_questions']) 
{
    header("Location: /tests/result.php");
    exit();
}

header("Location: /tests/");
