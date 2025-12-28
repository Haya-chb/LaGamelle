<?php
require_once __DIR__ . '/../modeles/recette.php';

//Les recettes récentes
$newRecettes = newRecette($db);

//Récupération des filtres
$animal = $_GET["animal"] ?? null;
$type = $_GET["type"] ?? null;
$temps = $_GET["temps"] ?? null;
$niveau = $_GET["niveau"] ?? null;

//Récupération de la recherche
$search = $_GET['recherche'] ?? null;

if (!empty($animal) || !empty($type) || !empty($temps) || !empty($niveau) || !empty($search)) {
    //Les recettes filtrées
    $recettes = filtreRecettes($db, $animal, $type, $temps, $niveau, $search);
    include_once '../vues/recette.php';
} else {
    //Toutes les recettes
    $recettes = getRecettes($db);
}
?>