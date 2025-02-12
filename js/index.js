const slider = document.querySelector('.slider');
const sliderTrack = document.querySelector('.slider-track');

let isDown = false;
let startX;
let scrollLeft;
let velocity = 0;
let prevX = 0;
let animationFrame;

// Функція для інерційного скролу
function inertiaScroll() {
    slider.scrollLeft += velocity;
    velocity *= 0.92;

    if (Math.abs(velocity) > 0.5) {
        animationFrame = requestAnimationFrame(inertiaScroll);
    } else {
        cancelAnimationFrame(animationFrame);
    }
}

// Події для миші
slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX;
    scrollLeft = slider.scrollLeft;
    velocity = 0;
    prevX = startX;
    cancelAnimationFrame(animationFrame);
});

slider.addEventListener('mouseleave', () => {
    if (isDown) {
        isDown = false;
        slider.classList.remove('active');
        requestAnimationFrame(inertiaScroll);
    }
});

slider.addEventListener('mouseup', () => {
    if (isDown) {
        isDown = false;
        slider.classList.remove('active');
        requestAnimationFrame(inertiaScroll);
    }
});

slider.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();

    const x = e.pageX;
    const walk = (x - prevX) * 0.6; 
    velocity = -walk;

    slider.scrollLeft -= walk;
    prevX = x;
});

// Події для сенсорних екранів
slider.addEventListener('touchstart', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.touches[0].pageX;
    scrollLeft = slider.scrollLeft;
    velocity = 0;
    prevX = startX;
    cancelAnimationFrame(animationFrame);
});

slider.addEventListener('touchend', () => {
    if (isDown) {
        isDown = false;
        slider.classList.remove('active');
        requestAnimationFrame(inertiaScroll);
    }
});

slider.addEventListener('touchmove', (e) => {
    if (!isDown) return;

    const x = e.touches[0].pageX;
    const walk = (x - prevX) * 0.6;
    velocity = -walk;

    slider.scrollLeft -= walk;
    prevX = x;
});

// Модальне вікно
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    const modalContent = modal.querySelector('.modal-content');

    modal.style.display = "flex";
    document.body.style.overflow = "hidden";
    modalContent.style.animation = 'none';
    modalContent.offsetHeight;
    modalContent.style.animation = 'slideUp 0.5s ease';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    const modalContent = modal.querySelector('.modal-content');
    
    modalContent.style.animation = 'slideOut 0.5s ease'; 
    
    setTimeout(() => {
        modal.style.display = "none";
        document.body.style.overflow = "";
    }, 230);
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
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            closeModal(modal.id);
        });
    }
};

// Зміна стану кнопки в модальному вікні
document.querySelector(".unknown-section").addEventListener("click", function (event) {
    event.preventDefault();

    const discountButton = document.querySelector(".modal-button");
    const isUnknown = discountButton.classList.toggle("unknow-modal__button");

    const newText = isUnknown ? "Тест ~15хв" : "Отримати знижку";

    document.querySelector(".unknown-back").classList.toggle("unknown-back__active", isUnknown);
    document.querySelector(".unknown-level").classList.toggle("unknown-level__active", isUnknown);

    if (isUnknown) {
        discountButton.outerHTML = `<a href="/tests" class="button modal-button unknow-modal__button">${newText}</a>`;
    } else {
        discountButton.outerHTML = `<button class="button modal-button">${newText}</button>`;
    }
});

// Зміна тексту в картці знизу залежно від ширини екрану
function updateActionTitleText() {
    const actionTitle = document.querySelector(".action__title");

    if (window.innerWidth <= 830) {
        actionTitle.textContent = "А тепер просто натисність кнопку внизу :)";
    } else {
        actionTitle.textContent = "А тепер просто натисність кнопку справа :)";
    }
}

updateActionTitleText();
window.addEventListener("resize", updateActionTitleText);