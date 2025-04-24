<?php
require_once 'includes/auth.php';
require_once 'includes/header.php';
require_once 'includes/footer.php';

verificarAcceso('cliente'); // Solo usuarios cliente pueden pasar

renderHeader("Panel Cliente - Shopping Descuentos");
?>

<h2 class="mb-4">Hola, <?= htmlspecialchars($_SESSION['nombreUsuario']) ?> </h2>
<p>Accedé a descuentos, buscá promociones y revisá las novedades del shopping.</p>

<!-- CONTENIDO -->
<div class="container py-5">
  <div class="row g-4">

    <!-- Card 1 -->
    <div class="col-md-6">
      <div class="card p-3">
        <img src="imagenes/mall1.jpg" class="card-img-top rounded" alt="Locales">
        <div class="card-body text-center">
          <h5 class="card-title">Buscar descuentos y promociones</h5>
          <a href="admin_locales.php" class="btn btn-custom mt-2">IR</a>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-6">
      <div class="card p-3">
        <img src="imagenes/mall1.jpg" class="card-img-top rounded" alt="Solicitudes">
        <div class="card-body text-center">
          <h5 class="card-title">Ver novedades</h5>
          <a href="#" class="btn btn-custom mt-2">IR</a>
        </div>
      </div>
    </div>


<?php renderFooter(); ?>