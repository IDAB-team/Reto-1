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

    public function getUsuarioByEmail($email) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE Email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public static function editarDatos($datos){
        $db = Database::getConnection();
        $sql = "UPDATE usuarios SET Email = :email, Password = :nuevaContrasena WHERE Username = :usuario";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            "usuario" => $datos["usuario"],
            "nuevaContrasena" => $datos['nuevaContraseña'],
            "email" => $datos['email'],
        ]);
    }

    public static function devolverContraseña() {
        $db = Database::getConnection();
        $nombre = $_SESSION["user"]["nombre"];
        $sql = "SELECT Password FROM usuarios WHERE Username = :nombre";
        $stmt = $db->prepare($sql);
        $stmt->execute(['nombre' => $nombre]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado['Password'];
        }
    }
    
    public static function devolverIdUsuario(){
        $dba = Database::getConnection();
        $nombre = $_SESSION["user"]["nombre"];
        $stmt = $dba -> prepare("SELECT ID_Usuario FROM usuarios WHERE Username = :nombre");
        $stmt -> execute(["nombre" => $nombre]);
        $resultado = $stmt ->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado['ID_Usuario'];
        }
    }
    public static function getClientes() {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT ID_Usuario, CIF, Username, Email, Tipo FROM usuarios WHERE Tipo = 'Cliente'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getComerciantes() {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT ID_Usuario, CIF, Username, Email, Tipo FROM usuarios WHERE Tipo = 'Comerciante'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAll() {
        
    }
    
    public static function deleteById($email) {
        $db = Database::getConnection();
        $sql = "DELETE FROM usuarios WHERE Email = :email";
        $stmt = $db->prepare($sql);
        return $stmt->execute(['email' => $email]);
    }
    
    public static function deleteAll() {
        
    }
}