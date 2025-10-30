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
                    a.Fecha_pub AS fechaAnuncio,
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

        public static function getAllOrderByFecha() {
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
                FROM anuncios a
                JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
                JOIN categorias c ON a.ID_Categoria = c.ID_Categoria
                ORDER BY fechaAnuncio DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    // Insertar anuncios con datos completos
    public static function insertarAnuncio($data){
        $dba = Database::getConnection();
        $stmt= $dba -> prepare("INSERT INTO anuncios (ID_Usuario,ID_Categoria,Nombre,Descripcion,Fecha_pub,Precio,Stock,Url_imagen) 
        VALUES (:usuario,:categoria,:nombre,:descripcion,:fecha,:precio,:stock,:imagen)");
        $stmt->execute($data);
    }
    public static function modificarAnuncio($data){
        $dba = Database::getConnection();
        $stmt = $dba->prepare("UPDATE anuncios SET 
            ID_Usuario = :usuario,
            ID_Categoria = :categoria,
            Nombre = :nombre,
            Descripcion = :descripcion,
            Fecha_pub = :fecha,
            Precio = :precio,
            Stock = :stock,
            Url_imagen = :imagen
            WHERE ID_Anuncio = :idAnuncio");
        $stmt->execute($data);
    }
    // Filtrar anuncios por nombre de categoría
    public static function getByCategoryName($nameCategory) {
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
                FROM anuncios a
                JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
                JOIN categorias c ON a.ID_Categoria = c.ID_Categoria
                WHERE LOWER(c.Nombre) = LOWER(:nameCategory)";
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
                    a.Fecha_pub AS fechaAnuncio,
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
                    a.Fecha_pub AS fechaAnuncio,
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
                    a.Fecha_pub AS fechaAnuncio,
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
            SELECT a.*,u.ID_Usuario as idUsuario, u.Username AS comerciante
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

    //Buscar anuncios por id de usuario del comerciante
    public static function getByIdUser($user, $limit = 6, $offset = 0){
    $db = Database::getConnection(); 

    $sql = "SELECT a.Nombre AS nombreAnuncio,
                   a.ID_Anuncio AS idAnuncio,
                   a.Descripcion AS descAnuncio,
                   a.Fecha_pub AS fechaAnuncio, 
                   a.Precio AS precioAnuncio, 
                   a.Url_Imagen AS urlImagen,
                   u.Username AS userName,
                   u.ID_Usuario AS idComerciante
            FROM anuncios a 
            JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
            WHERE u.ID_Usuario = :idUser
            LIMIT $limit OFFSET $offset";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':idUser', $user, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

    public static function EliminarById($idUsuario, $idAnuncio){
        $db = Database::getConnection();
        $sql="DELETE FROM Anuncios WHERE ID_Usuario=:id_usuario AND ID_Anuncio=:id_anuncio";
        $stmt=$db->prepare($sql);
        return $stmt->execute(['id_usuario'=>$idUsuario],
        ['id_anuncio'=>$idAnuncio]);
    }

    public static function getAnuncioById($idAnuncio){
        $db = Database::getConnection();
        //se añadio id_categoria en el ultimo update si da error algo mirar aqui
        $sql="SELECT 
                a.ID_Anuncio,
                a.ID_Categoria,
                a.ID_Usuario,
                a.Nombre AS nombreAnuncio,
                a.Descripcion AS descAnuncio,
                a.Fecha_pub AS fechaAnuncio, 
                a.Precio AS precioAnuncio, 
                a.Url_Imagen AS urlImagen,
                u.Username AS userName,
                u.ID_Usuario AS idComerciante
            FROM anuncios a
            JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
            WHERE a.ID_Anuncio = :idAnuncio";

        $stmt = $db->prepare($sql);
        $stmt->execute(['idAnuncio' => $idAnuncio]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function getTodos() {
        $db = Database::getConnection();
        $sql = "SELECT 
                    a.ID_Anuncio AS idAnuncio,
                    a.Nombre AS nombreAnuncio,
                    a.Descripcion AS descAnuncio,
                    a.Fecha_pub AS fechaAnuncio,
                    a.Precio AS precioAnuncio,
                    a.Url_imagen AS urlImagen,
                    u.Username AS userName,
                    c.Nombre AS nombreCategoria
                FROM anuncios a
                JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
                JOIN categorias c ON a.ID_Categoria = c.ID_Categoria
                ORDER BY a.Fecha_pub DESC"; // opcional: ordenar por fecha
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteById($id) {
        $db = Database::getConnection();
        $sql = "DELETE FROM anuncios WHERE ID_Anuncio = :id"; 
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    public static function getAnunciosByUser($idUsuario){
        $db= Database::getConnection();
        $sql= "SELECT a.ID_Anuncio AS idAnuncio,
                a.Nombre AS nombreAnuncio,
                a.Fecha_pub AS fechaAnuncio,
                a.Precio AS precioAnuncio,
                a.Url_imagen AS urlImagen, 
                u.ID_Usuario AS idUsuario, 
                u.Username AS userName
                FROM anuncios a JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
                WHERE a.ID_Usuario = :idUsuario
                ";
        $stmt=$db->prepare($sql);
        $stmt->execute(['idUsuario'=>$idUsuario]);
        return $stmt ->fetchAll(PDO::FETCH_OBJ);
    }




    //Para filtrar en MisAnuncios
    public static function buscarPorNombreUsuario($texto, $idUsuario) {
        $db = Database::getConnection();
        $sql = "SELECT a.ID_Anuncio AS idAnuncio,
                       a.Nombre AS nombreAnuncio,
                       a.Descripcion AS descAnuncio,
                       a.Fecha_pub AS fechaAnuncio,
                       a.Precio AS precioAnuncio,
                       a.Url_Imagen AS urlImagen,
                       u.Username AS userName,
                       u.ID_Usuario AS idComerciante
                FROM anuncios a
                JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
                WHERE a.ID_Usuario = :idUsuario AND a.Nombre LIKE :texto
                ORDER BY a.Fecha_pub DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'idUsuario' => $idUsuario,
            'texto' => "%$texto%"
        ]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getByIdUserOrdenados($idUsuario, $campo, $orden='ASC') {
        $db = Database::getConnection();

        $allowedCampos = ['fecha' => 'Fecha_pub', 'precio' => 'Precio'];
        $campoSQL = $allowedCampos[$campo] ?? 'Fecha_pub';
        $ordenSQL = strtoupper($orden) === 'DESC' ? 'DESC' : 'ASC';

        $sql = "SELECT a.ID_Anuncio AS idAnuncio,
                    a.Nombre AS nombreAnuncio,
                    a.Descripcion AS descAnuncio,
                    a.Fecha_pub AS fechaAnuncio,
                    a.Precio AS precioAnuncio,
                    a.Url_Imagen AS urlImagen,
                    u.Username AS userName,
                    u.ID_Usuario AS idComerciante
                FROM anuncios a
                JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
                WHERE a.ID_Usuario = :idUsuario
                ORDER BY $campoSQL $ordenSQL";

        $stmt = $db->prepare($sql);
        $stmt->execute(['idUsuario' => $idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getByIdUserPorCategoria($userId, $categoria) {
    $db = Database::getConnection();
    $sql = "SELECT a.ID_Anuncio AS idAnuncio,
                   a.Nombre AS nombreAnuncio,
                   a.Descripcion AS descAnuncio,
                   a.Fecha_pub AS fechaAnuncio,
                   a.Precio AS precioAnuncio,
                   a.Url_Imagen AS urlImagen,
                   u.Username AS userName,
                   u.ID_Usuario AS idComerciante,
                   c.Nombre AS nombreCategoria
            FROM anuncios a
            JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
            JOIN categorias c ON a.ID_Categoria = c.ID_Categoria
            WHERE u.ID_Usuario = :userId AND LOWER(c.Nombre) = LOWER(:categoria)";
    
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':userId' => $userId,
        ':categoria' => $categoria
    ]);

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

}