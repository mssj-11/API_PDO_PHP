<?php
require_once('Database.class.php');



class Client {

    /**
     * Obtiene la lista de todos los clientes.
     * Método: GET
     * Ruta: /all_clients
    */
    public static function get_all_clients() {
        $db = new Database();
        $conn = $db->getConnection();
        // Prepare the query
        $query = $conn->prepare('SELECT * FROM clients');

        if ($query->execute()) {
            /*$result = $query->fetchAll();
            echo json_encode($result);*/
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
            /*$results = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                echo json_encode($result);
            }*/
            header('HTTP/1.1 201 - Client List getting successfully');
        } else {
            header('HTTP/1.1 404 - ERROR getting Client List');
        }
    }


    /**
     * Crea un nuevo cliente.
     * Método: POST
     * Ruta: /create_client
     * Datos a enviar en el cuerpo JSON:
     * {
     *     "name": "Nombre del cliente",
     *     "email": "Correo electrónico",
     *     "city": "Ciudad",
     *     "telephone": "Número de teléfono"
     * }
    */
    public static function create_client($clientData) {
        $db = new Database();
        $conn = $db->getConnection();

        // Verificar si el correo electrónico ya existe en la base de datos
        $queryCheck = $conn->prepare('SELECT COUNT(*) FROM clients WHERE email = :email');
        $queryCheck->bindParam(':email', $clientData['email']);
        $queryCheck->execute();
        $emailExists = (int)$queryCheck->fetchColumn();

        if ($emailExists > 0) {
            // El correo electrónico ya existe en la base de datos, devolver un error
            header('HTTP/1.1 400 - Bad Request');
            echo json_encode(['error' => 'The email already exists']);
            exit; // Detener la ejecución aquí
        } else {
            // Prepara la consulta para insertar un nuevo cliente
            $query = $conn->prepare('INSERT INTO clients (name, email, telephone) VALUES (:name, :email, :telephone)');
            $query->bindParam(':name', $clientData['name']);
            $query->bindParam(':email', $clientData['email']);
            $query->bindParam(':telephone', $clientData['telephone']);

            if ($query->execute()) {
                // El cliente se creó exitosamente
                header('HTTP/1.1 201 - Client Created');
                echo json_encode(['message' => 'Client created successfully']);
                exit; // Detener la ejecución aquí
            } else {
                // Hubo un error al crear el cliente
                header('HTTP/1.1 500 - Internal Server Error');
                echo json_encode(['error' => 'Internal Server Error']);
                exit; // Detener la ejecución aquí
            }
        }
    }



    /**
     * Elimina un cliente por su ID.
     * Método: DELETE
     * Ruta: /delete_client
    */
    public static function delete_client_by_id($id) {
        $db = new Database();
        $conn = $db->getConnection();
    
        // Verificar si el cliente con el ID proporcionado existe
        $queryCheck = $conn->prepare('SELECT COUNT(*) FROM clients WHERE id = :id');
        $queryCheck->bindParam(':id', $id);
        $queryCheck->execute();
        $clientExists = (int)$queryCheck->fetchColumn();
    
        if ($clientExists > 0) {
            // El cliente existe en la base de datos, proceder a eliminarlo
            $query = $conn->prepare('DELETE FROM clients WHERE id = :id');
            $query->bindParam(':id', $id);
    
            if ($query->execute()) {
                // El cliente se eliminó exitosamente
                header('HTTP/1.1 201 - Client deleted');
                echo json_encode(['message' => 'Client deleted successfully']);
                exit;
            } else {
                // Hubo un error al eliminar el cliente
                header('HTTP/1.1 500 - Internal Server Error');
                echo json_encode(['error' => 'Internal Server Error']);
                exit;
            }
        } else {
            // El cliente no existe, devolver un error
            header('HTTP/1.1 404 - Not Found');
            echo json_encode(['error' => 'Cliente not found']);
            exit;
        }
    }



    /**
     * Actualiza un cliente existente por su ID.
     * Método: PUT
     * Ruta: /update_client
     * Datos a enviar en el cuerpo JSON:
     * {
     *     "id": "ID del cliente",
     *     "name": "Nuevo nombre del cliente",
     *     "email": "Nuevo correo electrónico",
     *     "city": "Nueva Ciudad",
     *     "telephone": "Nuevo número de teléfono"
     * }
    */
    public static function update_client($clientData) {
        $db = new Database();
        $conn = $db->getConnection();

        // Verificar si el correo electrónico ya existe en la base de datos (excepto para el cliente actual)
        $queryCheck = $conn->prepare('SELECT COUNT(*) FROM clients WHERE email = :email AND id != :id');
        $queryCheck->bindParam(':email', $clientData['email']);
        $queryCheck->bindParam(':id', $clientData['id']);
        $queryCheck->execute();
        $emailExists = (int)$queryCheck->fetchColumn();

        if ($emailExists > 0) {
            // El correo electrónico ya existe en la base de datos, devolver un error
            header('HTTP/1.1 400 - Bad Request');
            echo json_encode(['error' => 'The email already exists']);
            exit;
        } else {
            // Actualiza el cliente en la base de datos
            $query = $conn->prepare('UPDATE clients SET name = :name, email = :email, telephone = :telephone WHERE id = :id');
            $query->bindParam(':name', $clientData['name']);
            $query->bindParam(':email', $clientData['email']);
            $query->bindParam(':telephone', $clientData['telephone']);
            $query->bindParam(':id', $clientData['id']);

            if ($query->execute()) {
                // El cliente se actualizó exitosamente
                header('HTTP/1.1 200 - OK');
                echo json_encode(['message' => 'Client updated successfully']);
                exit;
            } else {
                // Hubo un error al actualizar el cliente
                header('HTTP/1.1 500 - Internal Server Error');
                echo json_encode(['error' => 'Internal Server Error']);
                exit;
            }
        }
    }



    /**
     * Buscar un cliente por su ID.
     * Método: GET
     * Ruta: /search_client
    */
    public static function search_client_by_id($id) {
        $db = new Database();
        $conn = $db->getConnection();
    
        // Consulta para obtener un cliente por su ID
        $query = $conn->prepare('SELECT * FROM clients WHERE id = :id');
        $query->bindParam(':id', $id);
    
        if ($query->execute()) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                // Cliente encontrado, responder con los detalles del cliente
                header('HTTP/1.1 200 - OK');
                echo json_encode($result);
            } else {
                // Cliente no encontrado
                header('HTTP/1.1 404 - Not Found');
                echo json_encode(['error' => 'Cliente no encontrado']);
            }
        } else {
            // Hubo un error en la consulta
            header('HTTP/1.1 500 - Internal Server Error');
            echo json_encode(['error' => 'Internal Server Error']);
        }
    }




}
?>