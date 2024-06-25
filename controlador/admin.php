<?php

session_start();

include("../modelo/usuario.php");
include("DAO/conexion.php");
include("DAO/MFA.php");
include("../modelo/inventario.php");

$BDD=conectar("localhost:6666","root","","sistema de inventario");

if(isset($_POST["crearUsuario"]) and !empty($_POST["Usuario"]) and !empty($_POST["Contrasena"]))
{
    $us=new Usuario($_POST["Usuario"],$_POST["Contrasena"]) ;
    $rol=$_POST["rol"];
    $sentencia="SELECT * from usuario WHERE Usuario='$us->Usuario' and Contrasena='$us->Contrasena' 
    and rol='$rol'";
    $resultado=$BDD->query($sentencia);
    $usuarioEncontrado=$resultado->fetch_assoc();
    
    if($usuarioEncontrado==null && $usuarioEncontrado["rol"]!="admin")
    {
        $insertar="INSERT INTO usuario (Usuario,Contrasena,rol) VALUES ('$us->Usuario','$us->Contrasena','$rol')";
        $insertado=$BDD->query($insertar);
        unset($_SESSION["$idUsuario"]);
        header("Location:../vista/templates/admin.php");
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
          <div class="container">
            <a class="navbar-brand">PAGINA DE INVENTARIOS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="true" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
      
            <div class="navbar-collapse collapse show" id="navbarsExample07" style>
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="admin.php">Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="../vista/templates/nuevoUsuario.php">Nuevo Usuario</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="../vista/templates/inventariosAdmin.php">Ver Inventarios</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="../vista/templates/usuariosAdmin.php">Ver Usuarios</a>
                </li>
              </ul>
              <form role="search">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
              </form>
            </div>
        </div>
    </nav>

  </header>

            <main>
                <div class="formCrear">
                    <h3><strong>REGISTRAR USUARIO</strong></h3>
                    <form action="admin.php" method="post">
                        <input type="text" name="Usuario" id="usuario" placeholder="Nombre de Usuario"><br>
                        <input type="password" name="Contrasena" id="contra" placeholder="Contraseña"><br>
                        <select name="rol" id="">
                            <option value="admin">Admin</option>
                            <option value="usuario">Usuario</option>
                        </select><br>
                        <input type="submit" value="CREAR" name="crearUsuario">

                        <div class="alert"><?php echo 
                            "<div class='alert alert-warning'>
                            El usuario ya fue creado previamente</div>";?></div>
                    </div>
                    </form>

                    <footer>
                    <div class="container-sm">
                        <a class="btn btn-warning" href="cerrar_cesion.php">CERRAR SESION</a>
                    </div>
                </footer>
                    
                </div>
            </main>

        </body>
        </html><?php
    }

}

if(isset($_POST["actualizar"]) and isset($_GET["idUs"]))
{
    $_SESSION["idUsu"]=$_GET["idUs"];
    $idUsu=$_SESSION["idUsu"];
    $usuario=$_POST["Usuario"];
    $contrasena=$_POST["Contrasena"];
    $rol=$_POST["rol"];

    $sentencia ="UPDATE usuario SET Usuario ='$usuario', Contrasena='$contrasena',
                rol='$rol' WHERE idUsuario = $idUsu";
    $actualizacion=$BDD->query($sentencia);
    
    header("Location:../vista/templates/usuariosAdmin.php");
}

if(isset($_POST["cancelar"]) and isset($_GET["idUs"]))
{
    unset($_SESSION["idUs"]);
    header("Location:../vista/templates/usuariosAdmin.php");
}