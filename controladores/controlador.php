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

        if (isset($_GET["controllador"]) and !empty($_GET["controlador"]))
        {
            $controlador= $_GET["controllador"];
        }
        if (isset($_GET["accion"]) and !empty($_GET["accion"]))
        {
            $accion= $_GET["accion"];
        }

        if (file_exists("./controladores/".ucfirst($controlador)."controlador.php")) 
        {
          echo "Existe controlador";
        }   
        else {
            echo "No existe controlador";
        }

        /*
        require_once("./controladores/".ucfirst($controlador)."controlador.php");
        $nombreClase=ucfirst($controlador)."controlador";
        if($accion!="")
        {
            if (method_exists($contro,$accion))
            {
                $contro->accion();
            }
            else {
                $data["errorvalidacion"]="Imposible realizar la acción";
                require_once("./vistas/vista.php");
                $vista= new vista();
                $vista->render("inicio",$data);
            }
        }
        else 
        {
            require_once("./controladores/inicioControlador.php");
            $contro=new inicioControlador();
            $contro->irAInicio();
        }

        else
        {
            require_once("./controladores/inicioControlador.php");
            $contro=new inicioControlador();
            $contro->irAInicio();
        }

        */



        echo $controlador . " - " . $accion;
        echo "llamo a main";

        echo "<pre>";
        print_r($_GET);
        echo "</pre>";
    }

}


?>