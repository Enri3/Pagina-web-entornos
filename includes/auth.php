<?php
session_start();

function verificarAcceso($rolPermitido) {
    if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== $rolPermitido) {
        // Redirige si no tiene acceso o no está logueado
        header("Location: login.php");
        exit;
    }
}