<?php
require_once __DIR__ . '/Database.php';

class CategoriaModel {
    public static function getAll() {
        $db = Database::getConnection();
        $sqlQuery = "SELECT * FROM Categorias";
        $stmt = $db->prepare($sqlQuery);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
