<?php
require '../modeles/animal.php';

if (isset($_SESSION['id_utilisateur'])) {
    $animaux = getAnimalsByUser($db, $_SESSION['id_utilisateur']);
}

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