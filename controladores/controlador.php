<?php

class Controlador {

    public function _construct(Type $var = null) {
        $this->var = $var;
    }

    public function main()
    {
        echo "llamo a main";
    }

}


?>