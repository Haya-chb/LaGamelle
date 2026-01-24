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


//==== FICHE RECETTE ====//
//Recette par id
function selectionRecette($db, $id_recette) {
    $query = $db->prepare("SELECT * FROM recette WHERE id_recette = ?");
    $query->execute([$id_recette]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

//les ingrédients d'une recette
function selectIngredients($db, $id_recette) {
    $stmtIng = $db->prepare("SELECT i.nom_ingredient, ir.quantite AS quantite_ingredient 
                             FROM ingredient_recette ir 
                             JOIN ingredient i ON ir.fk_ingredient = i.id_ingredient 
                             WHERE ir.fk_recette = ?");
    $stmtIng->execute([$id_recette]);
    return $stmtIng->fetchAll(PDO::FETCH_ASSOC);
}

//récup les commentaires
function selectCommentaires($db, $id_recette) {
    $stmtComments = $db->prepare("SELECT a.id_avis, a.commentaire, a.note, a.fk_utilisateur, u.pseudo 
                                 FROM avis a 
                                 JOIN utilisateur u ON a.fk_utilisateur = u.id_utilisateur 
                                 WHERE a.fk_recette = ? 
                                 ORDER BY a.id_avis DESC");
    $stmtComments->execute([$id_recette]);
    return $stmtComments->fetchAll(PDO::FETCH_ASSOC);
}

//Ajout un com
function insererCommentaire($db, $commentaire, $note, $fk_utilisateur, $id_recette) {
    $stmtInsert = $db->prepare("INSERT INTO avis (commentaire, note, fk_utilisateur, fk_recette) VALUES (?, ?, ?, ?)");
    return $stmtInsert->execute([$commentaire, $note, $fk_utilisateur, $id_recette]);
}

//==== AJOUT DE RECETTE (CONTRIBUTION) ====//
function afficher_ingredient ($db){
    $stmt = $db->query ('SELECT * FROM ingredient');
    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function ajouter_recette($db, $nom, $contenu, $temps, $categorie, $utilisateur, $animal, $niveau) {
    $stmt = $db->prepare('INSERT INTO recette (nom_recette, contenu_recette, temps, categorie_recette, fk_utilisateur, animal, niveau) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$nom, $contenu, $temps, $categorie, $utilisateur, $animal, $niveau]);
    return $db->lastInsertId(); 
}

function lier_ingredient_recette($db, $id_recette, $id_ingredient, $quantite) {
    $stmt = $db->prepare('INSERT INTO ingredient_recette (fk_recette, fk_ingredient, quantite) VALUES (?, ?, ?)');
    $stmt->execute([$id_recette, $id_ingredient, $quantite]);
}

function creer_nouvel_ingredient($db, $nom) {
    $stmt = $db->prepare('INSERT INTO ingredient (nom_ingredient) VALUES (?)');
    $stmt->execute([$nom]);
    return $db->lastInsertId();
}

//==== Aliments dangereux ====//
function afficher_aliment ($db){
    $stmt = $db->query ('SELECT * FROM dangereux');
    return $stmt->fetchall(PDO::FETCH_ASSOC);
}
?>