<?php
require_once  __DIR__ . '/../modeles/favoris.php';
require_once __DIR__ . '/c-connexion.php';

// Récupération de l'ID depuis la session
$id_user = $_SESSION['id_utilisateur'] ?? null;

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