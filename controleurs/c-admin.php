<?php

require_once('../modeles/m-admin.php');

$page = $_GET['admin'] ?? 'Recettes';
$recettes = [];
$utilisateurs = [];
$avis = [];

// Gestion des actions (Suppression/Validation)
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

    // 1. On déplace le fichier physiquement sur le serveur
    if (move_uploaded_file($_FILES['image_recette']['tmp_name'], $destination)) {
        
        // 2. On met à jour la BDD (il faudra créer cette fonction dans ton modèle)
        publierRecetteAvecImage($db, $id, $nom_image);
        
        // 3. Petit message de succès
        $message = "La recette a été publiée avec succès !";
    }
}

?>