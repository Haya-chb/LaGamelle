<?php
session_start();
include_once('../controleurs/recette-detail.php');
include_once('../controleurs/user.php');
include_once('../controleurs/recette.php');


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($recette['nom_recette']) ?> | La Gamelle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/recette.css">
    <link rel="stylesheet" href="../assets/css/recette-detail.css">
</head>
    



<body>
    <header>
        <a href="../index.php" class="logo">LG</a>
        <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="menu">
            <img src="../assets/images/burger-menu.svg" alt="">
        </button>

        <nav id="menu" aria-label="Navigation principale">
            <ul class="navbar">
                <li><a href="recette.php">Nos Recettes</a></li>
                <li><a href="">Aliments toxiques</a></li>
                <li><a href="">Trouver un vétérinaire</a></li>
                <li><a href="">Proposer une recette</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="recette-detail">
            <a href="recette.php" class="btn-back">← Retour</a>
            <h1><?= htmlspecialchars($recette['nom_recette']) ?></h1>
            <p class="publie-par">Publié par <strong><?= htmlspecialchars($author['pseudo'] ?? 'Inconnu') ?></strong></p>
            <img class="img_detail" src="<?= $imgSrc ?>" alt="">
            <div class="recette-info">
                <span><img src="../assets/images/<?= htmlspecialchars($recette['animal'])?>.png" alt=""> Pour <?= htmlspecialchars($recette['animal']) ?></span>
                <span><img src="../assets/images/difficulty.svg" alt=""><?= htmlspecialchars($recette['niveau']) ?></span>
                <span><img src="../assets/images/clock.png" alt=""> <?= $recette['temps'] ?> min</span>
                
            </div>

            <h2>Ingrédients :</h2>

            <div class="recette-ingredients">
                <ul class="ingredient-list">
                    <?php foreach ($ingredients as $ingredient): ?>
                        <?php
                            $imgPath = htmlspecialchars(str_replace('\\', '/', $ingredient['image_ingredient'] ?? ''));
                        ?>
                        <div class="ingredient-item">
                           
                        <?php if (!empty($imgPath)): ?>
                                <img class="ingredient-img" src="<?= $imgPath ?>" alt="<?= htmlspecialchars($ingredient['nom_ingredient']) ?>">
                            <?php endif; ?>
                            <span class="ingredient-qty"><?= htmlspecialchars($ingredient['quantite_ingredient']) ?></span>
                            <span class="ingredient-name"><?= htmlspecialchars($ingredient['nom_ingredient']) ?></span>
                            </div>
                    <?php endforeach; ?>
                    
                </ul>


            </div>

            <h2>Préparation :</h2>
            <div class="recette-contenu">
                <p><?= nl2br(htmlspecialchars($recette['contenu_recette'])) ?></p>
                </section>
                
            </div>

            <h1>Les commentaires</h1>

            <?php if (isset($_SESSION['id_utilisateur'])): ?>
                <div class="commentaire-form">
                    <?php if (!empty($comment_message)): ?>
                        <p class="form-message"><?= htmlspecialchars($comment_message) ?></p>
                    <?php endif; ?>
                    <form method="POST" class="formulaire-avis">
                        <div class="form-group">
                            <label for="note">Note :</label>
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
                            <label for="commentaire">Votre commentaire :</label>
                            <textarea id="commentaire" name="commentaire" rows="4" placeholder="Partagez votre avis sur cette recette..." required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Poster votre commentaire</button>
                    </form>
                </div>
            <?php else: ?>
                <p class="login-required">Veuillez <a style="color: var(--bleu)" href="v-connexion.php">vous connecter</a> pour ajouter un commentaire.</p>
            <?php endif; ?>

            <div class="recette-commentaires">
                <?php if (!empty($commentaires)): ?>
                    <?php foreach ($commentaires as $commentaire): ?>
                        <div class="commentaire-item">
                            <div class="commentaire-header">
                                <div class="commentaire-user">
                                    <strong><?= htmlspecialchars($commentaire['pseudo']) ?></strong>
                                </div>
                                <div class="commentaire-note">
                                    <span class="note-stars"><?= str_repeat('⭐', intval($commentaire['note'])) ?></span>
                                    <span class="note-value"><?= htmlspecialchars($commentaire['note']) ?>/5</span>
                                </div>
                            </div>
                            <p class="commentaire-text"><?= nl2br(htmlspecialchars($commentaire['commentaire'])) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-comments">Aucun commentaire pour le moment. Soyez le premier à commenter cette recette !</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script src="../assets/js/script.js"></script>
    <script>
        // Randomize background colors of comment items using CSS variables
        // and provide toggle show/hide for comments
        document.addEventListener('DOMContentLoaded', function() {
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
</body>

</html>