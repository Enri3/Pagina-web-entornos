<?php
session_start();
require_once 'includes/conexion.php';
require_once 'includes/enviar_correo.php';

$nombreUsuario = $_POST['nombreUsuario'] ?? '';
$email = $_POST['email'] ?? '';
$claveUsuario = $_POST['claveUsuario'] ?? '';
$tipoUsuario = $_POST['tipoUsuario'] ?? '';

if (empty($nombreUsuario) || empty($email) || empty($claveUsuario) || empty($tipoUsuario)) {
    die("Todos los campos son obligatorios.");
}

// Verificar si el email ya está registrado
$query = "SELECT * FROM usuarios WHERE nombre = '$nombreUsuario'";
$resultado = mysqli_query($conexion, $query)
    or die("Eror al buscar al usuario");

if (mysqli_num_rows($resultado) === 1) {
    die("El usuario ya está registrado.");
}

// Hashear la contraseña
$hash = md5($claveUsuario);

// Insertar nuevo usuario
$query = "INSERT INTO usuarios (nombreUsuario, email, claveUsuario, tipoUsuario) VALUES ('$nombreUsuario', '$email', '$hash', '$tipoUsuario')";
mysqli_query($conexion, $query);

// Asignar sesión
$_SESSION['nombreUsuario'] = $nombreUsuario;
$_SESSION['tipoUsuario'] = $tipoUsuario;
$query = "SELECT * FROM usuarios WHERE nombre = '$nombreUsuario'";
$resultado = mysqli_query($conexion, $query)
    or die("Error al buscar al usuario");
$usuario = mysqli_fetch_assoc($resultado);
$_SESSION['codUsuario'] = $usuario['codUsuario'];

// Redirigir según el rol
    if ($usuario['tipoUsuario'] === 'administrador') {
        header("Location: admin_dashboard.php");
    } elseif ($usuario['tipoUsuario'] === 'dueño de local') {
        header("Location: dueño_dashboard.php");
    } elseif ($usuario['tipoUsuario'] === 'cliente') {
        header("Location: cliente_dashboard.php");
    }
?>

$conexion = mysqli_connect("localhost", "root", "", "base") or die("No se pudo conectar");
