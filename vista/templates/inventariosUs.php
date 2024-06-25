<?php

session_start();

if(empty($_SESSION['idUsuario'])){
    header("location:../../index.php");
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sistema de Inventario</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../boots-css/bootstrap.min.css">
</head>

<body>

    <header>
        <h1 class="header"><strong>PAGINA DE INVENTARIOS</strong></h1>
        <div style="text-align:right;">
            <a href="inventariosUs.php" style="text-align;right;">VER INVENTARIOS</a>
            <a href="inventario.php" style="text-align;right;">INICIO</a>
        </div>
    </header>

<table cellspacing="15" cellpading="0" >
        <thead class="th">
            <tr class="trth">
                <td><strong>NOMBRE</strong></td>
                <td><strong>CORREO</strong></td>
                <td><strong>SALARIO</strong></td>
                <td><strong>CIUDAD</strong></td>
                <td><strong>HORA DE INGRESO</strong></td>
                <td><strong>FECHA DE INGRESO</strong></td>
                <!--<td>CONTRASEÑA</td>-->
                <!--<td>EDITAR</td>
                <td>BORRAR</td>-->
            </tr>
        </thead>
        <tbody>
 
        <?php
            include("../../controlador/DAO/conexion.php");

            $BDD=conectar("localhost:6666","root","","sistema de inventario");

            $id=$_SESSION["idUsuario"];
            $dameInv="SELECT * FROM inventario WHERE idUsuario=$id";
            $dameInventario=$BDD->query($dameInv);

            if($dameInventario->num_rows>0)
            {
                while($row = $dameInventario->fetch_assoc())
                {?>
                    <tr >
                    <td><?php echo $row["NombrePersonal"]; ?></td>
                    <td><?php echo $row["correo"]; ?></td>
                    <td><?php echo $row["salario"]; ?></td>
                    <td><?php echo $row["ciudad"]; ?></td>
                    <td><?php echo $row["horaIngreso"]; ?></td>
                    <td><?php echo $row["fechaIngreso"]; ?></td>
                    
                    <td><a href="inventariosUs.php?idInventario=<?php echo $row['idInventario'];  ?>">EDITAR</a></td>
                    <td><a href="inventariosUs.php?idInventarioBorrar=<?php echo $row['idInventario'];  ?>">BORRAR</a></td>
                    <td><a href="facturas.php">FACTURA</a></td>
            
                </tr><?php
                }
            }
            
            if(isset($_GET["idInventario"]))
            {
                $idInv = $_GET["idInventario"];
                //echo "EDITANDO LA OFERTA :".$titulo;

                $_SESSION["idInventario"]=$idInv;
                $id=$_SESSION["idInventario"];
                //echo $id;

                $dameInv="SELECT * FROM inventario WHERE idInventario='$id'";
                $dameInventario=$BDD->query($dameInv);
                $inventario=$dameInventario->fetch_assoc();
                
                ?>
                <div style="text-align:center;">
                    <div>
                        <h1>EDITAR INVENTARIO</h1>
                    </div>
                    <div style="text-align:center;">
                        <form action="../../controlador/inventario.php" method="post">
                            <input type="text" name="NombrePersonal" id="" value=<?php echo $inventario["NombrePersonal"]; ?>>
                            <input type="email" name="correo" id="" value=<?php echo $inventario["correo"]; ?>>
                            <input type="number" name="salario" id="" value=<?php echo $inventario["salario"]; ?>>
                            <input type="text" name="ciudad" id="" value=<?php echo $inventario["ciudad"]; ?>>
                            <input type="time" name="horaIngreso" id="" value=<?php echo $inventario["horaIngreso"]; ?>>
                            <input type="date" name="fechaIngreso" id="" value=<?php echo $inventario["fechaIngreso"]; ?>>
                            <input type="password" name="contrasenaInv" id="" value=<?php echo $inventario["contrasenaInv"]; ?>>
                            <input type="submit" value="ACTUALIZAR" name="actualizar">
                            <input type="submit" name="cancelar" value="CANCELAR">
                        </form>
                    </div>
                </div>
                
            <?php
            }

            if(isset($_GET["idInventarioBorrar"]))
            {
                $idInventario1 = $_GET["idInventarioBorrar"];

                $borraInv="DELETE FROM inventario WHERE idInventario = $idInventario1";
                $borrarInventario=$BDD->query($borraInv);
                //header("Location:../vista/templates/inventariosUs.php");
            }
                ?>
           
        </tbody>
    </table>

    
</body>
</html>