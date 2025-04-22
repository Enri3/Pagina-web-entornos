<?php
include 'includes/header.php';
include 'includes/footer.php';
include 'includes/redireccion.php';

// Verificar si el usuario ya está logueado
if (isset($_SESSION['nombreUsuario'])) {
    // Si el usuario ya está logueado, redirigir a la página de inicio o a otra página
    redireccion($_SESSION['tipoUsuario']);
    exit;
}

renderHeader("Inicio - Shopping Descuentos");
?>

<h1 class="text-center mb-4">Bienvenido al portal de descuentos</h1>
<div class="text-center mt-4">
    <a href="login.php" class="btn btn-primary">Iniciar Sesión</a>
    <a href="registro.php" class="btn btn-outline-primary ms-2">Registrarse</a>
</div>

<?php renderFooter(); ?>
