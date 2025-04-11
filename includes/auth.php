<?php
session_start();

function verificarAcceso($tipoUsuarioPermitido) {
    if (!isset($_SESSION['nombreUsuario']) || $_SESSION['tipoUsuario'] !== $tipoUsuarioPermitido) {
        // Redirige si no tiene acceso o no está logueado
        header("Location: login.php");
        exit;
    }
}