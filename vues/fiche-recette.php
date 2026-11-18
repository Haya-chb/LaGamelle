<?php
session_start();
include_once('../controleurs/recetteControleur.php');
include_once('../controleurs/userControleur.php');

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

$moyenne = 0;
$totalCommentaires = count($commentaires);

if ($totalCommentaires > 0) {
    $somme = 0;
    foreach ($commentaires as $com) {
        $somme += $com['note'];
    }
    // Calcul de la moyenne arrondie à 1 décimale (ex: 4.5)
    $moyenne = round($somme / $totalCommentaires, 1);
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

</body>
</html>