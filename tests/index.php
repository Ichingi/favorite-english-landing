<?php
    session_start();
    require_once "../app/Database.php";

    $db = new Database();
    $conn = $db->getConnection();

    $total_questions_query = $conn->query("SELECT COUNT(*) FROM tests");
    $total_questions = $total_questions_query->fetchColumn();
    $_SESSION['total_questions'] = $total_questions;

    if (!isset($_SESSION['question_number'])) 
    {
        $_SESSION['question_number'] = 0;
    }
    $question_number = $_SESSION['question_number'];

    $query = $conn->prepare("SELECT * FROM tests ORDER BY difficulty ASC, id ASC LIMIT 1 OFFSET :offset");
    $query->bindValue(":offset", $question_number, PDO::PARAM_INT);
    $query->execute();
    $test = $query->fetch(PDO::FETCH_ASSOC);

    if (!$test) 
    {
        $_SESSION['question_number'] = 0;
        header("Location: /tests/result.php");
        exit();
    }

    $answers = json_decode($test['answers'], true) ?: [];
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Зареєструйся на курс до відкриття школи та отримай знижку 15%">
    <meta name="keywords" content="Англійська, Англійська мова, Курси з Англійської мови, Курси">
    <meta name="author" content="Favorite English">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Favorite English — Тест</title>

    <link rel="stylesheet" href="/styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="content tests-page">
        <div class="container">
            <header>
                <nav>
                    <a href="/" class="logo">
                        <img src="/images/logo.svg" loading="lazy" alt="Logo" width="76" height="76">
                        <span>FAVORITE ENGLISH <span class="grey small-text">( на головну )</span></span>
                    </a>
                    <div class="socials">
                        <a href="https://www.instagram.com/favorite.english.school/">
                            <img src="/images/Instagram.svg" alt="Instagram" width="35" height="36">
                        </a>
                        <a href="https://www.tiktok.com/@favorite.english.school">
                            <img src="/images/TikTok.svg" alt="TikTok" width="35" height="36">
                        </a>
                    </div>
                </nav>
            </header>
        </div>
        
        <div style="width: -10%; position: relative">
            <span class="bg-circle"></span>
            <span class="bg-circle__red" style="background-color: #a138d236"></span>
        </div>

        <main class="tests">
            <div class="tests__top">
                <h2 class="tests__top-item">Тест на рівень англійської</h2>
                <span class="tests__top-item"><?= $question_number + 1 ?> / <?= $total_questions ?></span>
            </div>
            <div class="tests__main">
                <h3 class="tests__question"><?= htmlspecialchars($test['question']) ?></h3>
                <form action="/tests/check.php" method="POST" class="tests__answers">
                    <?php foreach ($answers as $key => $answer): ?>
                        <label class="tests__answer">
                            <input type="radio" name="answer" value="<?= $key ?>" required>
                            <?= htmlspecialchars($answer) ?>
                        </label>
                    <?php endforeach; ?>
                    <input type="hidden" name="question_id" value="<?= $test['id'] ?>">
                    <div class="buttons">
                        <a href="/tests/prev.php" class="button mini-btn transparent-btn">Назад</a>
                        <button type="submit" class="button mini-btn">Далі</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    
    <footer>Favorite English 2025</footer>
    <script src="/js/tests.js" defer></script>
</body>
</html>