<?php

include ("../connexion.php");


function afficher_aliment ($db){

    $stmt = $db->query ('SELECT * FROM dangereux');
    return $stmt->fetchall(PDO::FETCH_ASSOC);
}
