<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CRUD de Usuarios</title>
  <!-- Agrega los enlaces a Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="container mt-5">
    <h2 class="mb-4">CRUD de Usuarios</h2>

    <!-- Tabla para mostrar los usuarios -->
    <table class="table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>Teléfono</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require_once './config/database.php';
        require_once './models/UserModel.php';

        $userModel = new UserModel();

        try {
          // Obtener todos los usuarios (modifica según tu necesidad)
          $users = $userModel->getAllUsers();

          foreach ($users as $user) {
            echo '<tr>
                        <td>' . $user['nombre'] . '</td>
                        <td>' . $user['apellido_paterno'] . '</td>
                        <td>' . $user['apellido_materno'] . '</td>
                        <td>' . $user['correo'] . '</td>
                        <td>' . $user['rol'] . '</td>
                        <td>' . $user['telefono'] . '</td>
                        <td>
                        <a href="editar_usuario.php?id='. $user['id'] . '" class="btn btn-warning btn-sm" onclick="return confirm(\'¿Estás seguro de que deseas Editar este usuario?\')" >Editar</a>
                        <a href="eliminar_usuario.php?id='. $user['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este usuario?\')">Eliminar</a>
                          </td>
                      </tr>';
          }
        } catch (PDOException $e) {
          die("Error al obtener usuarios: " . $e->getMessage());
        }
        ?>
      </tbody>
    </table>

    <a href="#" class="btn btn-success">Agregar Nuevo Usuario</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>