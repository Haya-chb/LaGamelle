//Affichage des filtres (mobile)
const btnFiltres = document.querySelector('.btn-filtres');
const filtres = document.querySelector('.filtres');
const btnClose = document.querySelector('.btn-close-filtres');

function toggleFiltres(isOpen) {
    filtres.classList.toggle('active', isOpen);
    
    // Mise à jour de l'attribut ARIA pour l'accessibilité
    btnFiltres.setAttribute('aria-expanded', isOpen);
    
    // Gestion du scroll
    document.body.style.overflow = isOpen ? 'hidden' : '';
}

// Ouvrir
btnFiltres.addEventListener('click', () => toggleFiltres(true));

// Fermer 
btnClose.addEventListener('click', () => toggleFiltres(false));

// Fermer au clic sur Échap
window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && filtres.classList.contains('active')) {
        toggleFiltres(false);
    }
});

// Fermer si on clique sur un btn
document.querySelectorAll('.filtres a, .filtres input[type="submit"]').forEach(el => {
    el.addEventListener('click', () => {
        filtres.classList.remove('active');
        toggleFiltres(false);
    });
});