<?php
require_once "../config/config.php";

class Usuario {
    private $conn;

    public function __construct() {
        // Obtenemos la instancia única de Configuracion y su conexión
        $config = Configuracion::getInstance();
        $this->conn = $config->getConexion();
        // Verificar si la conexión es válida
        if ($this->conn->connect_error) {
        die("❌ Error de conexión: " . $this->conn->connect_error);
    }
    }

    public function buscarUsuario($usuario, $contraseña) {
        $sql = "SELECT id_usuario, nombre, apellidos, fecha_nacimiento, email, nick, contrasena, rol 
                FROM usuario WHERE email = ?";
        
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $usuario); // Parametro de tipo string
            $stmt->execute();
            $resultado = $stmt->get_result();
    
            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                $hash = $fila['contrasena'];
    
                // Verificar la contraseña ingresada con el hash guardado
                if (password_verify($contraseña, $hash)) {
                    // Devolvemos los datos del usuario para guardarlos en sesión
                    return $fila; // Devuelve todos los datos relevantes del usuario
                } else {
                    return false; // Contraseña incorrecta
                }
            } else {
                return false; // No existe ese email
            }
        } else {
            echo "❌ Error en la consulta: " . $this->conn->error;
            return false; // Error al ejecutar la consulta
        }
    }

    public function registrarUsuario($nombre, $apellidos, $fecha_nacimiento, $email, $nick, $contraseña, $rol = 'usuario') {
        var_dump($nombre, $apellidos, $fecha_nacimiento, $email, $nick, $contraseña, $rol);
        // Verificar si el código llega aquí
        echo "Método registrarUsuario ejecutado"; 
    
        // Si el rol es 'admin', primero verifica que no exista otro admin
        if ($rol === 'admin' && $this->verificarAdmin()) {
            echo "❌ Ya existe un usuario con el rol de admin.";
            return;
        }
    
        $sql = "INSERT INTO usuario (nombre, apellidos, fecha_nacimiento, email, nick, contrasena, rol)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
    
        // Cifrar la contraseña antes de insertarla
        $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
    
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("sssssss", $nombre, $apellidos, $fecha_nacimiento, $email, $nick, $contraseña, $rol);
    
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
    // Verificar si ya existe un admin
    public function verificarAdmin() {
        $sql = "SELECT COUNT(*) FROM usuario WHERE rol = 'admin'";
        $resultado = $this->conn->query($sql);
        $fila = $resultado->fetch_row();
        return $fila[0] > 0; // Si ya hay un admin, devuelve true
    }
}
?>