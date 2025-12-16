<?php
require_once('../modeles/recette.php');

//Récupération des filtres
$animal = $_GET["animal"] ?? null;
$type = $_GET["type"] ?? null;
$temps = $_GET["temps"] ?? null;
$niveau = $_GET["niveau"] ?? null;


if (!empty($animal) || !empty($type) || !empty($temps) || !empty($niveau)) {
    //Les recettes filtrées
    $recettes = filtreRecettes($db, $animal, $type, $temps, $niveau);
    include_once '../vues/recette.php';
} else {
    //Toutes les recettes
    $recettes = getRecettes($db);
};
?>