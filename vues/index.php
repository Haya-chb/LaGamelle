<?php
require_once __DIR__ . '/../controleurs/VeterinaireController.php';

// Page et action
$page = $_GET['page'] ?? 'veterinaires';
$action = $_GET['action'] ?? 'index';

// On instancie le controller
$controller = new VeterinaireController();

// Appel dynamique de la méthode
if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    echo "Page introuvable";
}



