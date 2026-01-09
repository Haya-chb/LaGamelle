<?php


function selectionRecette($db, $id_recette) {
    $query = $db->prepare("SELECT * FROM recette WHERE id_recette = ?");
    $query->execute([$id_recette]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function trouverPseudo($db, $id_utilisateur) {
    $stmtUser = $db->prepare("SELECT pseudo, nom_utilisateur FROM utilisateur WHERE id_utilisateur = ?");
    $stmtUser->execute([$id_utilisateur]);
    return $stmtUser->fetch(PDO::FETCH_ASSOC);
}

function selectIngredients($db, $id_recette) {
    $stmtIng = $db->prepare("SELECT i.nom_ingredient, i.image_ingredient, ir.quantite AS quantite_ingredient 
                             FROM ingredient_recette ir 
                             JOIN ingredient i ON ir.fk_ingredient = i.id_ingredient 
                             WHERE ir.fk_recette = ?");
    $stmtIng->execute([$id_recette]);
    return $stmtIng->fetchAll(PDO::FETCH_ASSOC);
}

function selectCommentaires($db, $id_recette) {
    // Note : vérifie bien que la colonne fk_recette existe dans ta table 'avis'
    $stmtComments = $db->prepare("SELECT a.id_avis, a.commentaire, a.note, a.fk_utilisateur, u.pseudo 
                                 FROM avis a 
                                 JOIN utilisateur u ON a.fk_utilisateur = u.id_utilisateur 
                                 WHERE a.fk_recette = ? 
                                 ORDER BY a.id_avis DESC");
    $stmtComments->execute([$id_recette]);
    return $stmtComments->fetchAll(PDO::FETCH_ASSOC);
}

function insererCommentaire($db, $commentaire, $note, $fk_utilisateur, $id_recette) {
    $stmtInsert = $db->prepare("INSERT INTO avis (commentaire, note, fk_utilisateur, fk_recette) VALUES (?, ?, ?, ?)");
    return $stmtInsert->execute([$commentaire, $note, $fk_utilisateur, $id_recette]);
}

































?>