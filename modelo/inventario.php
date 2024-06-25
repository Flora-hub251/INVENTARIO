<?php

class inventario
{
    public $NombrePersonal;
    public $correo;
    public $salario;
    public $ciudad;
    public $horaIngreso;
    public $fechaIngreso;
    public $contrasenaInv;
    public $confirmContrasena;

    public function __construct($NombrePersonal,$correo,$salario,$ciudad,$horaIngreso,$fechaIngreso,
                                $contrasenaInv,$confirmContrasena)
    {
        $this->NombrePersonal=$NombrePersonal;
        $this->correo=$correo;
        $this->salario=$salario;
        $this->ciudad=$ciudad;
        $this->horaIngreso=$horaIngreso;
        $this->fechaIngreso=$fechaIngreso;
        $this->contrasenaInv=$contrasenaInv;
        $this->confirmContrasena=$confirmContrasena;
    }
}

?>