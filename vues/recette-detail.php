<?php
session_start();
require('../connexion.php');
include_once('../controleurs/user.php');
include_once('../controleurs/recette.php');
// Get the recipe ID from the URL
$id_recette = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_recette === 0) {
    header('Location: recette.php');
    exit();
}

// Fetch the recipe from the database
$query = $db->prepare("SELECT * FROM recette WHERE id_recette = ?");
$query->execute([$id_recette]);
$recette = $query->fetch(PDO::FETCH_ASSOC);

if (!$recette) {
    header('Location: recette.php');
    exit();
}

$imgSrc = ($recette['image_recette']);
// Load author (username) for this recipe
$author = null;
try {
    if (!empty($recette['fk_utilisateur'])) {
        $stmtUser = $db->prepare("SELECT pseudo, nom_utilisateur FROM utilisateur WHERE id_utilisateur = ?");
        $stmtUser->execute([$recette['fk_utilisateur']]);
        $author = $stmtUser->fetch(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    $author = null;
}
// Load ingredients for this recipe from the database
$ingredients = [];
try {
    $stmtIng = $db->prepare("SELECT i.nom_ingredient AS nom_ingredient, i.image_ingredient AS image_ingredient, ir.quantite AS quantite_ingredient FROM ingredient_recette ir JOIN ingredient i ON ir.fk_ingredient = i.id_ingredient WHERE ir.fk_recette = ?");
    $stmtIng->execute([$id_recette]);
    $ingredients = $stmtIng->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $ingredients = [];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($recette['nom_recette']) ?> | La Gamelle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/recette.css">
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
            <h2>Publié par <strong><?= htmlspecialchars($author['pseudo'] ?? 'Inconnu') ?></strong></h2>
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
                        <li class="ingredient-item">
                            <?php if (!empty($imgPath)): ?>
                                <img class="ingredient-img" src="<?= $imgPath ?>" alt="<?= htmlspecialchars($ingredient['nom_ingredient']) ?>">
                            <?php endif; ?>
                            <span class="ingredient-qty"><?= htmlspecialchars($ingredient['quantite_ingredient']) ?></span>
                            <span class="ingredient-name"><?= htmlspecialchars($ingredient['nom_ingredient']) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>


            </div>

            <h2>Préparation :</h2>
            <div class="recette-contenu">
                <p><?= nl2br(htmlspecialchars($recette['contenu_recette'])) ?></p>
                </section>
                
            </div>
        </section>
    </main>

    <script src="../assets/js/script.js"></script>
</body>

</html>