<?php

session_start();
require_once 'includes/conexion.php';

$nombre = $_POST['nombre'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($nombre) || empty($password)) {
    die("Todos los campos son obligatorios.");
}

$query = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) === 1) {
    $usuario = mysqli_fetch_assoc($resultado);

    // Verificar la contraseña
    if (md5($password) == $usuario['password']) {
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];

        // Redirigir según el rol
        if ($usuario['rol'] === 'admin') {
            header("Location: admin_dashboard.php");
        } elseif ($usuario['rol'] === 'duenio') {
            header("Location: duenio_dashboard.php");
        } else {
            header("Location: cliente_dashboard.php");
        }
        exit;
    } else {
        die("Contraseña incorrecta.");
    }
} else {
    die("Usuario no encontrado.");
}

?>