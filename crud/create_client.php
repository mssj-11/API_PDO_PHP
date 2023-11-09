<?php
require_once('../includes/Client.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Asumiendo que los datos se envían como JSON
    $clientData = json_decode(file_get_contents("php://input"), true);
        // Validacion campos
    if (
        isset($clientData['name']) &&
        isset($clientData['email']) &&
        isset($clientData['city']) &&
        isset($clientData['telephone'])
    ) {
        // Todos los campos requeridos están presentes
        Client::create_client($clientData);
        /* Envía una respuesta con código 201 y un mensaje en JSON
        header('HTTP/1.1 201 - Client Created');
        echo json_encode(['message' => 'Client created successfully']);*/
    } else {
        // Falta al menos uno de los campos requeridos
        header('HTTP/1.1 400 - Bad Request');
        echo json_encode(['error' => 'All fields are required']);
    }
} else {
    header('HTTP/1.1 405 - Method Not Allowed');
    echo json_encode(['error' => 'Method Not Allowed']);
}


?>