<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ("../modeles/m-contribution.php");

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