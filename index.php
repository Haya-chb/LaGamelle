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
        <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="menu">
            <img src="assets/images/burger-menu.svg" alt="">
        </button>

        <nav id="menu" aria-label="Navigation principale">
            <ul class="navbar">
                <li><a href="vues/recette.php">Nos Recettes</a></li>
                <li><a href="vues/">Aliments toxiques</a></li>
                <li><a href="vues/VeterinaireView.php">Trouver un vétérinaire</a></li>
                <li><a href="vues/">Proposer une recette</a></li>
            </ul>
            <?php
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<form action="controleurs/recette.php" method="get">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>';

                echo '<div class="compte">
                        <a href="vues/profil.php?favoris"><img src="assets/images/favorite-on.svg" alt="Voir mes favoris"></a>
                        <a href="vues/profil.php"><img src="assets/images/compte.svg" alt="Accéder à mon profil"></a>
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
            <p>Parce que vos animaux sont adorables, ils méritent des plats de qualité.</p>
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

                                <button class="btn-favoris" data-recette="<?= $recette["id_recette"] ?>">
                                    <img src="assets/images/favorite-off.svg" alt="">
                                    <span class="sr-only">Ajouter aux favoris</span>
                                </button>
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

                    <a href="vues/alimentsdangereuxV.php">Voir la liste</a>
                </div>
            </div>

        </section>
    </main>

    <footer>
        <ul>
            <li><a href="">À propos</a></li>
            <li><a href="">Mentions légales</a></li>
            <li><a href="">Politiques de confidentialité</a></li>
            <li><a href="">Crédits</a></li>
        </ul>
    </footer>
    <script src="assets/js/gsap.min.js"></script>
    <script src="assets/js/flip.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        //Livre de recette
        const pages = document.querySelectorAll('.page');
        const book = document.querySelector('.book');

        let currentIndex = 0;
        let isDragging = false;
        let startX = 0;

        function updatePageFlip(distance) {
            const bookWidth = book.offsetWidth; // Largeur totale du livre

            // 1. Calculer le pourcentage de progression (entre 0 et 1)
            // On divise la distance parcourue par la largeur totale
            let progress = distance / bookWidth;

            // Sécurité : on bloque entre 0 (0%) et 1 (100%)
            progress = Math.max(0, Math.min(1, progress));

            // 2. Convertir le progrès en degrés (de 0 à -180)
            const angle = progress * -180;

            // 3. Appliquer avec GSAP (sur la page actuellement ciblée)
            const currentPageElement = pages[currentIndex];

            gsap.set(currentPageElement, {
                rotationY: angle,
                // Optionnel : ajouter un léger mouvement sur Z pour éviter que les pages se rentrent dedans
                translateZ: progress > 0.5 ? 1 : 0
            });
        }

        book.addEventListener('mousedown', (e) => {
            if (currentIndex >= pages.length) return;
            isDragging = true;
            startX = e.clientX;
            pages[currentIndex].style.cursor = 'grabbing';
        })

        window.addEventListener('mousemove', (e) => {
            if (!isDragging || currentIndex >= pages.length) return;

            const currentX = e.clientX;
            const distance = startX - currentX;

            // On calcule l'angle (entre 0 et -180)
            let progress = distance / book.offsetWidth;
            progress = Math.max(0, Math.min(1, progress));
            const angle = progress * -180;

            // On applique la rotation en temps réel
            gsap.set(pages[currentIndex], { rotationY: angle });
        });

        window.addEventListener('mouseup', (e) => {
            if (!isDragging || currentIndex >= pages.length) return;
            isDragging = false;

            const distance = startX - e.clientX;
            const threshold = book.offsetWidth / 4; // On tourne si on a fait 1/4 du chemin
            const currentPage = pages[currentIndex];

            if (distance > threshold) {
                // SUCCÈS : On finit de tourner la page
                gsap.to(currentPage, {
                    rotationY: -180,
                    duration: 0.6,
                    ease: "power2.out",
                    onComplete: () => {
                        // On baisse le z-index pour ne pas gêner le clic sur la page suivante
                        currentPage.style.zIndex = 0;
                        currentIndex++;
                    }
                });
            } else {
                // ÉCHEC : La page revient en place
                gsap.to(currentPage, {
                    rotationY: 0,
                    duration: 0.4,
                    ease: "back.out(2)"
                });
            }
            currentPage.style.cursor = 'grab';
        });

        const resetBtn = document.getElementById('btn-reset');

        resetBtn.addEventListener('click', () => {
            if (currentIndex === 0) return; // Déjà au début

            // On crée une timeline pour que le retour soit fluide
            const resetTl = gsap.timeline();

            // On boucle sur toutes les pages tournées, en partant de la dernière
            for (let i = currentIndex - 1; i >= 0; i--) {
                resetTl.to(pages[i], {
                    rotationY: 0,
                    duration: 0.4,
                    ease: "power2.inOut",
                    onStart: () => {
                        // Important : On redonne le z-index AVANT que la page ne recouvre les autres
                        // Utilise la formule de ton PHP : count - index
                        pages[i].style.zIndex = pages.length - i;
                    }
                }, "-=0.2"); // Le "-=0.2" crée un effet de cascade (les pages se referment l'une après l'autre)
            }

            // On n'oublie pas de remettre l'index à zéro
            currentIndex = 0;
        });
    </script>
</body>

</html>