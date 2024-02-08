<?php

// Verificar si se proporcionó un ID de usuario en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    require_once './controller/UserController.php';
    require_once './models/UserModel.php';

    $userModel = new UserModel();

    try {
        $userModel->eliminarUsuario($id);

        header('Location: home.php');
        exit();
    } catch (Exception $e) {
        die("Error al eliminar usuario: " . $e->getMessage());
    }
} else {
    header('Location: home.php');
    exit();
}