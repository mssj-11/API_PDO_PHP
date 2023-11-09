<?php
    class Database{
        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $database = 'exampleapipdo';

        public function getConnection() {
            $connDb = "mysql:host=".$this->host.";dbname=".$this->database.";";

            try {
                $conn = new PDO($connDb, $this->user, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
                // Registra el error en el archivo de registro
                error_log('ERROR: ' . $e->getMessage(), 3, $logFile);
                // Devuelve una respuesta de error genérica al usuario
                header('HTTP/1.1 500 - Internal Server Error');
                echo json_encode(['error' => 'Internal Server Error']);
            }
        }
    }
?>