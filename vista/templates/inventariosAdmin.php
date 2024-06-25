
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

  <main>
    <table cellspacing="15" cellpading="0" >
      <thead class="th">
        <tr class="trth">
            <td>NOMBRE</td>
            <td>CORREO</td>
            <td>SALARIO</td>
            <td>CIUDAD</td>
            <td>HORA DE INGRESO</td>
            <td>FECHA DE INGRESO</td>
            <td>CONTRASEÑA</td>
            <!--<td>EDITAR</td>
            <td>BORRAR</td>-->
        </tr>
      </thead>

      <tbody>

      <?php
      include("../../controlador/DAO/conexion.php");

      $BDD=conectar("localhost:6666","root","","sistema de inventario");
      $dameInv="SELECT * FROM inventario";
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
            <td><?php echo $row["contrasenaInv"]; ?></td>
            
            <td><a href="inventariosAdmin.php?idInventarioAdmin=<?php echo $row['idInventario'];  ?>">EDITAR</a></td>
            <td><a href="inventariosAdmin.php?idInventarioAdminBorrar=<?php echo $row['idInventario'];  ?>">BORRAR</a></td>
        </tr><?php
        }
      }
    
    
      if(isset($_GET["idInventarioAdmin"]))
      {
        $idInv = $_GET["idInventarioAdmin"];
        //echo "EDITANDO LA OFERTA :".$titulo;

        $_SESSION["idInventarioAdmin"]=$idInv;
        $id=$_SESSION["idInventarioAdmin"];

        $dameInv="SELECT * FROM inventario WHERE idInventario='$id'";
        $dameInventario=$BDD->query($dameInv);
        $inventario=$dameInventario->fetch_assoc();
        
        ?>
        <div style="text-align:center;">
            <div>
                <h1>EDITAR INVENTARIO</h1>
            </div>
            <div style="text-align:center;">
              <form action="../../controlador/invAdmin.php?InvAd=<?php echo $id; ?>" method="post">
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

      if(isset($_GET["idInventarioAdminBorrar"]))
      {
        $idInventario1 = $_GET["idInventarioAdminBorrar"];

        $borraInv="DELETE FROM inventario WHERE idInventario = $idInventario1";
        $borrarInventario=$BDD->query($borraInv);

        header("Location:inventariosAdmin.php");
      }
      ?>
      </tbody>
    </table>

  </main>


  
</body>
</html>