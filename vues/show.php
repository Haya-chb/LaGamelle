<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($vet['prenom'] . ' ' . $vet['nom']) ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/veterinaire.css">
</head>
<body>
    <header>
        <a href="../index.php" class="logo">LG</a>
        <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="menu">
            <img src="assets/images/burger-menu.svg" alt="">
        </button>

        <nav id="menu" aria-label="Navigation principale">
            <ul class="navbar">
                <li><a href="recette.php">Nos Recettes</a></li>
                <li><a href="alimentsdangereuxV.php">Aliments toxiques</a></li>
                <li><a href="VeterinaireView.php">Trouver un vétérinaire</a></li>
                <li><a href="v-contribution.php">Proposer une recette</a></li>
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
    
    <div class="container-vet">
        <div class="vet-header">
            <div class="vet-photo">
                <?php if (!empty($vet['photo'])): ?>
                    <img src="<?= '../' . htmlspecialchars($vet['photo']) ?>" 
     alt="Photo de <?= htmlspecialchars($vet['prenom'] . ' ' . $vet['nom']) ?>">

                <?php else: ?>
                    <img src="assets/images/vet-placeholder.jpg" alt="Photo vétérinaire">
                <?php endif; ?>
            </div>
            
            <div class="vet-info">
                <h1><?= htmlspecialchars($vet['prenom'] . ' ' . $vet['nom']) ?></h1>
                
                <div class="vet-description">
                    <?php if (!empty($vet['description'])): ?>
                        <p><?= htmlspecialchars($vet['description']) ?></p>
                    <?php else: ?>
                        <p>Le vétérinaire dit « canin » soigne, opère et stérilise surtout les chiens et les chats. Il s'occupe aussi de petits mammifères, de reptiles et d'oiseaux. Il exerce le plus souvent en cabinet; en clinique (il peut alors hospitaliser les animaux) ou bien dans des CHV (centres hospitaliers vétérinaires) qui sont en plus dotés de vétérinaires spécialistes dans différents domaines (médecine interne, chirurgie, dermatologie, imagerie médicale, etc.</p>
                    <?php endif; ?>
                </div>
                
                <div class="vet-contact">
                    <div class="contact-item">
                        <span class="icon location">📍</span>
                        <span><?= htmlspecialchars($vet['ville']) ?></span>
                    </div>
                    <div class="contact-item">
                        <span class="icon phone">📞</span>
                        <span><?= htmlspecialchars($vet['telephone']) ?></span>
                    </div>
                </div>
                
                <button class="btn-contact">Contacter</button>
            </div>
        </div>
        
        <?php if (!empty($recettes) && count($recettes) > 0): ?>
        <div class="recipes-section">
            <h2>Les recettes que ce vétérinaire recommande :</h2>
            
            <div class="recipes-grid">
                <?php foreach ($recettes as $recette): ?>
                <div class="recipe-card">
                    <?php if (!empty($recette['image'])): ?>
                        <img src="<?= htmlspecialchars($recette['image']) ?>" alt="<?= htmlspecialchars($recette['titre']) ?>">
                    <?php else: ?>
                        <img src="assets/images/recipe-placeholder.jpg" alt="<?= htmlspecialchars($recette['titre']) ?>">
                    <?php endif; ?>
                    
                    <div class="recipe-content">
                        <h3><?= htmlspecialchars($recette['titre']) ?></h3>
                        <div class="recipe-info">
                            <?php if (!empty($recette['temps_preparation'])): ?>
                                <span class="recipe-time">⏱️ <?= htmlspecialchars($recette['temps_preparation']) ?> min</span>
                            <?php endif; ?>
                            <?php if (!empty($recette['categorie'])): ?>
                                <span class="recipe-category">🐱 Recette pour les <?= htmlspecialchars($recette['categorie']) ?></span>
                            <?php endif; ?>
                        </div>
                        <a href="index.php?page=recettes&action=show&id=<?= $recette['id'] ?>" class="btn-recipe">Voir la recette</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <a href="index.php?page=veterinaires&action=index" class="btn-back">
            ← Retour à la liste
        </a>
    </div>

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
</body>
</html>
