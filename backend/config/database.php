<?php

class conexionPDO {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'dash_seguros';
    private $conexion;

    public function __construct() {
        $this->connection();
    }

    private function connection() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
            $this->conexion = new PDO($dsn, $this->user, $this->pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die(json_encode([
                'success' => false,
                'message' => 'Error de conexión: ' . $e->getMessage()
            ]));
        }
        
    }

    public function getConexion() {
        return $this->conexion;
    }


    
}



/*try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //wecho "conexion exitosa";
} catch(PDOException $e) {
    die(json_encode([
        'success' => false,
        'message' => 'Error de conexión: ' . $e->getMessage()
    ]));
}*/

?>
