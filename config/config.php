<?php

class Configuracion
{
    private static $instance = null;
    private $conn;

    private $rutaServidor = "http://localhost/ProyectosGitHub/Proyecto_ForoUniversitario";
    private $rutaBD = "localhost";
    private $usuarioBD = "root";
    private $passwordBD = "";
    private $nombreBD = "forouniversitario";

    // Constructor privado para evitar instanciación directa
    private function __construct() {
        $this->conn = new mysqli($this->rutaBD, $this->usuarioBD, $this->passwordBD, $this->nombreBD);

        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    // Obtener la instancia única (Singleton)
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Configuracion();
        }
        return self::$instance;
    }

    // Obtener la conexión a la base de datos
    public function getConexion()
    {
        return $this->conn;
    }

    public function getRutaServidor()
    {
        return $this->rutaServidor;
    }
    public function getRutaBD()
    {
        return $this->rutaBD;
    }
    public function getUsuarioBD()
    {
        return $this->usuarioBD;
    }
    public function getPasswordBD()
    {
        return $this->passwordBD;
    }
    public function getNombreBD()
    {
        return $this->nombreBD;
    }
}

// Uso de la clase
$config = Configuracion::getInstance();
$conn = $config->getConexion();
?>