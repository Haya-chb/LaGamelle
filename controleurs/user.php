<?php
require_once('../modeles/users.php');
require_once('../modeles/favoris.php');

$userId = 1;
$user = getUserById($db, $userId);


//Supprime des favoris
if (isset($_GET['action'], $_GET['id_recette'])) {
    //$idRecette = $_GET['id_recette'];
    supFavoris($db, $userId, $_GET['id_recette']);
    header('Location: ../vues/profil.php');
}

// puis affichage normal de la page
$favoris = getFavorisByUser($db, $userId);
?>