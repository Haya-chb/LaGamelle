<?php
require_once __DIR__ . '/../modeles/alimentstoxiques.php';

class FoodController {

    public function index() {
        $species = $_GET['species'] ?? 'all';
        $type = $_GET['type'] ?? 'all';

        $dangereux = Food::getAll($species, $type);

        require __DIR__ . '/../vues/alimentsdangereuxV.php';
    }
}
