CREATE DATABASE IF NOT EXISTS reddit_clone;
USE reddit_clone;

-- Tabla de usuarios
CREATE TABLE users (
    id SERIAL PRIMARY KEY,                 -- Identificador único
    username VARCHAR(50) UNIQUE NOT NULL,  -- Nombre de usuario único
    password_hash VARCHAR(255) NOT NULL,   -- Contraseña (encriptada)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de creación
);