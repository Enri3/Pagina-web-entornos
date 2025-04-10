<?php
function renderHeader($titulo = "Shopping Descuentos") {
    echo <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$titulo}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="includes/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm  fixed-top fondo_Barras">
    <div class="container-fluid">
        <img src="imagenes/logo.png" class="float-start img-fluid img_logo "  alt="logo">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="mynavbar">
        <ul class="navbar-nav ms-auto d-flex">
          <li class="nav-item">
            <a class="nav-link" href="inicioSesion.php"><button type="button" class="btn btn btn-outline-light text-light">INICIAR SESIÓN</button></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registro.php"><button type="button" class="btn btn btn-outline-light text-light">REGISTRARSE</button></a>
          </li>
        </ul>

      </div>
    </div>
  </nav>

<main class="container py-4">
HTML;
}
?>
