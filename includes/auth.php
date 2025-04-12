<!--
Función que verifica si el usuario es de hecho, un administrador.
-->

<?php
/*
Mi idea acá es que abra un modal y te avise que no tenes acceso, acá abajo dejo mi intento y comento la version anterior

    session_start();
    function verificarAcceso($tipoUsuarioPermitido) {
        if (!isset($_SESSION['nombreUsuario']) || $_SESSION['tipoUsuario'] !== $tipoUsuarioPermitido) {
            // Redirige si no tiene acceso o no está logueado
            header("Location: login.php");
            exit;
        }
    }
    ?>
*/

session_start();

function verificarAcceso($tipoUsuarioPermitido) {
    if (!isset($_SESSION['nombreUsuario']) || $_SESSION['tipoUsuario'] !== $tipoUsuarioPermitido) {
        // Muestra modal de acceso denegado
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Acceso Denegado</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </head>
         <div class="modal show" id="myModal" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Atención!</h4>
                    </div>

                    <!-- Modal body con una advertencia-->
                    <div class="modal-body">
                      <div class="alert alert-danger">
                           <!-- Avisa que no posee acceso y te manda al login -->
                          <strong>No posees acceso</strong> <a href="login.php" class="alert-link">inicie sesión</a>.
                      </div>
                    </div>

                </div>
            </div>
        </div> 
        HTML;
        exit;
    }
}
