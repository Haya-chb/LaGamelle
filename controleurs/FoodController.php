<?php
// 1. On inclut la connexion et le modèle
require_once __DIR__ . '/../connexion.php'; 
require_once __DIR__ . '/../modeles/alimentstoxiques.php';

// 2. On récupère les données (On crée la variable)
$dangereux = afficher_aliment($db);



