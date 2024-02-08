<?php
require_once './models/UserModel.php';

class Validador
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    // Verificar si el correo ya existe en la base de datos
    public function validarCorreoExistente($correo)
    {
        if ($this->userModel->correoExistente($correo)) {
            return ["error" => "El correo ya está registrado."];
        }

        return ["success" => "Correo válido."];
    }

}


?>