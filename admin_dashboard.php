<?php
require_once 'includes/auth.php';
require_once 'includes/header.php';
require_once 'includes/footer.php';

verificarAcceso('admin'); // Solo usuarios admin pueden pasar

renderHeader("Panel Administrador - Shopping Descuentos");
?>

<h2 class="mb-4">Hola, <?= htmlspecialchars($_SESSION['nombre']) ?> (Administrador)</h2>
<p>Validá cuentas, aprobá promociones, gestioná novedades y visualizá reportes.</p>

<a href="logout.php" class="btn btn-danger mt-3">Cerrar sesión</a>

<?php renderFooter(); ?>