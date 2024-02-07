<?php

class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createUser($data) {
        // Implementa la lógica para crear un usuario en la base de datos
        // Asegúrate de validar los campos aquí antes de la inserción
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];

        // Ejemplo simple de validación
        if (empty($name) || empty($email) || empty($phone)) {
            return ["error" => "Todos los campos son obligatorios."];
        }

        // Continuar con la lógica de inserción en la base de datos
        // ...

        return ["success" => "Usuario creado exitosamente."];
    }

    
    public function readUser($userId) {
        // Implementa la lógica para leer un usuario de la base de datos
        // ...
    }

    public function updateUser($userId, $data) {
        // Implementa la lógica para actualizar un usuario en la base de datos
        // Asegúrate de validar los campos aquí antes de la actualización
        // ...
    }

    public function eliminarUsuario($id) {
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
}
