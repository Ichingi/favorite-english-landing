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

    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="content">
        <div class="container">
            <header>
                <nav>
                    <div class="logo">
                        <img src="images/logo.svg" loading="lazy" alt="Logo" style="width: 76px; height: 76px;">
                        <span>FAVORITE ENGLISH</span>
                    </div>
                    <div class="socials">
                        <a href="https://www.instagram.com/favorite.english.school/"><img src="images/Instagram.svg" alt="Instagram" style="width: 35px; height: 36px;"></a>
                        <a href="https://www.tiktok.com/@favorite.english.school"><img src="images/TikTok.svg" alt="TikTok" style="width: 35px; height: 36px;"></a>
                    </div>
                </nav>
            </header>
            <main>
                <span class="bg-circle"></span>
                <span class="bg-circle__red"></span>
                <div class="main-content">
                    <div class="info">
                        <h1 class="main-content__title">
                            Почни новий рік з вивчення <br>
                            англійської мови
                        </h1>
                        <p class="main-content__subtitle">
                            Зареєструйся на курс до відкриття школи <br>
                            та отримай знижку
                        </p>
                        <div class="main__button">
                            <?php
                                if (isset($_SESSION['message']))
                                {
                                    ?>
                                        <span><?= $_SESSION['message'] ?></span>
                                    <?php
                                    $_SESSION['message'] = null;
                                }
                            ?>
                            <button onclick="openModal('getDiscount')" class="button btn-adaptive info-button">Отримати знижку 15%</button>
                        </div>
                    </div>
                    <div class="character">
                        <img src="images/character.png" loading="lazy" alt="Character">
                    </div>
                </div>
            </main>
        </div>
        <section class="slider">
            <div class="slider-track">
                <div class="slide">
                    <div class="slide__content">
                        <img src="images/work.svg" loading="lazy" alt="Work" style="width: 29px; height: 30px;">
                        <span class="slide__title"> Англійська для роботи</span>
                    </div>
                    <p class="slide__subtitle">Опануєш ділову лексику, зможеш читати англомовні джерела та легко
                        порозумієшся з іноземними колегами</p>
                </div>
                <div class="slide">
                    <div class="slide__content">
                        <img src="images/speak.svg" loading="lazy" alt="Speak" style="width: 26px; height: 26px;">
                        <span class="slide__title">Розмовний курс</span>
                    </div>
                    <p class="slide__subtitle">Мінімум теорії, максимум практики та a bunch of topics на будь-який випадок.
                        Все це допоможе швидко подолати мовний бар’єр</p>
                </div>
                <div class="slide">
                    <div class="slide__content">
                        <img src="images/chick.svg" loading="lazy" alt="Chick" style="width: 28px; height: 28px;">
                        <span class="slide__title">Англійська для початківців</span>
                    </div>
                    <p class="slide__subtitle">База-основа-фундамент, щоб опанувати базову граматику та підтримувати прості
                        побутові розмови</p>
                </div>
                <div class="slide">
                    <div class="slide__content">
                        <img src="images/image 16.svg" loading="lazy" alt="Tree" style="width: 28px; height: 29px;">
                        <span class="slide__title">Англійська для подорожей</span>
                    </div>
                    <p class="slide__subtitle">Легкість у спілкуванні за кордоном: базові фрази, необхідні для аеропорту, готелю та ресторану.</p>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="action">
                <div class="action-info">
                    <div class="action-content">
                        <h1 class="action__title">А тепер просто натисність кнопку справа :)</h1>
                        <p class="action__subtitle">Більше датільнішої інформації у нас в <a href="" class="action__subtitle__link">instagram</a></p>
                    </div>
                    <div class="action__button">
                        <button onclick="openModal('getDiscount')" class="button btn-adaptive">Отримати знижку 15%</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>Favorite English 2025</footer>
    <!-- Модальне вікно реєстрації -->
    <div id="getDiscount" class="modal" data-modal="getDiscount">
        <form class="modal-content" action="submit.php" method="post">
            <span class="close" onclick="closeModal('getDiscount')"><ion-icon name="close-outline"></ion-icon></span>
            <h2>Отримання знижки</h2>
            <div class="modal-inputs">
                <input type="text" name="name" placeholder="Ім'я" required>
                <input type="email" name="email" placeholder="Email" required>
                <fieldset>
                    <div class="button-group">
                        <input type="radio" value="A1" id="A1" name="level" checked="" />
                        <label for="A1">A1</label>
                    </div>
                    <div class="button-group">
                        <input type="radio" value="A2" id="A2" name="level" />
                        <label for="A2">A2</label>
                    </div>
                    <div class="button-group">
                        <input type="radio" value="B1" id="B1" name="level" />
                        <label for="B1">B1</label>
                    </div>
                    <div class="button-group">
                        <input type="radio" value="B2" id="B2" name="level" />
                        <label for="B2">B2</label>
                    </div>
                    <div class="button-group">
                        <input type="radio" value="C1" id="C1" name="level" />
                        <label for="C1">C1</label>
                    </div>
                </fieldset>
            </form>
            <div class="modal__bottom-section">
                <div class="unknown-section">
                    <div class="unknown-level"><a href="#">Не знаю свого рівня</a></div>
                    <div class="back-button">
                        <a href="" class="unknown-back">← Назад</a>
                    </div>
                </div>
                <button type="submit" class="button modal-button">Отримати знижку</a>
            </div>
        </form>
    </div>
    <script src="js/index.js" defer></script>
</body>

</html>