<?php

require_once 'config/database.php';

class UserModel
{

    private $db;

    public function __construct()
    {
        // Configura la conexión a la base de datos
        $dbConfig = [
            'host' => 'localhost',
            'dbname' => 'impactdev',
            'username' => 'root',
            'password' => ''
        ];

        $this->db = new Database($dbConfig['host'], $dbConfig['dbname'], $dbConfig['username'], $dbConfig['password']);
    }

    // Obtener un usuario por su correo electrónico
    public function getUserByEmail($email)
    {
        try {
            $query = $this->db->getConnection()->prepare("SELECT * FROM usuarios WHERE correo = :email");
            $query->bindParam(':email', $email);
            $query->execute();

            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error de consulta: " . $e->getMessage());
        }
    }

    // Obtener todos los usuarios
    public function getAllUsers()
    {
        try {
            $query = $this->db->getConnection()->prepare("SELECT * FROM usuarios");
            $query->execute();

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error de consulta: " . $e->getMessage());
        }
    }
}

?>