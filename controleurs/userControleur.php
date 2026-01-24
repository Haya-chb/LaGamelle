<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../modeles/userModele.php';

//==== PROFIL ====//
if (isset($_SESSION['id_utilisateur'])) {
    $user = getUserWithAnimal($db, $_SESSION['id_utilisateur']);

    // Affichage des favoris de l'utilisateur
    $favoris = getFavorisByUser($db, $_SESSION['id_utilisateur']);
}

//== UPDATE INFOS PROFIL ==//
if (isset($_POST["update"])) {
    // Sécurité basique
    $idUser = $_POST['id_user'];
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $mail = trim($_POST['mail']);
    $numero = $_POST['numero'];
    $pseudo = trim($_POST['pseudo']);

    //modifier le profil
    updateUser($db, $idUser, $nom, $prenom, $mail, $numero, $pseudo);

    header('Location: ../vues/profil.php');
}

//== UPDATE INFOS ANIMAL ==//
if (isset($_POST['updateCompagnon'])) {
    $id_animal = $_POST['id-animal'];
    $nom = $_POST['nom-animal'];
    $espece = $_POST['espece'];
    $sexe = $_POST['sexe'];
    $race = $_POST['race'];
    $age = $_POST['age'];
    $anniv = $_POST['anniv'];
    $poids = $_POST['poids'];

    updateAnimal($db, $id_animal, $nom, $espece, $sexe, $race, $age, $anniv, $poids);

    header('Location: ../vues/profil.php');
    exit;
}

//== AJOUT UN ANIMAL ==//
if (isset($_POST['addAnimal'])) {
    $fk_user = $_POST['fk_user'];
    $nom = $_POST['nom-animal'];
    $espece = $_POST['espece'];
    $sexe = $_POST['sexe'];
    $race = $_POST['race'];
    $age = $_POST['age'];
    $anniv = $_POST['anniv'];
    $poids = $_POST['poids'];

    addAnimal($db, $fk_user, $nom, $espece, $sexe, $race, $age, $anniv, $poids);

    header('Location: ../vues/profil.php');
    exit;
}
?>