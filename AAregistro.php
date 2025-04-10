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
$resultado = mysqli_query($conexion, $query);

// Asignar sesión
$_SESSION['id'] = $usuario['id'];
$_SESSION['nombre'] = $usuario['nombre'];
$_SESSION['rol'] = $usuario['rol'];

// Redirigir al index
header("Location: index.php");
?>

$conexion = mysqli_connect("localhost", "root", "", "base") or die("No se pudo conectar");
