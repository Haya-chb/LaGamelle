<?php

include ("../connexion.php");


function existe($db, $pseudo) {

    $check = $db->prepare('SELECT pseudo FROM utilisateur WHERE pseudo = :pseudo LIMIT 1');
    $check->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $check->execute();
    return $check->fetch(PDO::FETCH_ASSOC);

}

function ajouter_utilisateur($db, $nom, $prenom, $mail, $telephone, $pseudo, $hash) {

$stmt = $db->prepare('INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, mail, numero_utilisateur, pseudo, password)  VALUES (:nom, :prenom, :mail, :numero, :pseudo, :mdp)');
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->bindParam(':numero', $telephone, PDO::PARAM_STR);
    $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $stmt->bindParam(':mdp', $hash, PDO::PARAM_STR);
    $stmt->execute();
    return $db->lastInsertId();

}

function ajouter_animal($db, $nom_animal, $race, $age, $sexe, $anniv, $poids, $espece) {

$stmt = $db->prepare('INSERT INTO animal (nom_animal, race, age, sexe, anniversaire, poids, espece)  VALUES (:nom_animal, :race, :age, :sexe, :anniv, :poids, :espece)');
    $stmt->bindParam(':nom_animal', $nom_animal, PDO::PARAM_STR);
    $stmt->bindParam(':race', $race, PDO::PARAM_STR);
    $stmt->bindParam(':age', $age, PDO::PARAM_STR);
    $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
    $stmt->bindParam(':anniv', $anniv, PDO::PARAM_STR);
    $stmt->bindParam(':poids', $poids, PDO::PARAM_STR);
    $stmt->bindParam(':espece', $espece, PDO::PARAM_STR);
    $stmt->execute();
    return $db->lastInsertId();
}






function animal_utilisateur($db, $id_animal, $id_utilisateur) {

$stmt = $db->prepare('INSERT INTO animal_utilisateur ( fk_animal, fk_utilisateur )  VALUES (:id_animal, :id_utilisateur)');
    $stmt->bindParam(':id_animal', $id_animal, PDO::PARAM_STR);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_STR);
    $stmt->execute();
}











?>


