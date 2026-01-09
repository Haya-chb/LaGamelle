<?php
include_once('../connexion.php');
include_once('../modeles/recette-detail.php');

$id_recette = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_recette === 0) {
    header('Location: recette.php');
    exit();
}

$recette = selectionRecette($db, $id_recette);

if (!$recette) {
    header('Location: recette.php');
    exit();
}

// Gestion du formulaire de commentaire
$comment_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id_utilisateur'])) {
    $commentaire = trim($_POST['commentaire'] ?? '');
    $note = intval($_POST['note'] ?? 0);
    $fk_utilisateur = $_SESSION['id_utilisateur'];
    
    if (!empty($commentaire) && $note >= 1 && $note <= 5) {
        if (insererCommentaire($db, $commentaire, $note, $fk_utilisateur, $id_recette)) {
            header('Location: recette-detail.php?id=' . $id_recette);
            exit();
        } else {
            $comment_message = 'Erreur lors de l\'ajout.';
        }
    } else {
        $comment_message = 'Veuillez remplir tous les champs correctement.';
    }
}


$author = trouverPseudo($db, $recette['fk_utilisateur']);
$ingredients = selectIngredients($db, $id_recette);
$commentaires = selectCommentaires($db, $id_recette);
$imgSrc = $recette['image_recette'];
























?>