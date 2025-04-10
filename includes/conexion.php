
<?php
$base = 'shopping_db';
$host = 'localhost';
$user = 'root';
$pass = '';
$conexion = mysqli_connect($host, $user, $pass, $base)
  or die("Error de conexión: " . mysqli_error($conexion));
?>