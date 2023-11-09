<?php
require_once('../includes/Client.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $clientData = json_decode(file_get_contents("php://input"), true);

    if (isset($clientData['id'])) {
        $id = $clientData['id'];

        if (is_numeric($id)) {
            // El ID es válido, eliminar el cliente
            Client::delete_client_by_id($id);
        } else {
            // El ID no es válido
            header('HTTP/1.1 400 - Bad Request');
            echo json_encode(['error' => 'Customer ID is invalid']);
        }
    } else {
        // Faltan campos requeridos en la solicitud
        header('HTTP/1.1 400 - Bad Request');
        echo json_encode(['error' => 'Missing field ID in request']);
    }
} else {
    // Método no permitido
    header('HTTP/1.1 405 - Method Not Allowed');
    echo json_encode(['error' => 'Method Not Allowed']);
}


?>