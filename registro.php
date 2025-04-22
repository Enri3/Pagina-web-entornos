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
                <label for="nombreUsuario" class="form-label">Nombre completo</label>
                <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="claveUsuario" class="form-label">Contraseña</label>
                <input type="password" name="claveUsuario" id="claveUsuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tipoUsuario" class="form-label">Tipo de usuario</label>
                <select name="tipoUsuario" id="tipoUsuario" class="form-select" required>
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

<?php 
if (isset($_GET['error'])){ ?>
    <div class="alert alert-danger text-center">
        <?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php 
}
renderFooter();
?>