<?php
require_once '../connexion.php';
require_once '../modeles/favoris.php';

// TEMPORAIRE
$id_user = 1;

//====SYSTEME DE FAVORIS====//
//Récupération du POST
$id_recette = $_POST['id_recette'] ?? null;
$action = $_POST['action'] ?? null;

$response = ['status' => 'error'];

if ($id_recette && $action) {
    //Ajout aux favoris
    if ($action === 'add') {
        ajoutFavoris($db, $id_user, $id_recette);
        $response = ['status' => 'added'];
    }

    //Supprime des favoris
    if ($action === 'remove') {
        supFavoris($db, $id_user, $id_recette);
        $response = ['status' => 'removed'];
    }
}

echo json_encode($response);
exit;

?>