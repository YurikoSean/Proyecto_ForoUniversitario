<?php

class Controlador 
{

    private $controlador;
    private $accion;
    public function _construct(Type $var = null) {
        $this->var = $var;
    }

    public function main()
    {
        
        $controlador="inicio";
        $accion="";

        if (isset($_GET["controlador"]) and !empty($_GET["controlador"]))
        {
            $controlador= $_GET["controlador"];
        }
        if (isset($_GET["accion"]) and !empty($_GET["accion"]))
        {
            $accion= $_GET["accion"];
        }
        echo $controlador . " - " . $accion;
        echo "llamo a main";

        echo "<pre>";
        print_r($_GET);
        echo "</pre>";
    }

}


?>