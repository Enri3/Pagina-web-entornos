<?php
session_start();
require_once 'includes/header.php';
require_once 'includes/footer.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'duenio') {
    header("Location: login.php");
    exit;
}

renderHeader("Panel Dueño - Shopping Descuentos");
?>

<h2 class="mb-4">Hola, <?= htmlspecialchars($_SESSION['nombre']) ?> (Dueño de local)</h2>
<p>Gestioná tus descuentos, revisá solicitudes de clientes y visualizá el uso de tus promociones.</p>

<a href="logout.php" class="btn btn-danger mt-3">Cerrar sesión</a>

<?php renderFooter(); ?>