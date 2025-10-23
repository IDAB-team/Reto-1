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

}
