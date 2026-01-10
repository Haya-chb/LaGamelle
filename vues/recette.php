<?php
session_start();
require('../connexion.php');
include_once('../controleurs/recette.php');
include_once('../controleurs/user.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Recettes | La Gamelle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/recette.css">
</head>

<body>
    <header>
        <a href="../index.php" class="logo">LG</a>
        <div class="mobile-only">
            <?php
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<form action="recette.php" method="get">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>';
            }
            ?>
        </div>
        <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="menu">
            <img src="../assets/images/burger-menu.svg" alt="">
        </button>

        <nav id="menu" aria-label="Navigation principale">
            <ul class="navbar">
                <li><a href="recette.php" class="active">Nos Recettes</a></li>
                <li><a href="alimentsdangereuxV.php">Aliments toxiques</a></li>
                <li><a href="index.php">Trouver un vétérinaire</a></li>
                <?php
                if (isset($_SESSION['id_utilisateur'])) {
                    echo ' <li><a href="v-contribution.php">Proposer une recette</a></li>';
                } ?>

            </ul>
            <?php
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<form action="recette.php" method="get" class="pc-only">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>';

                echo '<div class="compte pc-only">
                        <a href="profil.php?favoris"><img src="../assets/images/favorite-on.svg" alt="Voir mes favoris"></a>
                        <a href="profil.php"><img src="../assets/images/compte.svg" alt="Accéder à mon profil"></a>
                     </div>';

                echo '<div class="compte mobile-only">
                        <a href="profil.php?favoris">Favoris</a>
                        <a href="profil.php">Compte</a>
                        <a href="../deconnexion.php">Déconnexion</a>
                     </div>';
            } else {
                echo '<div class="connexion">
                        <a href="v-inscription.php">Inscription</a>
                        <a href="v-connexion.php">Connexion</a>
                    </div>';
            }
            ?>
        </nav>
    </header>
    <main>
        <section>
            <h1>Nos Recettes</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, ab fugiat minima dolores pariatur
                repellat?</p>

            <button class="btn-filtres" aria-expanded="false" aria-controls="filtres">
                Filtres
            </button>

            <div class="filtres">
                <button class="btn-close-filtres"><img src="../assets/images/close.svg"
                        alt="Fermer les filtres"></button>
                <form id="filtres-form" method="get">
                    <label for="animal" class="sr-only">Pour quel animal ?</label>
                    <select name="animal" id="animal">
                        <option value="">Espèce</option>
                        <option value="chat">Chat</option>
                        <option value="chien">Chien</option>
                    </select>

                    <label for="type" class="sr-only">Type de recette</label>
                    <select name="type" id="type">
                        <option value="">Type de recette</option>
                        <option value="plat">Plat</option>
                        <option value="snack">Snack</option>
                        <option value="dessert">Dessert</option>
                    </select>

                    <label for="temps" class="sr-only">Temps de préparation</label>
                    <select name="temps" id="temps">
                        <option value="">Temps de préparation</option>
                        <option value="15">≤ 15 min</option>
                        <option value="30">≤ 30 min</option>
                        <option value="45">≤ 45 min</option>
                        <option value="60">≤ 1 h</option>
                    </select>

                    <label for="niveau" class="sr-only">Niveau de difficulté</label>
                    <select name="niveau" id="niveau">
                        <option value="">Difficulté</option>
                        <option value="1">Facile</option>
                        <option value="2">Moyen</option>
                        <option value="3">Difficile</option>
                    </select>
                    <input type="submit" value="Filtrer">
                </form>
                <a href="../vues/recette.php" class="btn-reset">Réinitialiser</a>
            </div>
        </section>

        <section class="recettes">
            <?php
            if (!empty($recettes)) {
                foreach ($recettes as $recette) {
                    $id = (int) $recette['id_recette'];
                    $imgSrc = ($recette['image_recette']);
                    $nom = htmlspecialchars($recette['nom_recette']);
                    $temps = (int) $recette['temps'];
                    $animal = htmlspecialchars($recette['animal']);

                    echo "<div class='recette'>";
                    echo "<a class='recette-link' href='recette-detail.php?id={$id}'>
                            <div class='img'><img width='219px' src='{$imgSrc}' alt='{$nom}'></div>
                            <img src='../assets/images/pin.png' alt='' class='pin'>
                            <h2>{$nom}</h2>
                            <span class='temps'><img src='../assets/images/clock.png' alt=''> {$temps} min</span>
                            <div class='badge'>";

                    if ($recette['animal'] == 'chien') {
                        echo "<img src='../assets/images/dog.png' alt=''><p>Pour {$animal}</p></div>";
                    } else if ($recette['animal'] == 'chat') {
                        echo "<img src='../assets/images/cat.png' alt=''><p>Pour {$animal}</p></div>";
                    } else {
                        echo "</div>";
                    }

                    echo "</a>";

                    // bouton favoris en dehors de la balise <a>
                    echo '<button class="btn-favoris" data-recette="' . $id . '"><img src="../assets/images/favorite-off.svg" alt="">
                         <span class="sr-only">Ajouter aux favoris</span></button>';

                    echo "</div>";
                }
            } else {
                echo '<p class="rien"> Aucun résultat </p>';
            }
            ?>
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
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="../vues/recette.php">Nos Recettes</a></li>
                    <li><a href="../vues/alimentsdangereuxV.php">Aliments toxiques</a></li>
                    <li><a href="../vues/index.php">Vétérinaires</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h3>Informations</h3>
                <ul>
                    <li><a href="../vues/mentions-legales.php">Mentions légales</a></li>
                    <li><a href="../vues/mentions-legales.php#confidentialite">Confidentialité</a></li>
                    <li><a href="../vues/mentions-legales.php#credits">Crédits</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 La Gamelle - Fait avec passion pour vos animaux.</p>
        </div>
    </footer>


    <script src="../assets/js/gsap.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/recette.js"></script>
    <script src="../assets/js/favoris.js"></script>
    <script>
        //Vérifis s'il la recette est déjà dans les favoris de l'utilisateur
        const favoris = <?= json_encode(array_column($favoris, 'id_recette')) ?>;
        document.querySelectorAll('.btn-favoris').forEach(btn => {
            const recetteId = parseInt(btn.dataset.recette);
            if (favoris.includes(recetteId)) {
                btn.classList.add('active');
                btn.innerHTML = '<img src="../assets/images/favorite-on.svg" alt="">';
            }
        });

    </script>
</body>

</html>