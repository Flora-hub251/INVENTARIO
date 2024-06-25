
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
                  <a class="nav-link " href="nuevoUsuario.php">Nuevo Usuario</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="inventariosAdmin.php">Ver Inventarios</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="usuariosAdmin.php">Ver Usuarios</a>
                </li>
              </ul>
              <form role="search">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
              </form>
            </div>
        </div>
    </nav>

  </header>

<table cellspacing="15" cellpading="0" >
        <thead class="th">
            <tr class="trth">
                <td>NOMBRE</td>
                <td>CONTRASENA</td>
                <td>ROL</td>
                <!--<td>EDITAR</td>
                <td>BORRAR</td>-->
            </tr>
        </thead>
        <tbody>
 
        <?php
            include("../../controlador/DAO/conexion.php");

            $BDD=conectar("localhost:6666","root","","sistema de inventario");
            $dameUs="SELECT * FROM usuario";
            $dameUsuario=$BDD->query($dameUs);
            if($dameUsuario->num_rows>0)
            {
                while($row = $dameUsuario->fetch_assoc())
                {?>
                    <tr >
                    <td><?php echo $row["Usuario"]; ?></td>
                    <td><?php echo $row["Contrasena"]; ?></td>
                    <td><?php echo $row["rol"]; ?></td>
                    
                    <td><a href="usuariosAdmin.php?idUsu=<?php echo $row['idUsuario'];  ?>">EDITAR</a></td>
                    <td><a href="usuariosAdmin.php?idUsuBorrar=<?php echo $row['idUsuario'];  ?>">BORRAR</a></td>
                </tr><?php
                }
            }
            if(isset($_GET["idUsu"]))
            {
              $idUs = $_GET["idUsu"];
              //echo "EDITANDO LA OFERTA :".$titulo;

              $_SESSION["idUsu"]=$idUs;
              $id=$_SESSION["idUsu"];

              $dameUsu="SELECT * FROM usuario WHERE idUsuario='$id'";
              $dameUsuario=$BDD->query($dameUsu);
              $usuario=$dameUsuario->fetch_assoc();
              
              ?>
              <div style="text-align:center;">
                  <div>
                      <h1>EDITAR USUARIO</h1>
                  </div>
                  <div style="text-align:center;">
                    <form action="../../controlador/admin.php?idUs=<?php echo $id; ?>" method="post">
                      <input type="text" name="Usuario" id="usuario" value=<?php echo $usuario["Usuario"]; ?>>
                      <input type="password" name="Contrasena" id="contra" value=<?php echo $usuario["Contrasena"]; ?>>
                      <select name="rol" id="">
                          <option value="admin">Admin</option>
                          <option value="usuario">Usuario</option>
                      </select>
                      <input type="submit" value="ACTUALIZAR" name="actualizar">
                      <input type="submit" name="cancelar" value="CANCELAR">
                    </form>
                  </div>
              </div>
              
              <?php
            }
            if(isset($_GET["idUsuBorrar"]))
            {
              $idUsuario1 = $_GET["idUsuBorrar"];

              $borrarInv="DELETE FROM inventario WHERE idUsuario=$idUsuario1";
              $borrarInventario=$BDD->query($borrarInv);

              $borraUsu="DELETE FROM usuario WHERE idUsuario = $idUsuario1";
              $borrarUsuario=$BDD->query($borraUsu);

              //header("Location:usuariosAdmin.php");
            }


            ?>

            
           
        </tbody>
    </table>
    
</body>
</html>