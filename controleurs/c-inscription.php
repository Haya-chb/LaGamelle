<?php
include ("../modeles/m-inscription.php");


if (isset($_POST['action']) && $_POST['action'] === 'Valider') {

    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['pswd'];
    $hash = password_hash($mdp, PASSWORD_DEFAULT); 


    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $telephone = $_POST['telephone'];
    
   
    $nom_animal = $_POST['nom_animal'];
    $race = $_POST['race'];
    $age = $_POST['age'];
    $sexe = $_POST['sexe'];
    $anniv = $_POST['anniv'];
    $poids = $_POST['poids'];
    $espece = $_POST['espece'];


    $existe = existe($db, $pseudo);

    if ($existe) {
        echo '<p> Ce login est déja prit.</p>';
    } else {
         $id_utilisateur = ajouter_utilisateur($db, $nom, $prenom, $mail, $telephone, $pseudo, $hash);

        $id_animal =ajouter_animal($db, $nom_animal, $race, $age, $sexe, $anniv, $poids, $espece);

        animal_utilisateur($db, $id_animal, $id_utilisateur);

        
        echo '<p> Inscription réussie. Vous pouvez vous connecter.</p>';
    }
}

?>