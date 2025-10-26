<?php
require_once __DIR__ . '/Database.php';

class AdminModel {

    protected $table = 'administradores';
    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAdminLogin($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM administradores WHERE Email = :email AND Password = :password");
        $stmt->execute([
            ':email' => $email,
            ':password' => $password
        ]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public static function crearGestor($data){
        $db = Database::getConnection();
        $stmt = $db -> prepare("INSERT INTO administradores (Username,Password,Email,Tipo) VALUES (:username,:password,:email,:tipo)");
        try {
            $stmt->execute($data);
            return true; 
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return false; // username duplicado
            } else {
                throw $e; 
            }
        }
    }
    public static function getGestores() {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT ID_Admin, Username, Email, Tipo FROM administradores WHERE Tipo = 'Gestor'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteById($email) {
        $db = Database::getConnection();
        $sql = "DELETE FROM administradores WHERE Email = :email";
        $stmt = $db->prepare($sql);
        return $stmt->execute(['email' => $email]);
    }

    public static function editarGestor($data) {
        $db = Database::getConnection();
        $sql = "UPDATE administradores 
                SET Email = :email, Password = :password 
                WHERE Email = :emailAnterior";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':email' => $data['email'],
            ':password' => $data['nuevaContraseña'],  
            ':emailAnterior' => $data['emailAnterior'],
        ]);
    }


}
