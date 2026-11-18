<?php
session_start();
include_once('controleurs/recetteControleur.php');

$titre = "Accueil | La Gamelle";
$cssPage = "accueil";
require_once __DIR__ . '/composants/header.php';
?>



<?php require_once __DIR__ . '/composants/footer.php'; ?>