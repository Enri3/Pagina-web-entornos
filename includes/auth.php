<?php
session_start();

function verificarAcceso($rolPermitido) {
    if (!isset($_SESSION['nombre']) || $_SESSION['rol'] !== $rolPermitido) {
        // Redirige si no tiene acceso o no está logueado
        header("Location: login.php");
        exit;
    }
}