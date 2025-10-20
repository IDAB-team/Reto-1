<?php
require_once __DIR__ . '/Database.php';

class AnuncioModel {

    // Obtener todos los anuncios con datos completos
    public static function getAll() {
        $db = Database::getConnection();
        $sql = "SELECT 
                    a.ID_Anuncio,
                    a.Nombre AS nombreAnuncio,
                    a.Descripcion AS descripcionAnuncio,
                    a.Fecha_pub,
                    a.Precio AS precioAnuncio,
                    a.Url_imagen,
                    u.Username AS usernameAnuncio,
                    c.Nombre AS nombreCategoria
                FROM anuncios a
                JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
                JOIN categorias c ON a.ID_Categoria = c.ID_Categoria";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Filtrar anuncios por nombre de categoría
    public static function getByCategoryName($nameCategory) {
        $db = Database::getConnection();
        $sql = "SELECT 
                    a.ID_Anuncio,
                    a.Nombre AS nombreAnuncio,
                    a.Descripcion AS descripcionAnuncio,
                    a.Fecha_pub,
                    a.Precio AS precioAnuncio,
                    a.Url_imagen,
                    u.Username AS usernameAnuncio,
                    c.Nombre AS nombreCategoria
                FROM anuncios a
                JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
                JOIN categorias c ON a.ID_Categoria = c.ID_Categoria
                WHERE c.Nombre = :nameCategory";
        $stmt = $db->prepare($sql);
        $stmt->execute(['nameCategory' => $nameCategory]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Buscar anuncios por texto en el nombre
    public static function getByName($texto) {
        $db = Database::getConnection();
        $sql = "SELECT 
                    a.ID_Anuncio,
                    a.Nombre AS nombreAnuncio,
                    a.Descripcion AS descripcionAnuncio,
                    a.Fecha_pub,
                    a.Precio AS precioAnuncio,
                    a.Url_imagen,
                    u.Username AS usernameAnuncio,
                    c.Nombre AS nombreCategoria
                FROM anuncios a
                JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
                JOIN categorias c ON a.ID_Categoria = c.ID_Categoria
                WHERE a.Nombre LIKE :texto";
        $stmt = $db->prepare($sql);
        $stmt->execute(['texto' => "%$texto%"]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Ordenar anuncios por precio
    public static function orderByPrice($orden = 'ASC') {
        $db = Database::getConnection();
        $sql = "SELECT 
                    a.ID_Anuncio,
                    a.Nombre AS nombreAnuncio,
                    a.Descripcion AS descripcionAnuncio,
                    a.Fecha_pub,
                    a.Precio AS precioAnuncio,
                    a.Url_imagen,
                    u.Username AS usernameAnuncio,
                    c.Nombre AS nombreCategoria
                FROM anuncios a
                JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
                JOIN categorias c ON a.ID_Categoria = c.ID_Categoria
                ORDER BY a.Precio " . ($orden === 'DESC' ? 'DESC' : 'ASC');
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public static function orderByDate(){
        $db = Database::getConnection();
        $sql = "SELECT                     
                    a.ID_Anuncio,
                    a.Nombre AS nombreAnuncio,
                    a.Descripcion AS descripcionAnuncio,
                    a.Fecha_pub,
                    a.Precio AS precioAnuncio,
                    a.Url_imagen,
                    u.Username AS usernameAnuncio,
                    c.Nombre AS nombreCategoria
                FROM anuncios a
                JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
                JOIN categorias c ON a.ID_Categoria = c.ID_Categoria
                ORDER BY a.Fecha_pub DESC";
        $stmt = $db->prepare($sql);
        $stmt -> execute();
        return $stmt -> FetchAll(PDO::FETCH_OBJ);
    }

    // Obtener los últimos anuncios publicados
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
