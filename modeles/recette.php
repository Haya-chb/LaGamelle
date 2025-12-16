<?php
require('../connexion.php');

//Récupération de toute les recettes
function getRecettes($db)
{
    $stmt = $db->prepare("SELECT * FROM recette");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Récupération des recettes filtrées
function filtreRecettes($db, $animal, $type, $temps, $niveau){
    $sql = "SELECT * FROM recette WHERE 1=1";
    $filtres = [];

    //Ajout des filtres dynamiquement 
    if (!empty($animal)) {
        $sql .= " AND animal = :animal";
        $filtres['animal'] = $animal;
    }

    if (!empty($type)) {
        $sql .= " AND categorie = :categorie";
        $filtres['categorie'] = $type;
    }

    if (!empty($temps)) {
        $sql .= " AND temps <= :temps";
        $filtres['temps'] = $temps;
    }

    if (!empty($niveau)) {
        $sql .= " AND niveau = :niveau";
        $filtres['niveau'] = $niveau;
    }

    $stmt = $db->prepare($sql);
    $stmt->execute($filtres);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
};


?>