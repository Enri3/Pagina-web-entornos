<?php
include 'includes/header.php';
include 'includes/footer.php';
include 'includes/redireccion.php';

session_start();
if (isset($_SESSION['nombreUsuario'])) {
    // Si el usuario ya está logueado, redirigir a la página de inicio o a otra página
    redireccion($_SESSION['tipoUsuario']);
    exit;
}
renderHeader("Inicio - Altiora");


//Presentación

echo '<div class="container mb-5">';

echo '      <h1 class="text-center">'.'Bienvenido a Altiora'.'</h1>';
if (!isset($_SESSION['nombreUsuario'])) {
    echo '<h5 class="text-center mb-4"><i><a href=login.php>'.'Inicie sesión</a></i> para disfrutar todos los beneficios'.'</i></h5>';
}
?>
            
            <div class="col-12">
              <div class="card p-3">
                <img src="imagenes/mall1.jpg" class="card-img-top rounded" alt="Locales">
                <div class="card-body text-center">
                  <h5 class="card-title">Buscar descuentos y promociones</h5>
                  <a href="" class="btn btn-custom mt-2">IR</a>
                </div>
              </div>
            </div>

      </div>
<?php renderFooter(); ?>
