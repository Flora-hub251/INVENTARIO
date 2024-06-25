<?php

function conectar($ipservidor,$usuario,$contrasena,$dbb)
{
    $basededatos= mysqli_connect($ipservidor,$usuario,$contrasena,$dbb);
    if($basededatos==null)
    {
        //echo "No se ha establecido la conexion";
        return null; 
    }
    else
    { 
       //echo " Conexion exitosa";
       return $basededatos;
    }
}


?>