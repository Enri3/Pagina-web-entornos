<?php

session_start();
require_once 'includes/conexion.php';
require_once 'includes/redireccion.php';

$nombreUsuario = $_POST['nombreUsuario'] ?? '';
$claveUsuario = $_POST['claveUsuario'] ?? '';

if (empty($nombreUsuario)) {
    die("Usuario obligatorio.");
}

if (empty($claveUsuario)) {
    die("Clave obligatoria.");
}

$query = "SELECT * FROM usuarios WHERE nombreUsuario = '$nombreUsuario'";
$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) === 1) {
    $usuario = mysqli_fetch_assoc($resultado);

    // Verificar la contraseña
    if (md5($claveUsuario) == $usuario['claveUsuario']) {
        $_SESSION['codUsuario'] = $usuario['codUsuario'];
        $_SESSION['nombreUsuario'] = $usuario['nombreUsuario'];
        $_SESSION['tipoUsuario'] = $usuario['tipoUsuario'];

        // Redirigir según el rol
        redireccion($_SESSION['tipoUsuario']);
    } else {
        header("Location: login.php?error=Contraseña+incorrecta");
        exit;
    }
} else {
    header("Location: login.php?error=Usuario+no+encontrado");
    exit;
}

?>