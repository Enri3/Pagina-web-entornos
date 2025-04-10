<?php
session_start();
require_once 'includes/header.php';
require_once 'includes/footer.php';

// Redirección si no hay sesión activa o rol incorrecto
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'cliente') {
    header("Location: login.php");
    exit;
}

renderHeader("Panel Cliente - Shopping Descuentos");
?>

<h2 class="mb-4">Hola, <?= htmlspecialchars($_SESSION['nombre']) ?> (Cliente)</h2>
<p>Accedé a descuentos, buscá promociones y revisá las novedades del shopping.</p>

<a href="logout.php" class="btn btn-danger mt-3">Cerrar sesión</a>

<?php renderFooter(); ?>