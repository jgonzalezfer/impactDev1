<?php

require_once 'models/UserModel.php';

class AuthController {
    
    // Método para autenticar al usuario
    public function authenticate($email, $password) {
        // Validar campos
        if (empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'Correo electrónico y contraseña son obligatorios.'];
        }
    
        // Buscar al usuario por su correo electrónico
        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);
    
        if (!$user) {
            return ['success' => false, 'message' => 'Usuario no encontrado.'];
        }

        
    
        // Verificar la contraseña sin usar password_verify()
        if ($user['contrasena'] === $password) {
            // La contraseña es válida, el inicio de sesión es exitoso
            // Puedes realizar otras acciones aquí, como establecer variables de sesión, etc.
            return ['success' => true, 'message' => 'Inicio de sesión exitoso.'];
        } else {
            // La contraseña no coincide
            return ['success' => false, 'message' => 'Contraseña incorrecta.'];
        }


    }
}

?>
