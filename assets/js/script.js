// Animation du menu
const burger = document.querySelector('.burger');
const nav = document.querySelector('nav');

burger.addEventListener('click', () => {
    console.log('clique !')
    const isOpen = burger.getAttribute('aria-expanded') === 'true';

    burger.setAttribute('aria-expanded', !isOpen);
    nav.classList.toggle('active');
});

//Fermer la nav au clavier
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        nav.classList.remove('active');
        burger.setAttribute('aria-expanded', 'false');
        burger.focus();
    }
});