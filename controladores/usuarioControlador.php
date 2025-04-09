<?php

class Configuracion
{
    private static $instance = null;
    private $conn;

    private $rutaServidor = "http://localhost/Proyecto_ForoUniversitario";
    private $rutaBD = "localhost";
    private $usuarioBD = "root";
    private $passwordBD = "";
    private $nombreBD = "foro_universitario";

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
mi usuarioControlador:
<?php
// Incluir el modelo de usuario para la validación de datos
require_once "../modelos/usuario.php"; 

class UsuarioExistente {

    private $usuario;
    private $apellidos;
    private $contraseña;
    private $fecha_nacimiento;
    private $email;
    private $nick;
    private $boton;
    private $modelo;

    // Constructor de la clase
    function __construct() {
        $this->modelo = new Usuario();
        $this->menUsuario();       
    }

    public function menUsuario(){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->boton = $_POST["accion"] ?? null;
            switch ($this->boton) {
                case "login":
                    $this->recibirUsuario();
                    break;
        
                case "registrar":
                   $this->registrarUsuario();
                    break;
        
                default:
                    echo "Acción no válida";
                    break;
            }
        }
    }

    public function registrarUsuario(){
        $this->usuario = $_POST["nombre"] ?? "";
        $this->apellidos = $_POST["apellidos"] ?? "";
        $this->fecha_nacimiento = $_POST["fecha_nacimiento"] ?? "";
        $this->email = $_POST["email"] ?? "";
        $this->nick = $_POST["nick"] ?? "";
        $this->contraseña = $_POST["contrasena"] ?? "";
        if (
            !empty($this->usuario) &&
            !empty($this->apellidos) &&
            !empty($this->fecha_nacimiento) &&
            !empty($this->email) &&
            !empty($this->nick) &&
            !empty($this->contraseña)
        ) {
            $this->modelo->registrarUsuario(
                $this->usuario,
                $this->apellidos,
                $this->fecha_nacimiento,
                $this->email,
                $this->nick,
                $this->contraseña
            );
            header("Location:../vistas/home/index.php");
            exit;
        } else {
            echo "❌ Todos los campos son obligatorios.";
        }
       
    }


    // Recibir los datos del formulario
    public function recibirUsuario() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Capturamos los valores del formulario
            $this->email = $_POST["email"] ?? "";
            $this->contraseña = $_POST["contrasena"] ?? "";
            $this->buscarUsuario(); // Llamamos a la validación
        } else {
            echo "Datos inválidos";
            header("Location:../vistas/home/index.php");
            exit;
        }
    }

    // Buscar usuario en la base de datos
    public function buscarUsuario() {
        $usuarioValido = $this->modelo->buscarUsuario($this->email, $this->contraseña);

        if ($usuarioValido) {
            echo "✅ Ha funcionado";
            header("Location:../vistas/perfil/index.php");
            exit;
        } else {
            echo "❌ Usuario o contraseña incorrectos.";
            header("Location:../vistas/home/index.php");
            exit;
        }
    }
}