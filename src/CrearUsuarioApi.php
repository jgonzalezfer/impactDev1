<?php

$userId = $_GET['userId']; 

$response = [
    'status' => 'success',
    'message' => 'API para el usuario creado correctamente',
    'user_id' => $userId,
];

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
