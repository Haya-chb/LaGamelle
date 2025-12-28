<?php
require '../connexion.php';

//Récup l'animal associé au gardien
function getAnimalsByUser($db, $userId)
{
    $stmt = $db->prepare("SELECT * FROM animal WHERE fk_utilisateur = :userId ");
    $stmt->execute(['userId' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Modifier le profil utilisareur 
function updateAnimal($db, $id, $nom, $espece, $sexe, $race, $age, $anniv, $poids)
{
    $stmt = $db->prepare("UPDATE animal SET nom_animal = :nom, race = :race, age = :age, sexe = :sexe, anniversaire = :anniversaire, poids = :poids, espece = :espece  WHERE id_animal= :id_animal");
    $stmt->execute(
        array(
            'id_animal' => $id,
            "nom" => $nom,
            "espece" => $espece,
            "sexe" => $sexe,
            "race" => $race,
            "age" => $age,
            "anniversaire" => $anniv,
            "poids" => $poids
        )
    );
}

//Ajouter un animal
function addAnimal($db, $fk_user, $nom, $espece, $sexe, $race, $age, $anniv, $poids)
{
    $requete = $db->prepare("INSERT INTO animal VALUES (0, :nom_animal, :race, :age, :sexe, :anniversaire, :poids, :espece, :fk_utilisateur)");
    $requete->execute(
        array(
            "nom_animal" => $nom,
            "espece" => $espece,
            "sexe" => $sexe,
            "race" => $race,
            "age" => $age,
            "anniversaire" => $anniv,
            "poids" => $poids,
            "fk_utilisateur" => $fk_user
        )
    );
}

//Sup l'animal
function supAnimal($db, $id)
{
    $stmt = $db->prepare("DELETE FROM animal WHERE id_animal = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}
?>