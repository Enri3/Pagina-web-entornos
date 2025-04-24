<?php
require_once 'includes/auth.php';
require_once 'includes/header.php';
require_once 'includes/footer.php';

verificarAcceso('dueño de local'); // Solo usuarios duenio pueden pasar

renderHeader("Panel Dueño - Shopping Descuentos");
?>

<h2 class="mb-4">Hola, <?= htmlspecialchars($_SESSION['nombreUsuario']) ?> </h2>
<p>Gestioná tus descuentos, revisá solicitudes de clientes y visualizá el uso de tus promociones.</p>

    <div class="col-md-6">
      <div class="card p-3">
        <img src="imagenes/mall1.jpg" class="card-img-top rounded" alt="Locales">
        <div class="card-body text-center">
          <h5 class="card-title">Gestión de descuentos</h5>
          <a href="admin_locales.php" class="btn btn-custom mt-2">IR</a>
        </div>
      </div>
    </div>

<?php renderFooter(); ?>