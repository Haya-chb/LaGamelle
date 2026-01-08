<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($vet['prenom'] . ' ' . $vet['nom']) ?></title>
    <link rel="stylesheet" href="../assets/css/veterinaire.css">
</head>
<body>
    <header>
        <a href="#" class="logo">LG</a>
        <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="menu">
            <img src="assets/images/burger-menu.svg" alt="">
        </button>

        <nav id="menu" aria-label="Navigation principale">
            <ul class="navbar">
                <li><a href="vues/recette.php">Nos Recettes</a></li>
                <li><a href="">Aliments toxiques</a></li>
                <li><a href="">Trouver un vétérinaire</a></li>
                <li><a href="">Proposer une recette</a></li>
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
</body>
</html>
