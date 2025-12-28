//Affichage des filtres (mobile)
const btnFiltres = document.querySelector('.btn-filtres');
const filtres = document.querySelector('.filtres');

btnFiltres.addEventListener('click', () => {
    const isOpen = filtres.classList.toggle('active');
    btnFiltres.setAttribute('aria-expanded', isOpen);
});
