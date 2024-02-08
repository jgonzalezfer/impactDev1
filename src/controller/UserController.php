<?php

class UserController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // eliminar usuario
    public function eliminarUsuario($id)
    {
        try {
            // Lógica para eliminar al usuario por ID
            $this->db->eliminarUsuario($id);

            // Redirigir a la página de usuarios después de la eliminación
            header('Location: home.php');
            exit();
        } catch (PDOException $e) {
            die("Error al eliminar usuario: " . $e->getMessage());
        }
    }

    // Obtener detalles del usuario por ID
    public function getUserDetails($id)
    {
        try {
            // Logic to fetch user details from the UserModel
            return $this->db->getUserDetails($id);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener detalles del usuario: " . $e->getMessage());
        }
    }

    // Actualizar detalles del usuario
    public function updateUser($id, $userData)
    {
        try {
            // Logic to update user details in the UserModel
            $this->db->updateUser($id, $userData);
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar usuario: " . $e->getMessage());
        }
    }
    // Crear un nuevo usuario
    public function createUser($data)
    {
        try {
            $result = $this->db->createUser($data);

            if (isset($result['success'])) {
                echo '<div class="alert alert-success" role="alert">' . $result['success'] . '</div>';
            } elseif (isset($result['error'])) {
                echo '<div class="alert alert-danger" role="alert">' . $result['error'] . '</div>';
            }
        } catch (Exception $e) {
            die("Error al crear usuario: " . $e->getMessage());
        }
    }


}
