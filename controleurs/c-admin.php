<?php

require_once('../modeles/m-admin.php');

$page = $_GET['admin'] ?? 'Recettes';
$recettes = [];
$utilisateurs = [];
$avis = [];


if (isset($_POST['action_admin'])) {
    if ($_POST['action_admin'] === 'supprimer_recette') supprimeRecette($db, $_POST['id']);
    if ($_POST['action_admin'] === 'supprimer_avis') supprimeAvis($db, $_POST['id']);
    if ($_POST['action_admin'] === 'supprimer_user') supprimeUtilisateur($db, $_POST['id']);
}

// Récupération des données selon l'onglet
if ($page === 'Recettes') $recettes = selectionRecettesAValider($db);
if ($page === 'Utilisateurs') $utilisateurs = selectionUtilisateursEtAnimaux($db);
if ($page === 'Avis') $avis = selectionTousLesAvis($db);


if (isset($_POST['valider']) && isset($_FILES['image_recette'])) {
    $id = $_POST['id_recette'];
    $nom_image = $_FILES['image_recette']['name'];
    $destination = "../assets/images/recettes/" . $nom_image;


    if (move_uploaded_file($_FILES['image_recette']['tmp_name'], $destination)) {
        
       
        publierRecetteAvecImage($db, $id, $nom_image);
        
        $message = "La recette a été publiée avec succès !";
    }
}

?>