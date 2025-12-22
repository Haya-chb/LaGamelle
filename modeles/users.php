<?php
require_once __DIR__ . '/../connexion.php';

function getUserById($db, $id){
    $stmt = $db->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Récupération de l'utilisateur
/*function getUserByPseudo($db, $pseudo){
    $stmt = $db->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
    $stmt->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Modifier un utilisareur 
function updateUser($db, $id, $pseudo, $role, $img){
    $stmt = $db->prepare("UPDATE utilisateur SET pseudo = :pseudo, role = :role, photo = :photo WHERE id_user = :id_user");
    $stmt->execute(
        array(
            'id_user' => $id,
            "pseudo" => $pseudo,
            "role" => $role,
            "photo" => $img
        )
    );
}*/
?>