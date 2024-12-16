const slider = document.querySelector('.slider');
const sliderTrack = document.querySelector('.slider-track');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft; // Виправлено: використовуємо scrollLeft для відстеження положення скролу
});

slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active');
});

slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active');
});

slider.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();

    const x = e.pageX - slider.offsetLeft;
    const walk = x - startX;

    slider.scrollLeft = scrollLeft - walk; // Виправлено: змінюємо scrollLeft для прокрутки
});

// Додамо підтримку сенсорних екранів

slider.addEventListener('touchstart', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.touches[0].pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft; // Виправлено для сенсорів
});

slider.addEventListener('touchend', () => {
    isDown = false;
    slider.classList.remove('active');
});

slider.addEventListener('touchmove', (e) => {
    if (!isDown) return;

    const x = e.touches[0].pageX - slider.offsetLeft;
    const walk = x - startX;

    slider.scrollLeft = scrollLeft - walk; // Виправлено для сенсорів
});
// Modal window
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    const modalContent = modal.querySelector('.modal-content');

    // Встановлюємо стартові значення для відкриття
    modal.style.display = "flex";
    document.body.style.overflow = "hidden";  // Заблокувати скрол
    modalContent.style.animation = 'none'; // Скидаємо попередню анімацію
    modalContent.offsetHeight; // Перезапускаємо анімацію
    modalContent.style.animation = 'slideUp 0.5s ease'; // Додаємо анімацію відкриття заново
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    const modalContent = modal.querySelector('.modal-content');
    
    // Додаємо анімацію закриття
    modalContent.style.animation = 'slideOut 0.5s ease'; 
    
    // Після завершення анімації, приховуємо модальне вікно
    setTimeout(() => {
        modal.style.display = "none";
        document.body.style.overflow = "";  // Розблокувати скрол
    }, 230); // Встановлюємо таймер на тривалість анімації
}

window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target == modal) {
            closeModal(modal.id);
        }
    });
}

window.onkeydown = function(event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('.modal'); // Закрити тільки відкрите модальне вікно
        modals.forEach(modal => {
            closeModal(modal.id);
        });
    }
};

// Клик на "Не знаю свого рівня"
document.querySelector(".unknown-level").addEventListener("click", function (event) {
    event.preventDefault(); // Отключаем стандартное поведение ссылки

    const discountButton = document.querySelector(".modal-button");
    const backButton = document.querySelector(".unknown-back");
    const levelButton = document.querySelector(".unknown-level");

    // Тоггл класса на кнопке "Отримати знижку"
    const isUnknown = discountButton.classList.toggle("unknow-modal__button");

    // Изменение текста в кнопке "Отримати знижку"
    discountButton.textContent = isUnknown ? "Тест ~15хв" : "Отримати знижку";

    // Добавляем или убираем активный класс `unknown-back__active` у ссылки "Назад"
    backButton.classList.toggle("unknown-back__active", isUnknown);

    // Добавляем или убираем активный класс `unknown-level__active` у ссылки "Не знаю свого рівня"
    levelButton.classList.toggle("unknown-level__active", isUnknown);
});

// Клик на "Назад"
document.querySelector(".unknown-back").addEventListener("click", function (event) {
    event.preventDefault(); // Отключаем стандартное поведение ссылки

    const discountButton = document.querySelector(".modal-button");
    const backButton = document.querySelector(".unknown-back");
    const levelButton = document.querySelector(".unknown-level");

    // Убираем класс "unknow-modal__button" с кнопки "Отримати знижку"
    discountButton.classList.remove("unknow-modal__button");

    // Сбрасываем текст кнопки "Отримати знижку"
    discountButton.textContent = "Отримати знижку";

    // Убираем класс `unknown-back__active` у ссылки "Назад"
    backButton.classList.remove("unknown-back__active");

    // Убираем класс `unknown-level__active` у ссылки "Не знаю свого рівня"
    levelButton.classList.remove("unknown-level__active");
});

