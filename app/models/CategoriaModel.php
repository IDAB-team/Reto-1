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

    public static function devolverIdCategoria($nombre){
        $dba= Database::getConnection();
        $stmt = $dba ->prepare("SELECT ID_Categoria FROM categorias WHERE Nombre = :nombre");
        $stmt -> execute(["nombre" => $nombre]);
        $resultado = $stmt ->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado['ID_Categoria'];
        }
    }
    public static function devolverNombreCategoria($id){
        $dba= Database::getConnection();
        $stmt = $dba ->prepare("SELECT Nombre FROM categorias WHERE ID_Categoria = :id");
        $stmt -> execute(["id" => $id]);
        $resultado = $stmt ->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado;
        }
    }
}
