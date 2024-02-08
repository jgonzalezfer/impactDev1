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
            $this->db->eliminarUsuario($id);
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
            return $this->db->getUserDetails($id);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener detalles del usuario: " . $e->getMessage());
        }
    }

    // Actualizar detalles del usuario
    public function updateUser($id, $userData)
    {
        try {
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

            $folderName = $this->getFolderName($data['nombre'] . '_' . $data['apellido_paterno']);


            // Ruta completa de la carpeta
            $folderPath = __DIR__ . '/../api/' . $folderName;

            // Verificar si la carpeta ya existe
            if (!is_dir($folderPath)) {

                // Si no existe, intentar crearla
                if (!mkdir($folderPath, 0777, true)) {
                    return ["error" => "Error al crear la carpeta para el usuario."];
                }
                $this->addApiFiles($folderPath);

            }

        } catch (Exception $e) {
            die("Error al crear usuario: " . $e->getMessage());
        }
    }

    private function getFolderName($name)
    {
        // Eliminar tildes y reemplazar 'ñ'
        $folderName = str_replace(["á", "é", "í", "ó", "ú", "ñ", "Ñ"], ["a", "e", "i", "o", "u", "n", "N"], $name);

        // Eliminar espacios y convertir a minúsculas
        $folderName = strtolower(str_replace(" ", "", $folderName));

        return $folderName;
    }
    private function addApiFiles($folderPath)
    {
        // Archivos específicos de la API
        $apiFiles = ['CrearUsuarioApi.php', 'LeerUsuarioApi.php', 'ActualizarUsuarioApi.php', 'EliminarUsuarioApi.php', 'ConfiguracionUsuario.php'];

        // Copiar o crear cada archivo en la carpeta del usuario
        foreach ($apiFiles as $apiFile) {
            $sourceFile = __DIR__ . '/../plantillas/' . $apiFile;
            $destinationFile = $folderPath . '/' . $apiFile;

            // Verificar si el archivo fuente existe
            if (file_exists($sourceFile)) {
                // Copiar el archivo en la carpeta del usuario
                copy($sourceFile, $destinationFile);
            } else {
                // Crear el archivo si no existe el archivo fuente (puedes personalizar según tus necesidades)
                file_put_contents($destinationFile, "<?php\n// Contenido del archivo {$apiFile}\n?>");
            }
        }
    }


}
