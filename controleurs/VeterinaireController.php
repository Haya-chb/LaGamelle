<?php
require_once __DIR__ . '/../modeles/Veterinaire.php';

class VeterinaireController
{
    // Liste des vétérinaires + recherche
    public function index(): void
    {
        $nom   = $_GET['name'] ?? null;
        $ville = $_GET['city'] ?? null;

        $veterinaires = Veterinaire::getAll($nom, $ville);

        require __DIR__ . '/../vues/VeterinaireView.php';
    }

    // Fiche d'un vétérinaire
    public function show(): void
    {
        if (!isset($_GET['id'])) {
            header('Location: index.php?page=veterinaires&action=index');
            exit;
        }

        $id = (int) $_GET['id'];

        $vet = Veterinaire::find($id);

        if (!$vet) {
            die('Vétérinaire introuvable');
        };

        $recettesAssociees = Veterinaire::getRecettes($id);

        require __DIR__ . '/../vues/show.php';
    }
}

?>