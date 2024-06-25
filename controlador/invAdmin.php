<?php

session_start();

include("../modelo/usuario.php");
include("DAO/conexion.php");
include("DAO/MFA.php");
include("../modelo/inventario.php");

$BDD=conectar("localhost:6666","root","","sistema de inventario");

if(isset($_POST["actualizar"]) and isset($_GET["InvAd"]))
{
    $_SESSION["idInventarioAdmin"]=$_GET["InvAd"];
    $idInventario=$_SESSION["idInventarioAdmin"];
    $nombre=$_POST["NombrePersonal"];
    $correo=$_POST["correo"];
    $salario=$_POST["salario"];
    $ciudad=$_POST["ciudad"];
    $hora=$_POST["horaIngreso"];
    $fecha=$_POST["fechaIngreso"];
    $contra=$_POST["contrasenaInv"];

    $sentencia ="UPDATE inventario SET NombrePersonal ='$nombre', correo='$correo',
                salario=$salario, ciudad='$ciudad', horaIngreso='$hora',
                fechaIngreso='$fecha', contrasenaInv='$contra' WHERE idInventario = $idInventario";
    $actualizacion=$BDD->query($sentencia);
    
    header("Location:../vista/templates/inventariosAdmin.php");
}

if(isset($_POST["cancelar"]))
{
    unset($_SESSION["InvAd"]);
    header("Location:../vista/templates/inventariosAdmin.php");
}





?>
