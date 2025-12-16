<?php
require_once('../modeles/users.php');
require_once('../modeles/favoris.php');

$userId = 1;
$user = getUserById($db, $userId);

// Aaffichage des favoris de l'utilisateur
$favoris = getFavorisByUser($db, $userId);
?>