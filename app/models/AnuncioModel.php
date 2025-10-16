<?php
require_once __DIR__ . '/Database.php';

class AnuncioModel {
    public static function getAll() {
        $db = Database::getConnection();
        $sqlQuery = "SELECT * FROM Anuncios";
        $stmt = $db->prepare($sqlQuery);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getByNameCategory($nombreCategoria){
        $db = Database::getConnection();
        $sqlGetByName = "SELECT
                            a.Nombre as nombreAnuncio, a.Precio, c.Nombre as nombreCategoria
                        FROM
                            Anuncios a 
                        JOIN 
                            Categorias c 
                        ON
                            a.ID_Categoria = c.ID_Categoria
                        WHERE
                            c.Nombre = :nombre
                        ";
        $stmt = $db -> prepare($sqlGetByName);
        $stmt -> execute(['nombre' => $nombreCategoria]);
        return $stmt -> fetchAll();
    }

    public static function orderByPrice($orden = 'ASC') {
        $db = Database::getConnection();
        $sqlQueryPrice = "SELECT * FROM Anuncios ORDER BY Precio " . ($orden === 'DESC' ? 'DESC' : 'ASC');
        $stmt = $db->prepare($sqlQueryPrice);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
