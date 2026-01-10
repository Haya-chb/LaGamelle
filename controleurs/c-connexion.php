<?php
session_start();
include("../modeles/m-connexion.php");

if (!isset($message)) { $message = ""; }

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