<?php
require_once('../includes/Client.class.php');


if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Asumiendo que los datos se envían como JSON
    $clientData = json_decode(file_get_contents("php://input"), true);

    // Validación de campos
    if (
        isset($clientData['id']) &&
        isset($clientData['name']) &&
        isset($clientData['email']) &&
        isset($clientData['telephone'])
    ) {
        // Todos los campos requeridos están presentes
        Client::update_client($clientData);
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