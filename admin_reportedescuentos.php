<?php
require_once 'includes/header.php';
require_once 'includes/footer.php';
require_once 'includes/auth.php';
require_once 'includes/conexion.php';

verificarAcceso('administrador'); // Solo usuarios admin pueden pasar
renderHeader("Reporte de Descuentos");

$query = "SELECT * FROM promociones";
$resultado = mysqli_query($conexion, $query)
  or die("Error en la consulta: " . mysqli_error($conexion)); 
$promos = mysqli_fetch_all($resultado, MYSQLI_ASSOC)?>

<!-- Contenido de la página -->
<div class="container my-5">
  <h2 class="text-center mb-4">Reporte de descuentos</h2>
</div>

<!-- Listado de Promociones -->
<div class="container-fluid py-2 min-vh-100 px-0">
  <div class="d-flex gap-3">

    <!-- Listado de Promociones -->
    <div class="fondo_local rounded p-3 flex-grow-1 text-light">
      <h3 class="text-center mb-4">Promociones</h3>

      <?php 
        if(empty($promos)){ 
          echo '<div class="alert alert-info text-center" role="alert">'.'No existen promociones cargadas actualmente.'.'</div>';
        }else{ 
          foreach($promos as $unaPromo){ ?>
            <div class=" d-flex align-items-center justify-content-between rounded mb-3 px-3 py-2 fondo_Local border ">
             <span class="ms-3 flex-grow-1 fw-bold"><?php echo $unaPromo['textoPromo'];?> </span>
             <form method="POST" action="">
               <input type="hidden" name="codPromo" value="<?= $unaPromo['codPromo'] ?>">
               <button type="submit" class="btn btn-outline-light btn rounded-pill">Ver detalles</button>
             </form>
            </div>
        
      <?php } } ?>

    </div>

    <!-- Detalles de la promo -->
    <div class="fondo_local rounded p-3 flex-grow-1 text-light">

      <?php 
        if(!isset($_POST['codPromo'])){ 
          echo '<div class="alert alert-info text-center" role="alert">'.'Seleccione una promo para ver los detalles.'.'</div>';
        }else{
          //rescato la promo
          $unaPromo = $promos[$_POST['codPromo']-1];
          //busco los usos
          $query = "SELECT * FROM uso_promociones WHERE codPromo = ".$unaPromo['codPromo'];
          $resultado = mysqli_query($conexion, $query)
            or die("Error en la consulta: " . mysqli_error($conexion)); 
          $usos = mysqli_fetch_all($resultado, MYSQLI_ASSOC); 
          echo '<h3 class="text-center mb-4">'.$unaPromo['textoPromo'].' (código: '.$unaPromo['codPromo'].')</h3>';
          
          if(empty($usos)){ 
            echo '<div class="alert alert-info text-center" role="alert">'.'No se utilizó la promoción aún.'.'</div>';
          }else{
            echo '<span class="ms-3 flex-grow-1 fw-bold">'.'Usuario'.'</span>';
            echo '<span class="ms-3 flex-grow-1 fw-bold">'.'Fecha de uso'.'</span>';
            foreach($usos as $unUso){ ?>
              <div class=" d-flex align-items-center justify-content-between rounded mb-3 px-3 py-2 fondo_Local border ">

                <span class="ms-3 flex-grow-1 fw-bold"><?php echo $unUso['codCliente'];?> </span>
                <span class="ms-3 flex-grow-1 fw-bold"><?php echo $unUso['fechaUsoPromo'];?> </span>

              </div>
          <?php }}
        }?>

    </div>
  </div>
</div>



<?php renderFooter(); ?>