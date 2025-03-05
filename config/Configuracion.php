<?php

class Configuracion
{

    private static $instance=null;

    private $rutaServidor="http://localhost/ProyectosGitHub/Proyecto_ForoUniversitario";
    private $rutaBD="localhost";
    private $usuarioBD="root";
    private $passwordBD="";
    private $nombreBD="forouniversitario";


    public function __construct(Type $var = null) {
        
    }

    public static function getInstance()
    {
        if (self::$instance==null)
        {
            self::$instance= new Configuracion();
        }
        return self::$instance;
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
    public function getbombreBD()
    {
        return $this->nombreBD;
    }





}


?>