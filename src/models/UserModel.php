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

    // Eliminar un usuario por su ID
    public function eliminarUsuario($id)
    {
        try {
            $query = $this->db->getConnection()->prepare("DELETE FROM usuarios WHERE id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar usuario: " . $e->getMessage());
        }
    }
    // Obtener detalles de un usuario por su ID
    public function getUserDetails($id)
    {
        try {
            $query = $this->db->getConnection()->prepare("SELECT * FROM usuarios WHERE id = :id");
            $query->bindParam(':id', $id);
            $query->execute();

            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener detalles del usuario: " . $e->getMessage());
        }
    }

    // Actualizar un usuario por su ID
    public function updateUser($userId, $userData) {
        try {
            // Construct the SQL query to update user details
            $query = "UPDATE usuarios SET 
                      nombre = :nombre,
                      apellido_paterno = :apellido_paterno,
                      apellido_materno = :apellido_materno,
                      correo = :correo,
                      telefono = :telefono,
                      contrasena = :contrasena
                      WHERE id = :id";

            // Prepare the query
            $statement = $this->db->getConnection()->prepare($query);

            // Bind parameters
            $statement->bindParam(':nombre', $userData['nombre']);
            $statement->bindParam(':apellido_paterno', $userData['apellido_paterno']);
            $statement->bindParam(':apellido_materno', $userData['apellido_materno']);
            $statement->bindParam(':correo', $userData['correo']);
            $statement->bindParam(':telefono', $userData['telefono']);
            $statement->bindParam(':contrasena', $userData['contrasena']);
            $statement->bindParam(':id', $userId);

            // Execute the query
            $statement->execute();

        } catch (PDOException $e) {
            throw new Exception("Error al actualizar usuario: " . $e->getMessage());
        }
    }
}

?>