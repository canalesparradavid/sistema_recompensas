<?php

class DB{

    // Configuraciones de la base de datos
    private $host = "localhost";
    private $database = "sistema_recompensas";
    private $user = "root";
    private $pass = "usbw";

    private $connection;

    public function __construct(){
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->database);

        if ($this->connection->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
    }

    // Metodo estatico
    public static function connect(){
        $db = new DB();

        return $db->connection;
    }
}

?>
