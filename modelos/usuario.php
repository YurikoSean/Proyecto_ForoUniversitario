<?php
require_once "../config/config.php";

class Usuario {
    private $conn;

    public function __construct() {
        // Obtenemos la instancia única de Configuracion y su conexión
        $config = Configuracion::getInstance();
        $this->conn = $config->getConexion();

    }

    public function buscarUsuario($usuario, $contraseña) {
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $resultado = $stmt->get_result();
    
            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                $hash = $fila['contrasena'];
    
                // Verificar la contraseña ingresada con el hash guardado
                if (password_verify($contraseña, $hash)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false; // No existe ese email
            }
    
        } else {
            echo "Error en la consulta: " . $this->conn->error;
            return false;
        }
    }
    public function registrarUsuario($nombre, $apellidos, $fecha_nacimiento, $email, $nick, $contraseña) {
        if ($this->existeNickOCorreo($nick, $email)) {
            echo "❌ El nick o correo ya está registrado.";
            return;
        }
    
        $sql = "INSERT INTO usuario (nombre, apellidos, fecha_nacimiento, email, nick, contrasena)
                VALUES (?, ?, ?, ?, ?, ?)";
    
        if ($stmt) {
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
            $stmt->bind_param("ssssss", $nombre, $apellidos, $fecha_nacimiento, $email, $nick, $contraseña);
    
            if ($stmt->execute()) {
                echo "✅ Usuario registrado correctamente.";
            } else {
                echo "❌ Error al registrar usuario: " . $stmt->error;
            }
    
            $stmt->close();
        } else {
            echo "❌ Error en la preparación de la consulta: " . $this->conn->error;
        }
    }
    /* NUEVA FUNCION PARA VER SI EL USUARIO EXISTE NICK O CORREO */
    public function existeNickOCorreo($nick, $email) {
        $sql = "SELECT id FROM usuario WHERE nick = ? OR email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $nick, $email);
        $stmt->execute();
        $stmt->store_result();
    
        return $stmt->num_rows > 0; // Devuelve true si ya existe
    }
}