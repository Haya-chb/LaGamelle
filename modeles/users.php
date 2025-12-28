<?php
require_once __DIR__ . '/../connexion.php';

//Récupération de l'utilisateur
function getUserById($db, $id){
    $stmt = $db->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Modifier le profil utilisareur 
function updateUser($db,$id, $nom, $prenom, $mail, $numero, $pseudo){
    $stmt = $db->prepare("UPDATE utilisateur SET nom_utilisateur = :nom, prenom_utilisateur = :prenom, mail = :mail, numero_utilisateur = :numero, pseudo = :pseudo WHERE id_utilisateur = :id_user");
    $stmt->execute(
        array(
            'id_user' => $id,
            "pseudo" => $pseudo,
            "nom" => $nom,
            "prenom" => $prenom,
            "mail" => $mail,
            "numero" => $numero
        )
    );
}
?>