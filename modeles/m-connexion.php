<?php

include("../connexion.php");

function connecter ($pseudo, $mdp) {

        $stmt = $db->prepare('SELECT id_utilisateur, pseudo, password FROM utilisateur WHERE pseudo = :pseudo');
        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

}    

?>