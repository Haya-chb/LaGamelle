<?php
include("../connexion.php");


function selectionRecettesAValider($db) {
    $stmt = $db->prepare('SELECT * FROM recette WHERE image_recette IS NULL OR image_recette = ""');
    $stmt->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function selectionUtilisateursEtAnimaux($db) {
    $stmt = $db->prepare('SELECT u.*, GROUP_CONCAT(a.nom_animal SEPARATOR ", ") as mes_animaux 
                          FROM utilisateur u 
                          LEFT JOIN animal a ON u.id_utilisateur = a.fk_utilisateur 
                          GROUP BY u.id_utilisateur');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function selectionTousLesAvis($db) {
    $stmt = $db->prepare('SELECT av.*, u.pseudo FROM avis av 
                          JOIN utilisateur u ON av.fk_utilisateur = u.id_utilisateur');
    $stmt->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function supprimeRecette($db, $id) {
    $stmt = $db->prepare('DELETE FROM recette WHERE id_recette = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function supprimeAvis($db, $id) {
    $stmt = $db->prepare('DELETE FROM avis WHERE id_avis = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function supprimeUtilisateur($db, $id) {
    $stmt = $db->prepare('DELETE FROM utilisateur WHERE id_utilisateur = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function selectionIngredientsParRecette($db, $id_recette) {
    $stmt = $db->prepare('
        SELECT i.nom_ingredient, ir.quantite 
        FROM ingredient_recette ir
        JOIN ingredient i ON ir.fk_ingredient = i.id_ingredient
        WHERE ir.fk_recette = :id
    ');
    $stmt->execute([':id' => $id_recette]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>