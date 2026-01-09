<?php
require_once __DIR__ . '/../connexion.php';

class Veterinaire
{
    // =========================
    // LISTE + RECHERCHE
    // =========================
    public static function getAll(?string $nom = null, ?string $ville = null): array
    {
        global $db; // Utilisation de la connexion définie dans connexion.php

        $sql = "SELECT * FROM veterinaires WHERE 1=1";
        $params = [];

        if (!empty($nom)) {
            $sql .= " AND (nom LIKE :nom OR prenom LIKE :nom)";
            $params['nom'] = '%' . $nom . '%';
        }

        if (!empty($ville)) {
            $sql .= " AND ville LIKE :ville";
            $params['ville'] = '%' . $ville . '%';
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================
    // FICHE VÉTÉRINAIRE
    // =========================
    public static function find(int $id): ?array
    {
        global $db; // Utilisation de la connexion définie dans connexion.php

        $stmt = $db->prepare(
            "SELECT * FROM veterinaires WHERE id_veterinaire = :id LIMIT 1"
        );
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $vet = $stmt->fetch(PDO::FETCH_ASSOC);

        return $vet ?: null;
    }
}
?>