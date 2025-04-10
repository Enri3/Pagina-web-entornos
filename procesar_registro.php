<?php
session_start();
require_once 'includes/conexion.php';
require_once 'includes/enviar_correo.php';

$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$rol = $_POST['rol'] ?? '';

if (empty($nombre) || empty($email) || empty($password) || empty($rol)) {
    die("Todos los campos son obligatorios.");
}

// Verificar si el email ya está registrado
$query = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
$resultado = mysqli_query($conexion, $query)
    or die("Eror al buscar al usuario");

if (mysqli_num_rows($resultado) === 1) {
    die("El usuario ya está registrado.");
}

// Hashear la contraseña
$hash = md5($password);

// Insertar nuevo usuario
$query = "INSERT INTO usuarios (nombre, email, password, rol) VALUES ('$nombre', '$email', '$hash', '$rol')";
mysqli_query($conexion, $query);

// Asignar sesión
$_SESSION['nombre'] = $nombre;
$_SESSION['rol'] = $rol;
$query = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
$resultado = mysqli_query($conexion, $query)
    or die("Error al buscar al usuario");
$usuario = mysqli_fetch_assoc($resultado);
$_SESSION['id'] = $usuario['id'];

// Redirigir según el rol
    if ($usuario['rol'] === 'admin') {
        header("Location: admin_dashboard.php");
    } elseif ($usuario['rol'] === 'duenio') {
        header("Location: duenio_dashboard.php");
    } else {
        header("Location: cliente_dashboard.php");
    }
?>

$conexion = mysqli_connect("localhost", "root", "", "base") or die("No se pudo conectar");
