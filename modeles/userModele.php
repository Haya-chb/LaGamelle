<?php
require_once __DIR__ . '/../connexion.php';

//inscription
function existe($db, $pseudo)
{
    $check = $db->prepare('SELECT pseudo FROM utilisateur WHERE pseudo = :pseudo LIMIT 1');
    $check->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $check->execute();
    return $check->fetch(PDO::FETCH_ASSOC);
}

function ajouter_utilisateur($db, $nom, $prenom, $mail, $telephone, $pseudo, $hash)
{
    $stmt = $db->prepare('INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, mail, numero_utilisateur, pseudo, password)  VALUES (:nom, :prenom, :mail, :numero, :pseudo, :mdp)');
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->bindParam(':numero', $telephone, PDO::PARAM_STR);
    $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $stmt->bindParam(':mdp', $hash, PDO::PARAM_STR);
    $stmt->execute();
    return $db->lastInsertId();
}

function ajouter_animal($db, $id_utilisateur, $nom_animal, $race, $age, $sexe, $anniv, $poids, $espece)
{
    $stmt = $db->prepare('INSERT INTO animal (fk_utilisateur, nom_animal, race, age, sexe, anniversaire, poids, espece)  VALUES (:id_utilisateur, :nom_animal, :race, :age, :sexe, :anniv, :poids, :espece)');
    $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_STR);
    $stmt->bindParam(':nom_animal', $nom_animal, PDO::PARAM_STR);
    $stmt->bindParam(':race', $race, PDO::PARAM_STR);
    $stmt->bindParam(':age', $age, PDO::PARAM_STR);
    $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
    $stmt->bindParam(':anniv', $anniv, PDO::PARAM_STR);
    $stmt->bindParam(':poids', $poids, PDO::PARAM_STR);
    $stmt->bindParam(':espece', $espece, PDO::PARAM_STR);
    $stmt->execute();
    return $db->lastInsertId();
}

//connexion
function connecter($db, $pseudo, $mdp)
{
    $stmt = $db->prepare('SELECT id_utilisateur, pseudo, password FROM utilisateur WHERE pseudo = :pseudo');
    $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Récupération de l'utilisateur et de son/ses animal/animaux
function getUserWithAnimal($db, $id)
{
    $stmt = $db->prepare("SELECT utilisateur.*, animal.*
        FROM utilisateur
        INNER JOIN animal
            ON animal.fk_utilisateur = utilisateur.id_utilisateur
        WHERE utilisateur.id_utilisateur = :id
        ");
    $stmt->execute(['id' => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Modifier le profil utilisareur 
function updateUser($db, $id, $nom, $prenom, $mail, $numero, $pseudo)
{
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
    // Il est préférable de lister les colonnes pour éviter les erreurs d'index
    $requete = $db->prepare("INSERT INTO animal (nom_animal, race, age, sexe, anniversaire, poids, espece, fk_utilisateur) 
                             VALUES (:nom_animal, :race, :age, :sexe, :anniversaire, :poids, :espece, :fk_utilisateur)");

    $requete->execute(
        array(
            "nom_animal" => $nom,
            "race" => $race,
            "age" => $age,
            "sexe" => $sexe,
            "anniversaire" => $anniv,
            "poids" => $poids,
            "espece" => $espece,
            "fk_utilisateur" => $fk_user
        )
    );
}

//sup un animal
function supAnimal($db, $id)
{
    $stmt = $db->prepare("DELETE FROM animal WHERE id_animal = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

//Ajout favoris
function ajoutFavoris($db, $id_user, $id_recette)
{
    $stmt = $db->prepare("INSERT IGNORE INTO favoris (fk_utilisateur, fk_recette) VALUES (:user, :recette)");
    $stmt->execute(['user' => $id_user, 'recette' => $id_recette]);
}

//Suppression favoris
function supFavoris($db, $id_user, $id_recette)
{
    $stmt = $db->prepare("DELETE FROM favoris WHERE fk_utilisateur = :user AND fk_recette = :recette");
    $stmt->execute(['user' => $id_user, 'recette' => $id_recette]);
}

//Récupérer les recettes favorites d’un user
function getFavorisByUser($db, $id_user)
{
    $stmt = $db->prepare("SELECT recette.*, favoris.*
                            FROM recette
                            INNER JOIN favoris
                                ON recette.id_recette = favoris.fk_recette 
                            WHERE favoris.fk_utilisateur = :user");
    $stmt->execute(['user' => $id_user]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>