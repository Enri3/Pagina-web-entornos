<?php
include 'includes/header.php';
include 'includes/footer.php';

renderHeader("Iniciar Sesión - Shopping Descuentos");
?>

<h2 class="text-center mb-4">Iniciar Sesión</h2>
<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="procesar_login.php" method="POST" class="border rounded p-4 shadow-sm bg-light">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required>
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