<?php

// Incluye el archivo de configuración de la base de datos
include('../config/database.php');

// Verifica la conexión
if ($pdo) {
    echo "Conexión exitosa a la base de datos!<br>";

    // Realiza una consulta de prueba
    $stmt = $pdo->query('SELECT * FROM usuarios');

    // Muestra los resultados
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: {$row['id']}, Nombre: {$row['nombre']}, Apellido: {$row['apellido_paterno']}, Correo: {$row['correo']}<br>";
    }
} else {
    echo "Error en la conexión a la base de datos.";
}

?>
