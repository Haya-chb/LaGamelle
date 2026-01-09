<?php
session_start();
include_once('../controleurs/recette-detail.php');
include_once('../controleurs/user.php');
include_once('../controleurs/recette.php');

$niveau = $recette['niveau'];
switch ($niveau) {
    case 1:
        $difficulte = "Facile";
        break;
    case 2:
        $difficulte = "Moyen";
        break;
    case 3:
        $difficulte = "Difficile";
        break;
    default:
        $difficulte = "Facile";
        $difficulte_class = "";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($recette['nom_recette']) ?> | La Gamelle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/recette-detail.css">
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
                <li><a href="recette.php">Nos Recettes</a></li>
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
        <section class="recipe-intro">
            <h1><?= htmlspecialchars($recette['nom_recette']) ?></h1>


            <div class="recipe-rating">
                <span class="stars">★★★★☆</span>
                <span>4/5 - <?= count($commentaires) ?> avis</span>
            </div>

            <div class="recipe-visuals">
                <div class="visual-illustration">
                    <img src="" alt="Illustration">
                </div>
                <div class="visual-photo">
                    <img src="" alt="">
                </div>
            </div>

            <div class="recipe-badges">
                <div class="badges">
                    <img src="../assets/images/<?= htmlspecialchars($recette['animal']) ?>.svg" alt="">
                    Pour <?= htmlspecialchars($recette['animal']) ?>
                </div>
                <div class="badges">
                    <img src="../assets/images/chef.svg" alt="">
                    <?= htmlspecialchars($difficulte) ?>
                </div>
                <div class="badges">
                    <img src="../assets/images/timer.svg" alt="">
                    Total : <?= $recette['temps'] ?> min
                </div>
                <button class="btn-save"><img src="../assets/images/heart.svg" alt="">Enregistrer</button>
            </div>
        </section>
        <section class="ingredients">
            <h2>Ingrédients :</h2>
            <div class="ingredients-grid">
                <?php foreach ($ingredients as $ingredient): ?>
                    <div class="ingredient-item">
                        <?php if (!empty($imgPath)): ?>
                            <img src="" alt="">
                        <?php endif; ?>
                        <span class="ingredient-qty"><?= htmlspecialchars($ingredient['quantite_ingredient']) ?></span>
                        <span class="ingredient-name"><?= htmlspecialchars($ingredient['nom_ingredient']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="steps-section">
            <h2>Préparation :</h2>
            <div class="steps-content">
                <?php
                // Transformation du texte brut en liste ordonnée
                $instructions = explode("\n", $recette['contenu_recette']);
                echo "<ol>";
                foreach ($instructions as $step) {
                    if (trim($step) !== "") {
                        echo "<li>" . htmlspecialchars(trim($step)) . "</li>";
                    }
                }
                echo "</ol>";
                ?>
            </div>
        </section>

        <section class="comments">
            <h2>Les commentaires</h2>
            <button id="toggle-comments-btn">Masquer les commentaires</button>

            <?php if (isset($_SESSION['id_utilisateur'])): ?>
                <div class="commentaire">
                    <?php if (!empty($comment_message)): ?>
                        <p class="form-message"><?= htmlspecialchars($comment_message) ?></p>
                    <?php endif; ?>
                    <form method="POST" class="formulaire-avis">
                        <div class="form-group">
                            <label for="note">Note :</label><br>
                            <select id="note" name="note" required>
                                <option value="">Sélectionnez une note</option>
                                <option value="1">⭐ 1/5</option>
                                <option value="2">⭐⭐ 2/5</option>
                                <option value="3">⭐⭐⭐ 3/5</option>
                                <option value="4">⭐⭐⭐⭐ 4/5</option>
                                <option value="5">⭐⭐⭐⭐⭐ 5/5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="commentaire">Votre commentaire :</label><br>
                            <textarea id="commentaire" name="commentaire"
                                placeholder="Partagez votre avis sur cette recette..." required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Poster votre commentaire</button>
                    </form>
                </div>
            <?php else: ?>
                <p class="login-required">Veuillez <a style="color: var(--bleu)" href="v-connexion.php">vous connecter</a>
                    pour ajouter un commentaire.</p>
            <?php endif; ?>

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
                    <li><a href="vues/mentions-legales.php">Mentions légales</a></li>
                    <li><a href="vues/mentions-legales.php#confidentialite">Confidentialité</a></li>
                    <li><a href="vues/mentions-legales.php#credits">Crédits</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 La Gamelle - Fait avec passion pour vos animaux.</p>
        </div>
    </footer>

    <script src="../assets/js/gsap.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <script>
        // Randomize background colors of comment items using CSS variables
        // and provide toggle show/hide for comments
        document.addEventListener('DOMContentLoaded', function () {
            const colors = ['--rouge', '--orange', '--jaune', '--rose', '--vert', '--bleu'];
            const commentItems = document.querySelectorAll('.commentaire-item');

            commentItems.forEach(item => {
                const randomColor = colors[Math.floor(Math.random() * colors.length)];
                const colorValue = getComputedStyle(document.documentElement).getPropertyValue(randomColor).trim();
                item.style.backgroundColor = colorValue;

                // Set text color to white if the background is rouge
                if (randomColor === '--rouge') {
                    item.style.color = 'white';
                }
            });

            const toggleBtn = document.getElementById('toggle-comments-btn');
            const commentsWrapper = document.getElementById('comments-wrapper');
            if (toggleBtn && commentsWrapper) {
                toggleBtn.addEventListener('click', () => {
                    const hidden = commentsWrapper.classList.toggle('hidden');
                    toggleBtn.textContent = hidden ? 'Afficher les commentaires' : 'Masquer les commentaires';
                });
            }
        });
    </script>
</body>

</html>