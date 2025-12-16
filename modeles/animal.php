<?php 
require '../connexion.php';
function getAnimalsByUser($db, $userId){
    $stmt = $db->prepare("SELECT * FROM animal WHERE fk_utilisateur = :userId ");
    $stmt->execute(['userId' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>