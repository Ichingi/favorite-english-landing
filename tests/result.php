<?php
session_start();

$score = $_SESSION['correct_answers'] ?? 0;
$total = $_SESSION['total_questions'] ?? 0;

if ($score < 10) {
    $level = "Beginner (A1)";
} elseif ($score < 20) {
    $level = "Elementary (A2)";
} elseif ($score < 30) {
    $level = "Pre-Intermediate (B1)";
} elseif ($score < 40) {
    $level = "Intermediate (B2)";
} elseif ($score < 50) {
    $level = "Upper Intermediate (C1)";
} else {
    $level = "Advanced (C2)";
}

session_destroy();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Favorite English">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Favorite English — результати тесту</title>

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
                    <div class="logo">
                        <img src="/images/logo.svg" loading="lazy" alt="Logo" style="width: 76px; height: 76px;">
                        <span>FAVORITE ENGLISH</span>
                    </div>
                    <div class="socials">
                        <a href="https://www.instagram.com/favorite.english.school/"><img src="/images/Instagram.svg" alt="Instagram" style="width: 35px; height: 36px;"></a>
                        <a href="https://www.tiktok.com/@favorite.english.school"><img src="/images/TikTok.svg" alt="TikTok" style="width: 35px; height: 36px;"></a>
                    </div>
                </nav>
            </header>
        </div>
        <div style="width: -10%;position: relative">
            <span class="bg-circle"></span>
            <span class="bg-circle__red" style="background-color: #a138d236"></span>
        </div>
        <main class="tests">
            <div class="tests__top">
                <h2 class="tests__top-item">Тест на рівень англійської</h2>
            </div>
            <div class="tests__main">
                <p>Ваш орієнтовний рівень володіння англійською мовою: <?= $level ?></p>
                <a href="/tests" class="button">Пройти знову</a>
            </div>
        </main>
    </div>
    <footer>Favorite English 2025</footer>
    <script src="/js/tests.js" defer></script>
</body>

</html>