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
    
  <footer>
    <div class="container-sm">
      <a class="btn btn-warning" href="../../controlador/cerrar_cesion.php">CERRAR SESION</a>
    </div>
</footer>
  <script src="../boots-js/bootstrap.min.js"></script>
</body>
</html>