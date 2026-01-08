<?php
session_start();
include_once('controleurs/recette.php');
include_once('controleurs/user.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil | La Gamelle</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    <!--
    <div id="loader">
        <div class="loader-content">
            <div class="loader-image-container">
                <img src="assets/images/strawberry-cat.webp" alt="Chargement..." class="loader-img">
            </div>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
            <p>Préparation de la gamelle...</p>
        </div>
    </div>
    -->
    <header>
        <a href="#" class="logo">LG</a>
        <div class="mobile-only">
            <?php
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<form action="controleurs/recette.php" method="get">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>';
            }
            ?>
        </div>
        <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="menu">
            <img src="assets/images/burger-menu.svg" alt="">
        </button>

        <nav id="menu" aria-label="Navigation principale">
            <ul class="navbar">
                <li><a href="vues/recette.php">Nos Recettes</a></li>
                <li><a href="vues/alimentsdangereuxV.php">Aliments toxiques</a></li>
                <li><a href="vues/VeterinaireView.php">Trouver un vétérinaire</a></li>
                <li><a href="vues/v-contribution.php">Proposer une recette</a></li>
            </ul>
            <?php
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<form action="controleurs/recette.php" method="get" class="pc-only">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>';

                echo '<div class="compte pc-only">
                        <a href="vues/profil.php?favoris"><img src="assets/images/favorite-on.svg" alt="Voir mes favoris"></a>
                        <a href="vues/profil.php"><img src="assets/images/compte.svg" alt="Accéder à mon profil"></a>
                     </div>';

                echo '<div class="compte mobile-only">
                        <a href="vues/profil.php?favoris">Favoris</a>
                        <a href="vues/profil.php">Compte</a>
                     </div>';
            } else {
                echo '<div class="connexion">
                        <a href="vues/v-inscription.php">Inscription</a>
                        <a href="vues/v-connexion.php">Connexion</a>
                    </div>';
            }
            ?>
        </nav>
    </header>
    <main>
        <section class="hero">
            <h1>La Gamelle</h1>
            <p class="subtitle">Parce que vos animaux sont adorables, ils méritent des plats de qualité.</p>
        </section>

        <section class="recents">
            <h2>Nos nouvelles recettes</h2>
            <p>Ne ratez rien des nouveautés pour vos compagnons ! Chaque semaine, de nouvelles recettes saines et
                gourmandes arrivent pour ravir chats et chiens. Inspirez-vous et faites plaisir à votre chouchou avec
                des repas faits maison faciles à préparer.</p>
            <div class="new">
                <div class="book">
                    <div class="page couverture">
                        <div class="page-face front">
                            <img src="assets/images/cook-hat.png" alt="">
                            <h3>Le Grand Livre des Recettes</h3>
                        </div>
                        <div class="page-face back"></div>
                    </div>
                    <?php foreach ($newRecettes as $index => $recette): ?>
                        <div class="page" style="z-index: <?= count($newRecettes) - $index ?>;">

                            <div class="page-face front recette">
                                <div class="img"></div>
                                <img src="assets/images/pin.png" alt="" class="pin">

                                <h2><?= htmlspecialchars($recette['nom_recette']) ?></h2>

                                <span class="temps">
                                    <img src="assets/images/clock.png" alt=""> <?= $recette['temps'] ?> min
                                </span>

                                <div class="badge">
                                    <?php
                                    $icon = ($recette['animal'] == 'chien') ? 'dog.png' : 'cat.png';
                                    ?>
                                    <img src="assets/images/<?= $icon ?>" alt="">
                                    <p>Pour <?= $recette['animal'] ?></p>
                                </div>
                                <a href="">Voir la recette</a>
                            </div>

                            <div class="page-face back">
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <button id="btn-reset" class="btn-reset">Revenir au début</button>
                </div>
            </div>
        </section>

        <section class="nous">
            <h2>Que proposons-nous ?</h2>
            <p>Ici, vous trouverez toutes les recettes pour chouchouter votre compagnon à quatre pattes ! Snacks
                rapides, repas gourmands ou petites friandises maison… tout est pensé pour égayer les repas de votre
                chat ou de votre chien et lui faire plaisir à chaque bouchée.</p>

            <div class="cards">
                <div class="card">
                    <img src="assets/images/snack.webp" alt="">
                    <h3>Snacks</h3>
                    <p>Des snacks délicieux, parfaits pour leur offrir un petit plaisir sain à tout moment.</p>
                    <a href="vues/recette.php?type=snack">Voir les snacks</a>
                </div>
                <div class="card">
                    <img src="assets/images/plat.webp" alt="">
                    <h3>Plats</h3>
                    <p>Des plats variés salés et savoureux, adaptés aux goûts et besoins des animaux.
                    </p>
                    <a href="vues/recette.php?type=plat">Voir les plats</a>
                </div>
                <div class="card">
                    <img src="assets/images/dessert.webp" alt="">
                    <h3>Desserts</h3>
                    <p>Des desserts gourmands et variés, parfaits pour satisfaire toutes les envies sucrées.</p>
                    <a href="vues/recette.php?type=dessert">Voir les desserts</a>
                </div>
            </div>
        </section>

        <section class="croquette">
            <h2>De nouvelles recettes saines pour remplacer les croquettes.</h2>
            <div class="croquette-container">
                <div class="gauche">
                    <div>
                        <h3>Des aliments sains</h3>
                        <p>De nouvelles recettes saines pour remplacer les croquettes.</p>
                    </div>
                    <div>
                        <h3>Des recettes personnalisées</h3>
                        <p>Des recettes proposées par rapport à la race de votre animal, ses préférences et ses
                            problèmes de santés éventuels</p>
                    </div>
                </div>
                <img src="assets/images/croquettes1.png" alt="">
                <div class="droite">
                    <div>
                        <h3>Tout pour sa santé</h3>
                        <p>Des recettes qui respectent leurs régimes alimentaitaires ou leurs problèmes de santé.</p>
                    </div>
                    <div>
                        <h3>Ajouter vos propres recettes</h3>
                        <p>Proposez des recettes qui seront validées ou refusées par nos modérateurs, selon leur
                            conformité avec nos valeurs éthiques.</p>
                        <a href="vues/v-contribution.php">Ajouter une recette</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="aliment">
            <h2>Des aliments toxiques pour vos animaux !</h2>
            <div class="aliment-container">
                <img src="assets/images/timeline1.webp" alt="">
                <div class="texte">
                    <p>Nos recettes sont faites à partir d’ingrédients comestibles pour les humains, mais attention !
                    </p>
                    <p>Ce n’est pas parce que tout ce que vous cuisinez est également comestible pour vous, que tout est
                        comestible pour votre petite boule de poile !
                        Heureusement, La Gamelle vous indique quels aliments peuvent être dangereux pour VOTRE animal.
                    </p>
                    <p>Alors n’attendez plus et consultez vite notre liste des aliments dangeureux !</p>

                    <a href="vues/alimentsdangereuxV.php">Trouver un aliment toxique</a>
                </div>
            </div>

        </section>
    </main>

    <footer class="main-footer">
        <div class="footer-wave">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape-fill"></path>
            </svg>
        </div>
        <div class="footer-container">
            <div class="footer-links">
                <h3>Navigation</h3>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="vues/recette.php">Nos Recettes</a></li>
                    <li><a href="vues/alimentsdangereuxV.php">Aliments toxiques</a></li>
                    <li><a href="vues/VeterinaireView.php">Vétérinaires</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h3>Informations</h3>
                <ul>
                    <li><a href="#">À propos</a></li>
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Confidentialité</a></li>
                    <li><a href="#">Crédits</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 La Gamelle - Fait avec passion pour vos animaux.</p>
        </div>
    </footer>
    <script src="assets/js/gsap.min.js"></script>
    <script src="assets/js/flip.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        const pages = document.querySelectorAll('.page');
        const book = document.querySelector('.book');

        let currentIndex = 0;
        let isDragging = false;
        let startX = 0;

        // Souris
        book.addEventListener('mousedown', startDrag);
        window.addEventListener('mousemove', doDrag);
        window.addEventListener('mouseup', endDrag);

        // Tactile (Mobile)
        book.addEventListener('touchstart', (e) => startDrag(e.touches[0]));
        window.addEventListener('touchmove', (e) => doDrag(e.touches[0]));
        window.addEventListener('touchend', endDrag);

        function startDrag(e) {
            if (currentIndex >= pages.length) return;
            isDragging = true;
            startX = e.clientX;
            pages[currentIndex].style.cursor = 'grabbing';
        }

        function doDrag(e) {
            if (!isDragging || currentIndex >= pages.length) return;

            const currentX = e.clientX;
            const distance = startX - currentX;
            let progress = distance / book.offsetWidth;
            progress = Math.max(0, Math.min(1, progress));

            const angle = progress * -180;

            // Rotation de la page
            gsap.set(pages[currentIndex], { rotationY: angle });

            if (currentIndex === 0) {
                let moveX = progress * 25;
                gsap.set(book, { x: `${moveX}%` });
            }
        }

        function endDrag(e) {
            if (!isDragging || currentIndex >= pages.length) return;
            isDragging = false;

            const currentPage = pages[currentIndex];
            // récupère la rotation actuelle
            const currentRotation = gsap.getProperty(currentPage, "rotationY");

            if (currentRotation < -45) {
                gsap.to(currentPage, {
                    rotationY: -180,
                    duration: 0.6,
                    ease: "power2.out",
                    onComplete: () => {
                        currentPage.style.zIndex = 0;
                        currentIndex++;
                    }
                });

                // Maintenir le livre centré si on a ouvert la couverture
                if (currentIndex === 0) {
                    gsap.to(book, { x: "25%", duration: 0.6 });
                }
            } else {
                // Retour à la position initiale
                gsap.to(currentPage, {
                    rotationY: 0,
                    duration: 0.4,
                    ease: "back.out(2)"
                });

                if (currentIndex === 0) {
                    gsap.to(book, { x: "0%", duration: 0.4 });
                }
            }
            currentPage.style.cursor = 'grab';
        }

        // Reset
        const resetBtn = document.getElementById('btn-reset');
        resetBtn.addEventListener('click', () => {
            if (currentIndex === 0) return;

            const resetTl = gsap.timeline();

            //le livre à sa position initiale
            resetTl.to(book, { x: "0%", duration: 0.5 }, 0);

            for (let i = currentIndex - 1; i >= 0; i--) {
                resetTl.to(pages[i], {
                    rotationY: 0,
                    duration: 0.4,
                    ease: "power2.inOut",
                    onStart: () => {
                        pages[i].style.zIndex = pages.length - i;
                    }
                }, "-=0.2");
            }
            currentIndex = 0;
        });
    </script>
</body>

</html>