<?php
require_once __DIR__ . '/../connexion.php';

class Food {

    public static function getAll($species = null, $type = null) {
        $db = Database::getConnection();

        $sql = "SELECT * FROM foods WHERE 1=1";
        $params = [];

        if ($species && $species !== 'all') {
            $sql .= " AND species = :species";
            $params['species'] = $species;
        }

        if ($type && $type !== 'all') {
            $sql .= " AND type = :type";
            $params['type'] = $type;
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
