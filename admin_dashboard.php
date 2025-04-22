<?php
require_once 'includes/auth.php';
require_once 'includes/header.php';
require_once 'includes/footer.php';

verificarAcceso('administrador'); // Solo usuarios admin pueden pasar

renderHeader("Panel Administrador - Shopping Descuentos");
?>

<h2 class="mb-4">Hola, <?= htmlspecialchars($_SESSION['nombreUsuario']) ?> (Administrador)</h2>
<p>Validá cuentas, aprobá promociones, gestioná novedades y visualizá reportes.</p>
<!-- CONTENIDO -->
<div class="container py-5">
  <div class="row g-4">

    <!-- Card 1 -->
    <div class="col-md-6">
      <div class="card p-3">
        <img src="imagenes/mall1.jpg" class="card-img-top rounded" alt="Locales">
        <div class="card-body text-center">
          <h5 class="card-title">Gestión de locales</h5>
          <a href="admin_locales.php" class="btn btn-custom mt-2">IR</a>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-6">
      <div class="card p-3">
        <img src="imagenes/mall1.jpg" class="card-img-top rounded" alt="Solicitudes">
        <div class="card-body text-center">
          <h5 class="card-title">Aceptar/denegar solicitudes</h5>
          <a href="#" class="btn btn-custom mt-2">IR</a>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-md-6">
      <div class="card p-3">
        <img src="imagenes/mall1.jpg" class="card-img-top rounded" alt="Novedades">
        <div class="card-body text-center">
          <h5 class="card-title">Gestión de novedades</h5>
          <a href="#" class="btn btn-custom mt-2">IR</a>
        </div>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="col-md-6">
      <div class="card p-3">
        <img src="imagenes/mall1.jpg" class="card-img-top rounded" alt="Descuentos">
        <div class="card-body text-center">
          <h5 class="card-title">Reporte de descuentos</h5>
          <a href="#" class="btn btn-custom mt-2">IR</a>
        </div>
      </div>
    </div>

  </div>
</div>


<!-- sacar -->
<a href="logout.php" class="btn btn-danger mt-3">Cerrar sesión</a>

<?php renderFooter(); ?>