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
                    $sql = "SELECT * FROM usuario WHERE email = ? AND contrasena = ?";
                    $stmt = $this->conn->prepare($sql);
            
                    if ($stmt) {
                        $stmt->bind_param("ss", $usuario, $contraseña);
                        $stmt->execute();
                        $resultado = $stmt->get_result();
            
                        if ($resultado->num_rows > 0) {
                            return true;
                        } else {
                            return false;
                        }
            
                    } else {
                        echo "Error en la consulta: " . $this->conn->error;
                        return false;
                    }
                }
                public function registrarUsuario($nombre, $apellidos, $fecha_nacimiento, $email, $nick, $contraseña) {
                    $sql = "INSERT INTO usuario (nombre, apellidos, fecha_nacimiento, email, nick, contrasena)
                            VALUES (?, ?, ?, ?, ?, ?)";
                    
                    $stmt = $this->conn->prepare($sql);
                
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
            }