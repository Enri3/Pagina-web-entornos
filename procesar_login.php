<?php

session_start();
require_once 'includes/conexion.php';
require_once 'includes/redireccion.php';

$nombreUsuario = $_POST['nombreUsuario'] ?? '';
$calveUsuario = $_POST['calveUsuario'] ?? '';

if (empty($nombreUsuario) || empty($calveUsuario)) {
    die("Todos los campos son obligatorios.");
}

$query = "SELECT * FROM usuarios WHERE nombreUsuario = '$nombreUsuario'";
$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) === 1) {
    $usuario = mysqli_fetch_assoc($resultado);

    // Verificar la contraseña
    if (md5($calveUsuario) == $usuario['calveUsuario']) {
        $_SESSION['codUsuario'] = $usuario['codUsuario'];
        $_SESSION['nombreUsuario'] = $usuario['nombreUsuario'];
        $_SESSION['tipoUsuario'] = $usuario['tipoUsuario'];

        // Redirigir según el rol
        redireccion($_SESSION['tipoUsuario']);
    } else {
        die("Contraseña incorrecta.");
    }
} else {
    die("Usuario no encontrado.");
}

?>