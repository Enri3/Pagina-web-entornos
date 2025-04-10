<?php
include 'includes/header.php';
include 'includes/footer.php';

renderHeader("Registrarse - Shopping Descuentos");
?>

<h2 class="text-center mb-4">Registrarse</h2>
<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="procesar_registro.php" method="POST" class="border rounded p-4 shadow-sm bg-light">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Tipo de usuario</label>
                <select name="rol" id="rol" class="form-select" required>
                    <option value="">Seleccionar...</option>
                    <option value="cliente">Cliente</option>
                    <option value="duenio">Dueño de local</option>
                </select>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Crear cuenta</button>
            </div>
            <div class="text-center mt-3">
                <a href="login.php">¿Ya tenés cuenta? Iniciar sesión</a>
            </div>
        </form>
    </div>
</div>

<?php renderFooter(); ?>