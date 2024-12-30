/*document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const targetSection = document.querySelector(`.${this.getAttribute('href')}`);
        if (targetSection) {
            targetSection.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});*/

document.querySelectorAll('.app-card').forEach(card => {
    card.addEventListener('click', () => {
        const contactSection = document.querySelector('.contact-us');
        if (contactSection) {
            contactSection.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

document.querySelectorAll('.btn-learn-more,.request-quote-btn, .request-price-btn').forEach(button => {
    button.addEventListener('click', () => {
        const contactSection = document.querySelector('.contact-us');
        if (contactSection) {
            contactSection.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
