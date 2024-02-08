<?php
require_once './controller/UserController.php';
require_once './models/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];
    $userData = [
        'nombre' => $_POST['nombre'],
        'apellido_paterno' => $_POST['apellido_paterno'],
        'apellido_materno' => $_POST['apellido_materno'],
        'correo' => $_POST['correo'],
        'telefono' => $_POST['telefono'],
        'contrasena' => password_hash($_POST['contrasena'], PASSWORD_DEFAULT),
    ];

    $userController = new UserController(new UserModel());

    try {
        $userController->updateUser($userId, $userData);

        header('Location: home.php');
        exit();
    } catch (Exception $e) {
        die("Error al actualizar usuario: " . $e->getMessage());
    }
} else {
    header('Location: home.php');
    exit();
}
?>
