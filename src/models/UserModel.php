<?php

require_once 'config/database.php';

class UserModel
{

    private $db;

    public function __construct()
    {
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
    public function updateUser($userId, $userData)
    {
        try {
            $query = "UPDATE usuarios SET 
                      nombre = :nombre,
                      apellido_paterno = :apellido_paterno,
                      apellido_materno = :apellido_materno,
                      correo = :correo,
                      telefono = :telefono,
                      contrasena = :contrasena
                      WHERE id = :id";

            $statement = $this->db->getConnection()->prepare($query);

            $statement->bindParam(':nombre', $userData['nombre']);
            $statement->bindParam(':apellido_paterno', $userData['apellido_paterno']);
            $statement->bindParam(':apellido_materno', $userData['apellido_materno']);
            $statement->bindParam(':correo', $userData['correo']);
            $statement->bindParam(':telefono', $userData['telefono']);
            $statement->bindParam(':contrasena', $userData['contrasena']);
            $statement->bindParam(':id', $userId);

            $statement->execute();

        } catch (PDOException $e) {
            throw new Exception("Error al actualizar usuario: " . $e->getMessage());
        }
    }

    // Crear un nuevo usuario
    public function createUser($data)
    {
        try {
            $this->validateUserData($data);

            $hashedPassword = $this->hashPassword($data['contrasena']);

            $query = $this->db->getConnection()->prepare("
                   INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, correo, telefono, contrasena)
                   VALUES (:nombre, :apellido_paterno, :apellido_materno, :correo, :telefono, :contrasena)
               ");

            $query->bindParam(':nombre', $data['nombre']);
            $query->bindParam(':apellido_paterno', $data['apellido_paterno']);
            $query->bindParam(':apellido_materno', $data['apellido_materno']);
            $query->bindParam(':correo', $data['correo']);
            $query->bindParam(':telefono', $data['telefono']);
            $query->bindParam(':contrasena', $hashedPassword);

            $query->execute();

            echo '<div class="alert alert-success" role="alert"> Usuario creado exitosamente</div>';
            echo '<a href="home.php" class="btn btn-primary">Ir al Home</a>';

            echo '<script>setTimeout(function(){ window.location.href = "home.php"; }, 9000);</script>';


        } catch (PDOException $e) {
            throw new Exception("Error al crear usuario: " . $e->getMessage());
        }
    }

    // Hash de contraseñas
    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Validar datos del usuario
    private function validateUserData($data)
    {
        $requiredFields = ['nombre', 'apellido_paterno', 'apellido_materno', 'correo', 'telefono', 'contrasena'];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new Exception("Todos los campos son obligatorios.");
            }
        }
    }
    // Verificar si el correo ya existe en la base de datos
    public function correoExistente($correo)
    {
        try {
            $query = $this->db->getConnection()->prepare("SELECT COUNT(*) FROM usuarios WHERE correo = :correo");
            $query->bindParam(':correo', $correo);
            $query->execute();

            return $query->fetchColumn() > 0;
        } catch (PDOException $e) {
            throw new Exception("Error al verificar el correo: " . $e->getMessage());
        }
    }
}

?>