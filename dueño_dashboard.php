<?php
require_once 'includes/auth.php';
require_once 'includes/header.php';
require_once 'includes/footer.php';

verificarAcceso('dueño de local'); // Solo usuarios duenio pueden pasar

renderHeader("Panel Dueño - Shopping Descuentos");
?>

<h2 class="mb-4">Hola, <?= htmlspecialchars($_SESSION['nombreUsuario']) ?> (Dueño de local)</h2>
<p>Gestioná tus descuentos, revisá solicitudes de clientes y visualizá el uso de tus promociones.</p>

<a href="logout.php" class="btn btn-danger mt-3">Cerrar sesión</a>

<?php renderFooter(); ?>