<?php
session_start();
require_once 'includes/conexion.php';

$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$rol = $_POST['rol'] ?? '';

if (empty($nombre) || empty($email) || empty($password) || empty($rol)) {
    die("Todos los campos son obligatorios.");
}

try {
    // Verificar si el email ya está registrado
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        die("El correo ya está registrado.");
    }

    // Insertar nuevo usuario
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $email, $hash, $rol]);

    // Redirigir al login
    header("Location: login.php?registro=exitoso");
    exit;
} catch (PDOException $e) {
    die("Error al registrar: " . $e->getMessage());
}
?>