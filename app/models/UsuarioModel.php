<?php
require_once __DIR__ . '/Database.php';

class UsuarioModel {
    
    public static function getUsuarioLogin($email, $password) {
        // Obtener conexión
        $db = Database::getConnection();

        // Consulta: buscar por Email y contraseña
        $sql = "SELECT ID_Usuario, Username, Password, Email, Tipo 
                FROM usuarios 
                WHERE Email = :email AND Password = :password";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'password' => $password
        ]);

        // Retornar el usuario si existe, o false
        return $stmt->fetch();
    }

    public static function create($datos) {
        $db = Database::getConnection();

        $sql = "INSERT INTO usuarios (CIF, Username, Password, Email, Tipo) 
                VALUES (:cif, :username, :password, :email, :tipo)";
        
        $stmt = $db->prepare($sql);

        return $stmt->execute([
            'cif' => $datos['cif'] ?? null,
            'username' => $datos['username'],
            'password' => $datos['password'],
            'email' => $datos['email'],
            'tipo' => $datos['tipo']
        ]);
    }


    public static function getAll() {
        
    }
    
    public static function getById($id) {
        
    }
    
    public static function deleteById($id) {
        
    }
    
    public static function deleteAll() {
        
    }
}