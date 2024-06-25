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
    <title>Sistema de Inventario</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../boots-css/bootstrap.min.css">
</head>

<body>

    <header>
        <?php
        
            include("../../controlador/DAO/conexion.php");
            $BDD=conectar("localhost:6666","root","","sistema de inventario");
            $id=$_SESSION["idUsuario"];

            $nombre="SELECT Usuario FROM usuario WHERE idUsuario=$id";
            $busca=$BDD->query($nombre);
            $nombreUs=$busca->fetch_assoc();
            $nombreFinal=$nombreUs["Usuario"];
        ?>
        <h1 class="header"><div class="alert alert-primary" >Bienvenido señor/a  <?php echo $nombreFinal;?>  A SU PAGINA DE INVENTARIOS</div></h1>
    </header>

    <div style="text-align:right;">
        <a href="inventariosUs.php" style="text-align;right;">VER INVENTARIOS</a>
        <a href="inventario.php" style="text-align;right;">INICIO</a>
    </div>
    

    <main>
        <div class="formInv">
            <h3><strong>INGRESE SUS DATOS</strong></h3>
            <form action="../../controlador/inventario.php" method="post">
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
        </div>
    </main>

    <footer>
        <div class="container-sm">
            <a class="btn btn-warning" href="../../controlador/cerrar_cesion.php">CERRAR SESION</a>
        </div>
    </footer>
    
    <script src="../boots-js/bootstrap.min.js"></script>
</body>
</html>