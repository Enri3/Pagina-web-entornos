<?php
$host = 'localhost';
$db = 'shopping_db'; // Asegurate de usar el nombre real de tu base
$user = 'root';
$pass = ''; // O la contraseña correspondiente

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>