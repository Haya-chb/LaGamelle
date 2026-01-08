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

/*
const images = [
    'assets/images/strawberry-cat.webp',
    'assets/images/lemon-cat.webp',
    'assets/images/pear-cat.webp'
];

let currentIndex = 0;
const loaderImg = document.querySelector('.loader-img');
const tl = gsap.timeline();

// Fonction pour changer l'image toutes les 500ms
const imageInterval = setInterval(() => {
    currentIndex = (currentIndex + 1) % images.length;
    gsap.to(loaderImg, {
        opacity: 0, 
        duration: 0.2, 
        onComplete: () => {
            loaderImg.src = images[currentIndex];
            gsap.to(loaderImg, { opacity: 1, duration: 0.2 });
        }
    });
}, 500);

tl.to(".progress-fill", {
    width: "100%",
    duration: 2.5,
    ease: "power1.inOut" 
});

tl.to("#loader", {
    yPercent: -100,
    opacity: 0,
    duration: 1.2,
    ease: "expo.inOut"
});
*/