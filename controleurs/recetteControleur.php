<?php
require_once __DIR__ . '/../modeles/recetteModele.php';

//Les recettes récentes
$newRecettes = newRecette($db);

//Récupération des filtres
$animal = $_GET["animal"] ?? null;
$type = $_GET["type"] ?? null;
$temps = $_GET["temps"] ?? null;
$niveau = $_GET["niveau"] ?? null;

//Récupération de la recherche
$search = $_GET['recherche'] ?? null;

//==== FICHE RECETTE ====//

// On récupère l'id seulement si on est sur la page de détail
$is_detail_page = (basename($_SERVER['PHP_SELF']) === 'recette-detail.php');


if ($is_detail_page) {
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
} else {
    $id_recette = 0;
    
    if (!empty($animal) || !empty($type) || !empty($temps) || !empty($niveau) || !empty($search)) {
        //Les recettes filtrées
        $recettes = filtreRecettes($db, $animal, $type, $temps, $niveau, $search);
        include_once '../vues/recette.php';
    } else {
        //Toutes les recettes
        $recettes = getRecettes($db);
    }
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

$ingredients = selectIngredients($db, $id_recette);
$commentaires = selectCommentaires($db, $id_recette);


//==== ALIMENTS DANGEREUX ====//
$dangereux = afficher_aliment($db);


//==== AJOUT DE RECETTE (CONTRIBUTION) ====//
$afficher = afficher_ingredient($db);

if (isset($_POST['action'])) {

    $id_recette = ajouter_recette($db, $_POST['nom'], $_POST['recette'], $_POST['temps'], $_POST['categorie'], $_SESSION['id_utilisateur'], $_POST['animal'], $_POST['niveau']);


    if (!empty($_POST['ingredients_existants_ids'])) {
        foreach ($_POST['ingredients_existants_ids'] as $index => $id_ing) {

            $quantite = $_POST['ingredients_quantites'][$index] . " " . $_POST['ingredients_unites'][$index];
            lier_ingredient_recette($db, $id_recette, $id_ing, $quantite);
        }
    }


    if (!empty($_POST['nouveaux_ingredients_noms'])) {

        $offset = !empty($_POST['ingredients_existants_ids']) ? count($_POST['ingredients_existants_ids']) : 0;

        foreach ($_POST['nouveaux_ingredients_noms'] as $index => $nom_ing) {
            if (!empty($nom_ing)) {
                $nouvel_id = creer_nouvel_ingredient($db, $nom_ing);


                $reelIndex = $index + $offset;
                $quantite = $_POST['ingredients_quantites'][$reelIndex] . " " . $_POST['ingredients_unites'][$reelIndex];

                lier_ingredient_recette($db, $id_recette, $nouvel_id, $quantite);
            }
        }
    }

    header("Location: ../vues/v-redirection.php");
    exit();
}
?>