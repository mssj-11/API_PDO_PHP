<?php
require_once('../includes/Client.class.php');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $clientData = json_decode(file_get_contents("php://input"), true);

    if (isset($clientData['id']) && is_numeric($clientData['id'])) {
        $id = $clientData['id'];
        // El ID es válido, buscar el cliente
        Client::search_client_by_id($id);
    } else {
        // El ID no es válido
        header('HTTP/1.1 400 - Bad Request');
        echo json_encode(['error' => 'Customer ID is valid']);
    }
} else {
    // Método no permitido
    header('HTTP/1.1 405 - Method Not Allowed');
    echo json_encode(['error' => 'Method Not Allowed']);
}



?>