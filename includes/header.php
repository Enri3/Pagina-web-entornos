<!--
Este es el header, se incluye en todas las paginas para no tener que ir incorporando la etiqueta <head> a cada una, además cambia según el tipo de usuario
-->

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
                <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
                <link rel="stylesheet" href="includes/style.css">
                <link rel="icon" href="imagenes/favicon.ico" type="image/x-icon">
            </head>
            <body>
                <!-- ARREGLAR Agrego style aca pq por alguna razon no me lee el css -->
                <style>
                    nav.navbar {
                        position:sticky;
                        top:0;
                        width: 100%;
                        z-index: 1000;
                    }
                    footer {
                        position:fixed;
                        bottom:0;
                        width:100%;
                    }
                </style>
                <nav class="navbar navbar-expand-sm shadow-sm fondo_Barras py-4 " >
                <div class="container-fluid" >
                    <a href="index.php">
                        <img src="imagenes/logo.png" class="img-fluid img_logo" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="mynavbar">
                        <ul class="navbar-nav align-items-center gap-2">
    HTML;

    if (isset($_SESSION['nombreUsuario'])) {
        $nombre = htmlspecialchars($_SESSION['nombreUsuario']);
        $tipoUsuario = $_SESSION['tipoUsuario'];

        // Definir la ruta al dashboard según el tipo de usuario
        $dashboard = "#";
        if ($tipoUsuario === 'administrador') {
            $dashboard = "admin_dashboard.php";
        } elseif ($tipoUsuario === 'dueño de local') {
            $dashboard = "dueno_dashboard.php";
        } elseif ($tipoUsuario === 'cliente') {
            $dashboard = "cliente_dashboard.php";
        }

        echo <<<HTML

            <li class="nav-item">
                <span class="text-white">Hola, {$nombre}</span>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{$dashboard}">
                    <button type="button" class="btn btn-outline-light text-light">Panel del {$tipoUsuario}</button>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <button type="button" class="btn btn-outline-light text-light">Cerrar sesión</button>
                </a>
            </li>
        HTML;
    } else {
        echo <<<HTML
            <li class="nav-item">
                <a class="nav-link" href="login.php">
                    <button type="button" class="btn btn-outline-light text-light">INICIAR SESIÓN</button>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registro.php">
                    <button type="button" class="btn btn-outline-light text-light">REGISTRARSE</button>
                </a>
            </li>
        HTML;
    }

    echo <<<HTML
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
HTML;
}
?>