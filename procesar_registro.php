<?php

//incluye las funciones necesarias
session_start();
require_once 'includes/conexion.php';
require_once 'includes/enviar_correo.php';
require_once 'includes/redireccion.php';

$nombreUsuario = $_POST['nombreUsuario'] ?? '';
$email = $_POST['email'] ?? '';
$claveUsuario = $_POST['claveUsuario'] ?? '';
$tipoUsuario = $_POST['tipoUsuario'] ?? '';


// Verificar si los campos están vacíos
if (empty($nombreUsuario) || empty($email) || empty($claveUsuario) || empty($tipoUsuario)) {
    die($nombreUsuario.$email.$claveUsuario.$tipoUsuario."Todos los campos son obligatorios.");
}

// Verificar si el email ya está registrado
$query = "SELECT * FROM usuarios WHERE nombreUsuario = '$nombreUsuario'";
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

//Rescatar el código de usuario
$query = "SELECT * FROM usuarios WHERE nombreUsuario = '$nombreUsuario'";
$resultado = mysqli_query($conexion, $query)
    or die("Error al buscar al usuario");
$usuario = mysqli_fetch_assoc($resultado);
$_SESSION['codUsuario'] = $usuario['codUsuario'];

// Redirigir según el rol
redireccion($_SESSION['tipoUsuario']);
?>


