<?php
require_once __DIR__ . '/Database.php';

class AnuncioModel {
    public static function getAll() {
        $db = Database::getConnection();
        $sqlQuery = "SELECT a.Nombre AS nombreAnuncio, a.Precio AS precioAnuncio, a.Descripcion AS descripcionAnuncio,u.Username AS usernameAnuncio
                     FROM Anuncios a
                     JOIN Usuarios u ON a.ID_Usuario = u.ID_Usuario";
        $stmt = $db->prepare($sqlQuery);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getByCategoryName($nameCategory){
        $db = Database::getConnection();
        $sqlGetByName = "SELECT a.Nombre, a.Precio, c.Nombre as nombreCategoria
                        FROM Anuncios a
                        JOIN Categorias c ON c.ID_Categoria = a.ID_Categoria
                        WHERE c.Nombre = :nameCategory";
        $stmt = $db->prepare($sqlGetByName);
        $stmt->execute(['nameCategory'=>$nameCategory]);
        return $stmt -> fetchAll();
    }
    public static function orderByPrice($orden = 'ASC') {
        $db = Database::getConnection();
        $sqlQueryPrice = "SELECT * FROM Anuncios ORDER BY Precio " . ($orden === 'DESC' ? 'DESC' : 'ASC');
        $stmt = $db->prepare($sqlQueryPrice);
        $stmt->execute();
        return $stmt->fetchAll();
    }




    public static function getUltimos($limite = 8) {
        $db = Database::getConnection();
        $sql = "
            SELECT a.*, u.Username AS comerciante
            FROM anuncios a
            JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
            ORDER BY a.Fecha_pub DESC
            LIMIT :limite
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
