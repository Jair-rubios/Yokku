document.addEventListener('DOMContentLoaded', () => {
    const hamburgerBtn = document.querySelector('.hamburger-menu');
    const mobileNavLinks = document.querySelector('.mobile-nav-links');

    hamburgerBtn.addEventListener('click', () => {
        mobileNavLinks.classList.toggle('open');
    });
});