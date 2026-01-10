<?php
require_once __DIR__ . '/../connexion.php';

//Récupération de toute les recettes
function getRecettes($db)
{
    $stmt = $db->prepare("SELECT * FROM recette ORDER BY id_recette DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Récupération des recettes récentes
function newRecette($db){
    $stmt = $db->prepare("SELECT * FROM recette ORDER BY id_recette DESC LIMIT 4");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Récupération des recettes filtrées
function filtreRecettes($db, $animal, $type, $temps, $niveau, $search){
    $sql = "SELECT * FROM recette WHERE 1=1";
    $filtres = [];

    //Ajout des filtres dynamiquement 
    if (!empty($animal)) {
        $sql .= " AND animal = :animal";
        $filtres['animal'] = $animal;
    }

    if (!empty($type)) {
        $sql .= " AND categorie_recette = :categorie_recette";
        $filtres['categorie_recette'] = $type;
    }

    if (!empty($temps)) {
        $sql .= " AND temps <= :temps";
        $filtres['temps'] = $temps;
    }

    if (!empty($niveau)) {
        $sql .= " AND niveau = :niveau";
        $filtres['niveau'] = $niveau;
    }

    //Recherche des recettes
    if (!empty($search)) {
        $sql .= " AND (
            nom_recette LIKE :search
            OR categorie_recette LIKE :search
        )";
        $filtres['search'] = '%' . $search . '%';
    }

    $stmt = $db->prepare($sql);
    $stmt->execute($filtres);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
};

?>