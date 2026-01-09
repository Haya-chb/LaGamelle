const burger = document.querySelector('.burger');
const nav = document.querySelector('nav');
const navLinks = document.querySelectorAll('nav a');

//timeline d'ouverture
const menuTl = gsap.timeline({ paused: true });

menuTl.to(nav, {
    duration: 0.6,
    autoAlpha: 1,
    y: "0%",
    ease: "poweri.out"
});

// Initialisation pour le mobile
if (window.innerWidth < 850) {
    gsap.set(nav, { y: "-100%" });
}

function toggleMenu() {
    if (nav.classList.contains('active')) {
        closeMenu();
    } else {
        openMenu();
    }
}

function openMenu() {
    nav.classList.add('active');
    burger.setAttribute('aria-expanded', 'true');
    menuTl.play();
}

function closeMenu() {
    nav.classList.remove('active');
    burger.setAttribute('aria-expanded', 'false');
    menuTl.reverse();
}


burger.addEventListener('click', toggleMenu);

// Gestion du redimensionnement pour éviter que le menu reste bloqué
window.addEventListener('resize', () => {
    if (window.innerWidth >= 850) {
        gsap.set(nav, { clearProps: "all" });
        nav.classList.remove('active');
    } else {
        gsap.set(nav, { y: "-100%", autoAlpha: 0 });
    }
});