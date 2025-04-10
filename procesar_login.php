<?php
session_start();
require_once 'includes/conexion.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    die("Todos los campos son obligatorios.");
}

try {
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() === 1) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $usuario['password'])) {
            // Guardar datos de sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];

            // Redirigir según rol
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
            echo password_verify($password);
            echo password_verify($usuario['password']);
            echo"hello world";
        }
    } else {
        die("Usuario no encontrado.");
    }
} catch (PDOException $e) {
    die("Error al iniciar sesión: " . $e->getMessage());
}
?>