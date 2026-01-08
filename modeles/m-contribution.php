<?php

include ("../connexion.php");


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