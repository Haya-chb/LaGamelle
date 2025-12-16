<?php
require '../modeles/animal.php';

$userId = 1;
$animals = getAnimalsByUser($db, $userId);
?>