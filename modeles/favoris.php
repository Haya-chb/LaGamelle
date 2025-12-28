<?php
require_once __DIR__ . '/../connexion.php';

//Ajout favoris
function ajoutFavoris($db, $id_user, $id_recette){
    $stmt = $db->prepare("INSERT IGNORE INTO favoris (fk_utilisateur, fk_recette) VALUES (:user, :recette)");
    $stmt->execute(['user' => $id_user, 'recette' => $id_recette]);
}

//Suppression favoris
function supFavoris($db, $id_user, $id_recette){
    $stmt = $db->prepare("DELETE FROM favoris WHERE fk_utilisateur = :user AND id_recette = :recette");
    $stmt->execute(['user' => $id_user, 'recette' => $id_recette]);
}

//Récupérer les recettes favorites d’un user
function getFavorisByUser($db, $id_user){
    $stmt = $db->prepare("SELECT * FROM recette, favoris WHERE recette.id_recette = favoris.fk_recette AND favoris.fk_utilisateur = :user");
    $stmt->execute(['user' => $id_user]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>