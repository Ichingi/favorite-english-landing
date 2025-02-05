<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Зареєструйся на курс до відкриття школи та отримай знижку 15%">
    <meta name="keywords" content="Англійська,Англійська мова,Курси з Англійської мови,Курси">
    <meta name="author" content="Favorite English">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Favorite English — подача заявки</title>

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
                <h2 class="tests__top-item">Тест на рівень англійської мови</h2>
                <span class="tests__top-item">3 / 20</span>
            </div>
            <div class="tests__main">
                <h3 class="tests__question">I _______ from Spain.</h3>
                <div class="tests__answers">
                    <div class="tests__answer">Is</div>
                    <div class="tests__answer">Are</div>
                    <div class="tests__answer">Am</div>
                </div>
                <div class="buttons">
                    <a href="" class="button mini-btn transparent-btn">Назад</a>
                    <a href="" class="button mini-btn ">Далі</a>
                </div>
            </div>
        </main>
    </div>
    <footer>Favorite English 2025</footer>
    <script src="/js/tests.js" defer></script>
</body>

</html>