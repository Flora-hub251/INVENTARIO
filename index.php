<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <link rel="stylesheet" href="vista/boots-css/bootstrap.min.css">
    <link rel="stylesheet" href="vista/css/login.css">
</head>

<body>
    <div class="container">
        <div>
            <h2 class="alert alert-primary m-5 text-center"><strong>PAGINA DE INVENTARIOS</strong></h2>
        </div>
        
        <div class="formInicio">
            <h3><strong>INICIAR SESIÓN</strong></h3>
            <form action="index.php" method="post">
                <input type="text" name="us" id="" placeholder="Nombre de Usuario"><br>
                <input type="password" name="contra" id="" placeholder="Contraseña"><br>
                <input type="submit" class="btn btn-success" value="INICIAR SESION" name="iniciar">
            </form>
            
            <?php
                include("controlador/DAO/conexion.php");
                $BDD=conectar("localhost:6666","root","","sistema de inventario");

                if(isset($_POST["iniciar"]) and empty($_POST["us"]) || empty($_POST["contra"]))
                {
                    ?><div class="alert"><?php echo 
                    "<div class='alert alert-warning'>
                    Rellene todos los campos</div>";?></div><?php
                }
                if(isset($_POST["iniciar"]) and !empty($_POST["us"]) && !empty($_POST["contra"]))
                {
                    $nombreUs=$_POST["us"];
                    echo $nombreUs;
                    $contra=$_POST["contra"];
                    $sentencia="SELECT * from usuario WHERE Usuario='$nombreUs'
                                and Contrasena='$contra'"; 
                    $resultado=$BDD->query($sentencia);
                    $usuarioEncontrado=$resultado->fetch_assoc();

                    if($usuarioEncontrado!=null)
                    {
                        if($usuarioEncontrado["rol"]=='admin')
                        {
                            unset($_SESSION["idUsuario"]);
                            $idUsuario=$usuarioEncontrado["idUsuario"];
                            $_SESSION["idUsuario"]=$idUsuario;
                            header("Location:vista/templates/admin.php");
                        }else
                        {
                            unset($_SESSION["idUsuario"]);
                            $idUsuario=$usuarioEncontrado["idUsuario"];
                            $_SESSION["idUsuario"]=$idUsuario;
                            $idUS=$_SESSION["idUsuario"];
                            header("Location:controlador/control.php");
                        }
                    }else
                    {
                        ?><div class="alert"><?php echo 
                        "<div class='alert alert-warning'>
                        Acceso denegado</div>";?></div><?php
                    }
                }
            ?>
            
        </div>
    
    </div>
    


    <script src="vista/boots-js/bootstrap.min.js"></script>
</body>
</html>