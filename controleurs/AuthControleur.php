<?php
session_start();
include("../modeles/userModele.php");

if (!isset($message)) {
    $message = "";
}

//==== INSCRIPTION ====//
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
        $message = "Ce login est déjà pris.";
    } else {
        $id_utilisateur = ajouter_utilisateur($db, $nom, $prenom, $mail, $telephone, $pseudo, $hash);

        $id_animal = ajouter_animal($db, $id_utilisateur, $nom_animal, $race, $age, $sexe, $anniv, $poids, $espece);

        $message = "Inscription réussie ! Vous pouvez vous connecter";
    }
}

//==== CONNEXION ====//
if (isset($_POST["Connexion"])) {
    $pseudo = trim($_POST['pseudo']);
    $mdp = $_POST['pswd'];
    $utilisateur = connecter($db, $pseudo, $mdp);

    if ($utilisateur && password_verify($mdp, $utilisateur['password'])) {

        $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
        $_SESSION['pseudo'] = $utilisateur['pseudo'];


        if ($utilisateur['pseudo'] === 'Nichocolat') {
            header('Location: v-admin.php');
        } else {
            header('Location: ../index.php');
        }
        exit();

    } else {
        $message = "Login ou mot de passe incorrect.";
    }
}
?>