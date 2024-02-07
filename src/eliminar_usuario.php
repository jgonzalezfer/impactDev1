<?php

// Verificar si se proporcionó un ID de usuario en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Incluir el controlador y ejecutar la acción de eliminar
    require_once './controller/UserController.php';
    require_once './models/UserModel.php';

    // Crear una instancia de UserModel
    $userModel = new UserModel();

    try {
        // Llamar al método eliminarUsuario del controlador
        $userModel->eliminarUsuario($id);

        // Redirigir a la lista de usuarios después de la eliminación
        header('Location: home.php');
        exit();
    } catch (Exception $e) {
        die("Error al eliminar usuario: " . $e->getMessage());
    }
} else {
    // Redirigir a la lista de usuarios si no se proporciona un ID válido
    header('Location: home.php');
    exit();
}