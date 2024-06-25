<?php
session_start();

if (isset($_POST['enviar']))
{
    echo "dentro del formulario que contiene el token";
    // Comparar el código ingresado con el código almacenado en la sesión
    if ($_POST['codigo_ingresado'] == $_SESSION['mfaCode'])
    {
        echo "dentro del token";
        // El código es correcto, permitir el acceso a la página
        // Limpiar el código almacenado en la sesión
        unset($_SESSION['mfaCode']);
        header("Location:../vista/templates/inventario.php");
    } else
    {
        // El código es incorrecto, mostrar un mensaje de error
        $error = "Código incorrecto. Inténtalo de nuevo.";
    }
}else
{
    echo "fuera de if";
}
?>