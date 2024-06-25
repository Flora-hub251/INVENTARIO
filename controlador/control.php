<?php

session_start();

include("../modelo/usuario.php");
include("DAO/conexion.php");
include("../modelo/inventario.php");

/*require_once 'dompdf/autoload.inc.php'; // Incluye el archivo de autoload de dompdf
use Dompdf\Dompdf;*/

$BDD=conectar("localhost:6666","root","","sistema de inventario");

if(isset($_SESSION["idUsuario"]))
{
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <div>
                <form method="post" action="acceso.php">
                    <label for="codigo">Introduce el código:</label>
                    <input type="text" id="codigo" name="codigo_ingresado" required>
                    <input type="submit" value="ENVIAR" name="enviar">
                </form>
            </div>
        
        </body>
        </html>

    <?php

    $mfaCode = rand(100000, 999999); // Generar un código MFA de seis dígitos aleatorio (simulado).
    $_SESSION['mfaCode']=$mfaCode;

    // Aquí enviarías el código MFA mostrandolo en la página para fines de demostración.
    echo "<script>alert($mfaCode);</script>";
    // Verificar si se ha enviado un código en el formulario
}



?>