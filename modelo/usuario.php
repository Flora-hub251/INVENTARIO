<?php

    class Usuario
    {
        public $Usuario;
        public $Contrasena;

        public function __construct($Usuario,$Contrasena)
        {
            $this->Usuario=$Usuario;
            $this->Contrasena=$Contrasena;
        }
    }


?>