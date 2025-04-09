<?php
session_start(); // Para poder usar sesiones

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

        // Asignar el rol según el nick
        $this->rol = ($this->nick === "admin") ? "admin" : "usuario"; // Si el nick es 'admin', el rol será admin, si no, 'usuario'
        
        if (
            !empty($this->usuario) &&
            !empty($this->apellidos) &&
            !empty($this->fecha_nacimiento) &&
            !empty($this->email) &&
            !empty($this->nick) &&
            !empty($this->contraseña)
        ) {
            // Verificar si ya existe un admin antes de permitir el registro de otro
            if ($this->rol === 'admin') {
                $existeAdmin = $this->modelo->verificarAdmin();
                if ($existeAdmin) {
                    echo "❌ Ya existe un usuario con el rol de admin.";
                    return;
                }
            }

            // Registrar el usuario con el rol asignado
            $this->modelo->registrarUsuario(
                $this->usuario,
                $this->apellidos,
                $this->fecha_nacimiento,
                $this->email,
                $this->nick,
                $this->contraseña,
                $this->rol // Pasar el rol determinado dinámicamente
            );
            header("Location: ../vistas/home/index.php");
            exit;
        } else {
            echo "❌ Todos los campos son obligatorios.";
        }
    }

    public function recibirUsuario() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->email = $_POST["email"] ?? "";
            $this->contraseña = $_POST["contrasena"] ?? "";
            $this->buscarUsuario();
        } else {
            echo "Datos inválidos";
            header("Location: ../vistas/home/index.php");
            exit;
        }
    }

    public function buscarUsuario() {
        $usuarioValido = $this->modelo->buscarUsuario($this->email, $this->contraseña);

        if ($usuarioValido) {
            // Guardar información en la sesión
            $_SESSION["usuario"] = [
                "email" => $usuarioValido["email"],
                "nick" => $usuarioValido["nick"],
                "rol" => $usuarioValido["rol"] ?? "usuario" // Si no existe el campo rol, se asigna "usuario" por defecto
            ];

            // Redirigir a perfil
            header("Location: ../vistas/perfil/index.php");
            exit;
        } else {
            // También podrías guardar un mensaje de error en sesión
            $_SESSION["error_login"] = "❌ Usuario o contraseña incorrectos.";
            header("Location: ../vistas/home/index.php");
            exit;
        }
    }
}

new UsuarioExistente();
?>