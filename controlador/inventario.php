<?php

session_start();

include("../modelo/usuario.php");
include("DAO/conexion.php");
include("../modelo/inventario.php");

/*require_once 'dompdf/autoload.inc.php'; // Incluye el archivo de autoload de dompdf
use Dompdf\Dompdf;*/

$BDD=conectar("localhost:6666","root","","sistema de inventario");



if(isset($_POST["guardar"]) and !empty($_POST["NombrePersonal"]) and !empty($_POST["correo"]) and
!empty($_POST["salario"]) and !empty($_POST["ciudad"]) and !empty($_POST["horaIngreso"]) and
!empty($_POST["fechaIngreso"]) and !empty($_POST["contrasenaInv"]) and !empty($_POST["confirmContrasena"]))
{
    $inventario=new inventario($_POST["NombrePersonal"], $_POST["correo"], $_POST["salario"],
    $_POST["ciudad"], $_POST["horaIngreso"], $_POST["fechaIngreso"], $_POST["contrasenaInv"],
    $_POST["confirmContrasena"]);

    $idUsuarioInv=$_SESSION["idUsuario"];

    $buscarContra="SELECT Contrasena from usuario WHERE idUsuario=$idUsuarioInv";
    $buscar=$BDD->query($buscarContra);
    $contra=$buscar->fetch_assoc();

    if($contra["Contrasena"]==$inventario->contrasenaInv and 
        $inventario->contrasenaInv==$inventario->confirmContrasena)
    {
        $buscarInventario="SELECT * FROM inventario WHERE idUsuario=$idUsuarioInv and NombrePersonal='$inventario->NombrePersonal' and
        correo='$inventario->correo' and salario=$inventario->salario and contrasenaInv='$inventario->contrasenaInv' and confirmContrasena='$inventario->contrasenaInv'";
        $busqueda=$BDD->query($buscarInventario);
        $buscado=$busqueda->fetch_assoc();

        if($buscado==null and $inventario->salario<=2000000)
        {
            $insertarInv="INSERT INTO inventario (idUsuario, NombrePersonal, correo, salario, ciudad, horaIngreso,
                            fechaIngreso, contrasenaInv, confirmContrasena) VALUES ($idUsuarioInv, '$inventario->NombrePersonal',
                            '$inventario->correo', $inventario->salario, '$inventario->ciudad',
                            '$inventario->horaIngreso', '$inventario->fechaIngreso', '$inventario->contrasenaInv',
                            '$inventario->confirmContrasena')";
            $insertInv=$BDD->query($insertarInv);?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Sistema de Inventario</title>
                <link rel="stylesheet" href="../vista/css/login.css">
                <link rel="stylesheet" href="../vista/boots-css/bootstrap.min.css">
            </head>

            <body>

                <header>
                    <?php
                    
                        $id=$_SESSION["idUsuario"];

                        $nombre="SELECT Usuario FROM usuario WHERE idUsuario=$id";
                        $busca=$BDD->query($nombre);
                        $nombreUs=$busca->fetch_assoc();
                        $nombreFinal=$nombreUs["Usuario"];
                    ?>
                    <h1 class="header"><div class="alert alert-primary" >Bienvenido señor/a  <?php echo $nombreFinal;?>  A SU PAGINA DE INVENTARIOS</div></h1>
                </header>
                
                <div style="text-align:right;">
                    <a href="../vista/templates/inventariosUs.php" style="text-align;right;">VER INVENTARIOS</a>
                    <a href="../vista/templates/inventarios.php" style="text-align;right;">INICIO</a>
                </div>

                <main>
                    <div class="formInv">
                        <h3><strong>INGRESE SUS DATOS</strong></h3>
                        <form action="inventario.php" method="post">
                            <input type="text" name="NombrePersonal" id="" placeholder="Nompre personal"><br>
                            <input type="email" name="correo" id="" placeholder="Correo"><br>
                            <input type="number" name="salario" id="" placeholder="Salario"><br>
                            <input type="text" name="ciudad" id="" placeholder="Ciudad"><br>
                            <input type="time" name="horaIngreso" id="" placeholder="Hora de ingreso"><br>
                            <input type="date" name="fechaIngreso" id="" placeholder="Fecha de ingreso"><br>
                            <input type="password" name="contrasenaInv" id="" placeholder="Contraseña"><br>
                            <input type="password" name="confirmContrasena" id="" placeholder="Confirma la contraseña"><br>
                            <input type="submit" value="GUARDAR" name="guardar">
                        </form>
                    </div>
                </main>
                
                <footer>
                    <div class="container-sm">
                        <a class="btn btn-warning" href="cerrar_cesion.php">CERRAR SESION</a>
                    </div>
                </footer>
                <script src="../vista/boots-js/bootstrap.min.js"></script>
            </body>

            
            </html><?php
        }
        if($buscado==null and $inventario->salario>2000000)
        {?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Sistema de Inventario</title>
                <link rel="stylesheet" href="../vista/css/login.css">
                <link rel="stylesheet" href="../vista/boots-css/bootstrap.min.css">
            </head>

            <body>

                <header>
                    <?php
                    
                        $id=$_SESSION["idUsuario"];

                        $nombre="SELECT Usuario FROM usuario WHERE idUsuario=$id";
                        $busca=$BDD->query($nombre);
                        $nombreUs=$busca->fetch_assoc();
                        $nombreFinal=$nombreUs["Usuario"];
                    ?>
                    <h1 class="header"><div class="alert alert-primary" >Bienvenido señor/a  <?php echo $nombreFinal;?>  A SU PAGINA DE INVENTARIOS</div></h1>
                </header>
                
                <div style="text-align:right;">
                    <a href="../vista/templates/inventariosUs.php" style="text-align;right;">VER INVENTARIOS</a>
                    <a href="../vista/templates/inventarios.php" style="text-align;right;">INICIO</a>
                </div>

                <main>
                    <div class="formInv">
                        <h3><strong>INGRESE SUS DATOS</strong></h3>
                        <form action="inventario.php" method="post">
                            <input type="text" name="NombrePersonal" id="" placeholder="Nompre personal"><br>
                            <input type="email" name="correo" id="" placeholder="Correo"><br>
                            <input type="number" name="salario" id="" placeholder="Salario"><br>
                            <input type="text" name="ciudad" id="" placeholder="Ciudad"><br>
                            <input type="time" name="horaIngreso" id="" placeholder="Hora de ingreso"><br>
                            <input type="date" name="fechaIngreso" id="" placeholder="Fecha de ingreso"><br>
                            <input type="password" name="contrasenaInv" id="" placeholder="Contraseña"><br>
                            <input type="password" name="confirmContrasena" id="" placeholder="Confirma la contraseña"><br>
                            <input type="submit" value="GUARDAR" name="guardar"><br>
                        </form>

                        <div class="alert"><?php echo 
                            "<div class='alert alert-warning'>
                            El salario no debe superar los 2000000 XAF</div>";?></div>
                    </div>
                </main>
                
                <footer>
                    <div class="container-sm">
                        <a class="btn btn-warning" href="cerrar_cesion.php">CERRAR SESION</a>
                    </div>
                </footer>
                <script src="../vista/boots-js/bootstrap.min.js"></script>
            </body>

            
            </html><?php
        }
        if($buscado!=null)
        {?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Sistema de Inventario</title>
                <link rel="stylesheet" href="../vista/css/login.css">
                <link rel="stylesheet" href="../vista/boots-css/bootstrap.min.css">
            </head>

            <body>

                <header>
                    <?php
                    
                        $id=$_SESSION["idUsuario"];

                        $nombre="SELECT Usuario FROM usuario WHERE idUsuario=$id";
                        $busca=$BDD->query($nombre);
                        $nombreUs=$busca->fetch_assoc();
                        $nombreFinal=$nombreUs["Usuario"];
                    ?>
                    <h1 class="header"><div class="alert alert-primary" >Bienvenido señor/a  <?php echo $nombreFinal;?>  A SU PAGINA DE INVENTARIOS</div></h1>
                </header>
                
                <div style="text-align:right;">
                    <a href="../vista/templates/inventariosUs.php" style="text-align;right;">VER INVENTARIOS</a>
                    <a href="../vista/templates/inventarios.php" style="text-align;right;">INICIO</a>
                </div>

                <main>
                    <div class="formInv">
                        <h3><strong>INGRESE SUS DATOS</strong></h3>
                        <form action="inventario.php" method="post">
                            <input type="text" name="NombrePersonal" id="" placeholder="Nompre personal"><br>
                            <input type="email" name="correo" id="" placeholder="Correo"><br>
                            <input type="number" name="salario" id="" placeholder="Salario"><br>
                            <input type="text" name="ciudad" id="" placeholder="Ciudad"><br>
                            <input type="time" name="horaIngreso" id="" placeholder="Hora de ingreso"><br>
                            <input type="date" name="fechaIngreso" id="" placeholder="Fecha de ingreso"><br>
                            <input type="password" name="contrasenaInv" id="" placeholder="Contraseña"><br>
                            <input type="password" name="confirmContrasena" id="" placeholder="Confirma la contraseña"><br>
                            <input type="submit" value="GUARDAR" name="guardar"><br>
                        </form>

                        <div class="alert"><?php echo 
                            "<div class='alert alert-warning'>
                            Su inventario ya fue registrado previamente</div>";?></div>
                    </div>
                </main>
                
                <footer>
                <div class="container-sm">
                    <a class="btn btn-warning" href="cerrar_cesion.php">CERRAR SESION</a>
                </div>
                </footer>
                <script src="../vista/boots-js/bootstrap.min.js"></script>
            </body>
            </html><?php
        }
    }else
    {?>
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Sistema de Inventario</title>
                <link rel="stylesheet" href="../vista/css/login.css">
                <link rel="stylesheet" href="../vista/boots-css/bootstrap.min.css">
            </head>

            <body>

                <header>
                    <?php
                    
                        $id=$_SESSION["idUsuario"];

                        $nombre="SELECT Usuario FROM usuario WHERE idUsuario=$id";
                        $busca=$BDD->query($nombre);
                        $nombreUs=$busca->fetch_assoc();
                        $nombreFinal=$nombreUs["Usuario"];
                    ?>
                    <h1 class="header"><div class="alert alert-primary" >Bienvenido señor/a  <?php echo $nombreFinal;?>  A SU PAGINA DE INVENTARIOS</div></h1>
                </header>
                
                <div style="text-align:right;">
                    <a href="../vista/templates/inventariosUs.php" style="text-align;right;">VER INVENTARIOS</a>
                    <a href="../vista/templates/inventarios.php" style="text-align;right;">INICIO</a>
                </div>

                <main>
                    <div class="formInv">
                        <h3><strong>INGRESE SUS DATOS</strong></h3>
                        <form action="inventario.php" method="post">
                            <input type="text" name="NombrePersonal" id="" placeholder="Nompre personal"><br>
                            <input type="email" name="correo" id="" placeholder="Correo"><br>
                            <input type="number" name="salario" id="" placeholder="Salario"><br>
                            <input type="text" name="ciudad" id="" placeholder="Ciudad"><br>
                            <input type="time" name="horaIngreso" id="" placeholder="Hora de ingreso"><br>
                            <input type="date" name="fechaIngreso" id="" placeholder="Fecha de ingreso"><br>
                            <input type="password" name="contrasenaInv" id="" placeholder="Contraseña"><br>
                            <input type="password" name="confirmContrasena" id="" placeholder="Confirma la contraseña"><br>
                            <input type="submit" value="GUARDAR" name="guardar"><br>
                        </form>

                        <div class="alert"><?php echo 
                            "<div class='alert alert-warning'>
                            Revise las contraseñas</div>";?></div>
                    </div>
                </main>
                
                <footer>
                <div class="container-sm">
                    <a class="btn btn-warning" href="cerrar_cesion.php">CERRAR SESION</a>
                </div>
                </footer>
                <script src="../vista/boots-js/bootstrap.min.js"></script>
            </body>
            </html><?php
    }
}else
{
    ?>
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Sistema de Inventario</title>
                <link rel="stylesheet" href="../vista/css/login.css">
                <link rel="stylesheet" href="../vista/boots-css/bootstrap.min.css">
            </head>

            <body>

                <header>
                    <?php
                    
                        $id=$_SESSION["idUsuario"];

                        $nombre="SELECT Usuario FROM usuario WHERE idUsuario=$id";
                        $busca=$BDD->query($nombre);
                        $nombreUs=$busca->fetch_assoc();
                        $nombreFinal=$nombreUs["Usuario"];
                    ?>
                    <h1 class="header"><div class="alert alert-primary" >Bienvenido señor/a  <?php echo $nombreFinal;?>  A SU PAGINA DE INVENTARIOS</div></h1>
                </header>
                
                <div style="text-align:right;">
                    <a href="../vista/templates/inventariosUs.php" style="text-align;right;">VER INVENTARIOS</a>
                    <a href="../vista/templates/inventarios.php" style="text-align;right;">INICIO</a>
                </div>

                <main>
                    <div class="formInv">
                        <h3><strong>INGRESE SUS DATOS</strong></h3>
                        <form action="inventario.php" method="post">
                            <input type="text" name="NombrePersonal" id="" placeholder="Nompre personal"><br>
                            <input type="email" name="correo" id="" placeholder="Correo"><br>
                            <input type="number" name="salario" id="" placeholder="Salario"><br>
                            <input type="text" name="ciudad" id="" placeholder="Ciudad"><br>
                            <input type="time" name="horaIngreso" id="" placeholder="Hora de ingreso"><br>
                            <input type="date" name="fechaIngreso" id="" placeholder="Fecha de ingreso"><br>
                            <input type="password" name="contrasenaInv" id="" placeholder="Contraseña"><br>
                            <input type="password" name="confirmContrasena" id="" placeholder="Confirma la contraseña"><br>
                            <input type="submit" value="GUARDAR" name="guardar"><br>
                        </form>

                        <div class="alert"><?php echo 
                            "<div class='alert alert-warning'>
                            Rellene todos los campos</div>";?></div>
                    </div>
                </main>

                <footer>
                    <div class="container-sm">
                        <a class="btn btn-warning" href="cerrar_cesion.php">CERRAR SESION</a>
                    </div>
                </footer>
                
                <script src="../vista/boots-js/bootstrap.min.js"></script>
            </body>
            </html><?php
}



if(isset($_POST["factura"]) and !empty($_POST["NombrePersonal"]) and !empty($_POST["correo"]) and
!empty($_POST["salario"]) and !empty($_POST["ciudad"]) and !empty($_POST["horaIngreso"]) and
!empty($_POST["fechaIngreso"]) and !empty($_POST["contrasenaInv"]) and !empty($_POST["confirmContrasena"]))
{
    
    /*$dompdf = new Dompdf();
    $dompdf->loadHtml("<h1>Datos del Usuario</h1>
                <p><strong>Nombre:</strong> $nombre</p>
                <p><strong>Correo electrónico:</strong> $email</p>");

    // Renderizar el documento PDF
    $dompdf->render();

    // Generar el archivo PDF
    $dompdf->stream("datos_usuario.pdf");*/

}

if(isset($_POST["cancelar"]))
{
    unset($_SESSION["idInventario"]);
    header("Location:../vista/templates/inventariosUs.php");
}

if(isset($_POST["actualizar"]))
{
    $nombre=$_POST["NombrePersonal"];
    $correo=$_POST["correo"];
    $salario=$_POST["salario"];
    $ciudad=$_POST["ciudad"];
    $hora=$_POST["horaIngreso"];
    $fecha=$_POST["fechaIngreso"];
    $contra=$_POST["contrasenaInv"];

    $idInventario=$_SESSION["idInventario"];
    $sentencia ="UPDATE inventario SET NombrePersonal ='$nombre', correo='$correo',
                salario=$salario, ciudad='$ciudad', horaIngreso='$hora',
                fechaIngreso='$fecha', contrasenaInv='$contra' WHERE idInventario = $idInventario";
    $actualizacion=$BDD->query($sentencia);
    unset($_SESSION["idInventario"]);
    header("Location:../vista/templates/inventariosUs.php");
}



?>