// Додаємо обробник для вибору відповіді
const answers = document.querySelectorAll('.tests__answer');

answers.forEach(answer => {
    answer.addEventListener('click', () => {
        // Видаляємо клас 'active' у всіх відповідей
        answers.forEach(ans => ans.classList.remove('active'));
        
        // Додаємо клас 'active' до вибраної відповіді
        answer.classList.add('active');
    });
});