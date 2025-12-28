<?php
require_once __DIR__ . '/../modeles/users.php';
require_once __DIR__ . '/../modeles/favoris.php';

if (isset($_SESSION['id_utilisateur'])) {
    $user = getUserById($db, $_SESSION['id_utilisateur']);

    // Affichage des favoris de l'utilisateur
    $favoris = getFavorisByUser($db, $_SESSION['id_utilisateur']);
}

if (isset($_POST["update"])) {
    // Sécurité basique
    $idUser = $_POST['id_user'];
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $mail = trim($_POST['mail']);
    $numero = $_POST['numero'];
    $pseudo = trim($_POST['pseudo']);

    //modifier le profil
    updateUser($db, $idUser,$nom,$prenom,$mail,$numero,$pseudo);

    header('Location: ../vues/profil.php');
}
?>