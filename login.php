<?php
include 'includes/header.php';
include 'includes/footer.php';
include 'includes/redireccion.php';

session_start();
// Verificar si el usuario ya está logueado
if (isset($_SESSION['nombreUsuario'])) {
    // Si el usuario ya está logueado, redirigir a la página de inicio o a otra página
    redireccion($_SESSION['tipoUsuario']);
    exit;
}
renderHeader("Iniciar Sesión - Shopping Descuentos");

?>

<h2 class="text-center mb-4">Iniciar Sesión</h2>
<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="procesar_login.php" method="POST" class="border rounded p-4 shadow-sm bg-light">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de usuario</label>
                <input type="nombre" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
            <div class="text-center mt-3">
                <a href="registro.php">¿No tenés cuenta? Registrate</a>
            </div>
        </form>
    </div>
</div>

<?php renderFooter(); ?>