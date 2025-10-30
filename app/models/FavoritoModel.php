<?php
require_once __DIR__ . '/Database.php';

class FavoritoModel {
    
   public static function obtenerFavoritos($id_usuario, $categoria = null) {
    $db = Database::getConnection();
    $sql = "SELECT 
                a.ID_Anuncio,
                a.Nombre AS nombreAnuncio,
                a.Descripcion AS descripcionAnuncio,
                a.Fecha_pub AS fechaAnuncio,
                a.Precio AS precioAnuncio,
                a.Url_imagen,
                u.Username AS usernameAnuncio,
                c.Nombre AS nombreCategoria
            FROM favoritos f
            JOIN anuncios a ON f.ID_Anuncio = a.ID_Anuncio
            JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
            JOIN categorias c ON a.ID_Categoria = c.ID_Categoria
            WHERE f.ID_Usuario = :id_usuario";

    $params = ['id_usuario' => $id_usuario];

    if ($categoria) {
        $sql .= " AND c.Nombre = :categoria";
        $params['categoria'] = $categoria;
    }

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


    public static function existeFavorito($id_usuario, $id_anuncio) {
        $db = Database::getConnection();
        $sql = "SELECT * FROM favoritos WHERE ID_Usuario = :id_usuario AND ID_Anuncio = :id_anuncio";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'id_usuario' => $id_usuario,
            'id_anuncio' => $id_anuncio
        ]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function obtenerIdsFavoritos($id_usuario) {
        $db = Database::getConnection();
        $sql = "SELECT ID_Anuncio FROM favoritos WHERE ID_Usuario = :id_usuario";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id_usuario' => $id_usuario]);
        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'ID_Anuncio');
    }

    public static function agregarFavorito($id_usuario,$id_anuncio){
        $db = Database::getConnection();
        $sql = "INSERT INTO favoritos(ID_Usuario,ID_Anuncio)
                 VALUES(:id_usuario,:id_anuncio)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'id_usuario'=>$id_usuario,
            'id_anuncio'=>$id_anuncio
        ]);
    }

    public static function eliminarFavorito($id_usuario, $id_anuncio) {
        $db = Database::getConnection();
        $sql = "DELETE FROM favoritos WHERE ID_Usuario = :id_usuario AND ID_Anuncio = :id_anuncio";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'id_usuario' => $id_usuario,
            'id_anuncio' => $id_anuncio
        ]);
    }

    public static function ordenarPorFecha($id_usuario) {
        $db = Database::getConnection();
        $sql = "SELECT a.ID_Anuncio, a.Nombre AS nombreAnuncio, a.Descripcion AS descripcionAnuncio,
                    a.Fecha_pub AS fechaAnuncio, a.Precio AS precioAnuncio, a.Url_imagen,
                    u.Username AS usernameAnuncio, c.Nombre AS nombreCategoria
                FROM favoritos f
                JOIN anuncios a ON f.ID_Anuncio = a.ID_Anuncio
                JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
                JOIN categorias c ON a.ID_Categoria = c.ID_Categoria
                WHERE f.ID_Usuario = :id_usuario
                ORDER BY a.Fecha_pub DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id_usuario' => $id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

public static function ordenarPorPrecio($id_usuario, $orden = 'ASC') {
    $db = Database::getConnection();
    $sql = "SELECT a.ID_Anuncio, a.Nombre AS nombreAnuncio, a.Descripcion AS descripcionAnuncio,
                   a.Fecha_pub AS fechaAnuncio, a.Precio AS precioAnuncio, a.Url_imagen,
                   u.Username AS usernameAnuncio, c.Nombre AS nombreCategoria
            FROM favoritos f
            JOIN anuncios a ON f.ID_Anuncio = a.ID_Anuncio
            JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
            JOIN categorias c ON a.ID_Categoria = c.ID_Categoria
            WHERE f.ID_Usuario = :id_usuario
            ORDER BY a.Precio $orden";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id_usuario' => $id_usuario]);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

public static function buscarFavoritosPorNombre($id_usuario, $texto) {
    $db = Database::getConnection();
    $sql = "SELECT 
        a.ID_Anuncio,
        a.Nombre AS nombreAnuncio,
        a.Descripcion AS descripcionAnuncio,
        a.Fecha_pub AS fechaAnuncio,
        a.Precio AS precioAnuncio,
        a.Url_imagen,
        u.Username AS usernameAnuncio,
        c.Nombre AS nombreCategoria
        FROM favoritos f
        JOIN anuncios a ON f.ID_Anuncio = a.ID_Anuncio
        JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
        JOIN categorias c ON a.ID_Categoria = c.ID_Categoria
        WHERE f.ID_Usuario = :id_usuario AND a.Nombre LIKE :texto";
    
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'id_usuario' => $id_usuario,
        'texto' => "%$texto%"
    ]);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

    
}