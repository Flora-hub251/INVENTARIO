<?php

session_start();
ob_start();
include("../../controlador/DAO/conexion.php");

$BDD=conectar("localhost:6666","root","","sistema de inventario");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body><?php

    $id=$_SESSION["idUsuario"];
    $dameInv="SELECT * FROM inventario WHERE idUsuario=$id";
    $dameInventario=$BDD->query($dameInv);

    if($dameInventario->num_rows>0)
    {
        while($row = $dameInventario->fetch_assoc())
        {?>
            <p>Nombre personal: <?php echo $row["NombrePersonal"]; ?></p><br>
            <p>Correo: <?php echo $row["correo"]; ?></p><br>
            <p>Salario: <?php echo $row["salario"]; ?></p><br>
            <p>Ciudad: <?php echo $row["ciudad"]; ?></p><br>
            <p>Hora de Ingreso: <?php echo $row["horaIngreso"]; ?></p><br>
            <p>Fecha de Ingreso<?php echo $row["fechaIngreso"]; ?></p><br>
            
    
        <?php
        }
    }?>
    
</body>
</html>

<?php

$factura=ob_get_clean();
require_once "../../controlador/librerias/dompdf-3.0.0/dompdf/autoload.inc.php";
use Dompdf\Dompdf;

$dompdf=new Dompdf();

$opciones=$dompdf->getOptions();
$opciones->set(array('isRemotedEnabled'=>true));
$dompdf->setOptions($opciones);
$dompdf->loadHtml($factura);

$dompdf->setPaper('A4','Landscape');
$dompdf->render();
$dompdf->stream("Factura.pdf", array("Attachement"=>false));


?>