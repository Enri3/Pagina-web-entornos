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
<div class="container py-2 min-vh-100 px-0 ">
  <div class="  d-flex gap-3 flex-row">

    <!-- Listado de Promociones -->
    <div class="fondo_local rounded p-3 col-12 col-md-8 flex-fill text-light">
      <h3 class="text-center mb-4">Promociones</h3>

      <?php 
        if(empty($promos)){ 
          echo '<div class="alert alert-info text-center" role="alert">'.'No existen promociones cargadas actualmente.'.'</div>';
        }else{ 
          foreach($promos as $unaPromo){ 

            //Para cada promo busco el local
              $queryLocal = "SELECT * FROM Locales WHERE codLocal = ".$unaPromo['codLocal'];
              $resultadoLocal = mysqli_query($conexion, $queryLocal)
                or die("Error en la consulta: " . mysqli_error($conexion));
              $localPromo = mysqli_fetch_assoc($resultadoLocal); 
                ?>
            <span class="ms-3 flex-grow-1 fw-bold"><?php echo $localPromo['nombreLocal'];?> </span>

            <div class=" d-flex align-items-center justify-content-between rounded mb-3 px-3 py-2 fondo_Local border">
            <span class="ms-3 flex-grow-1 fw-bold">Código: <?php echo $unaPromo['codPromo'];?> </span>
             <span class="ms-3 flex-grow-1 fw-bold"><?php echo $unaPromo['textoPromo'];?> </span>
             <form method="POST" action="">
               <input type="hidden" name="codPromo" value="<?= $unaPromo['codPromo'] ?>">
               <button type="submit" class="btn btn-outline-light btn rounded-pill">Ver usos</button>
             </form>
            </div>
        
      <?php } } ?>

    </div>

    <!-- Detalles de la promo -->
    <div class="fondo_local rounded p-3 col-12 col-md-4 flex-fill text-light">

      <?php 
        if(!isset($_POST['codPromo'])){ 
          echo '<div class="alert alert-info text-center" role="alert">'.'Seleccione una promo para ver los detalles.'.'</div>';
        }else{
          //rescato la promo 
          $unaPromo = $promos[$_POST['codPromo']-1];
          //traigo del local de la promo
          $queryLocal = "SELECT * FROM Locales WHERE codLocal = ".$unaPromo['codLocal'];
              $resultadoLocal = mysqli_query($conexion, $queryLocal)
                or die("Error en la consulta: " . mysqli_error($conexion));
              $localPromo = mysqli_fetch_assoc($resultadoLocal); 

          //traigo info del dueño del local de la promo
          $queryDueno = "SELECT * FROM Usuarios WHERE codUsuario = ".$localPromo['codUsuario'];
              $resultadoDueno = mysqli_query($conexion, $queryDueno)
                or die("Error en la consulta: " . mysqli_error($conexion));
              $duenoPromo = mysqli_fetch_assoc($resultadoDueno);

          //busco los usos
          $query = "SELECT * FROM uso_promociones WHERE codPromo = ".$unaPromo['codPromo'];
          $resultado = mysqli_query($conexion, $query)
            or die("Error en la consulta: " . mysqli_error($conexion)); 
          $usos = mysqli_fetch_all($resultado, MYSQLI_ASSOC); 

          echo '<h3 class="text-center mb-4">'.$unaPromo['textoPromo'].' (código: '.$unaPromo['codPromo'].')</h3>';
          echo '<span class="text-center ">'.'En local: '.$localPromo['nombreLocal'].'</span>';
          echo '<br>';
          echo '<span class="text-center ">'.'Dueño del local: '.$duenoPromo['nombreUsuario'].'</span>';
          echo '<br>';
          echo '<br>';
          if(empty($usos)){ 
            echo '<div class="alert alert-info text-center" role="alert">'.'No se utilizó la promoción aún.'.'</div>';
          }else{
            ?>
            <div class="row">
            <?php
            echo '<span class="text-center fw-bold col-4">'.'Usuario'.'</span>';
            echo '<span class="text-center fw-bold col-4">'.'Fecha de uso'.'</span>';
            echo '<span class="text-center fw-bold col-4">'.'Estado'.'</span>';
            ?></div>
            <?php
            foreach($usos as $unUso){ ?>
              <div class=" d-flex align-items-center justify-content-between rounded mb-3 px-3 py-2 fondo_Local border row">
                <?php

                //Para cada uso busco quien fue el cliente
                $queryUsuario = "SELECT * FROM Usuarios WHERE codUsuario = ".$unUso['codCliente'];
                $resultadoUsuario = mysqli_query($conexion, $queryUsuario)
                  or die("Error en la consulta: " . mysqli_error($conexion));
                $usuario_promo = mysqli_fetch_assoc($resultadoUsuario); 
                ?>

                <span class="col-4 text-center fw-bold"><?php echo $usuario_promo['nombreUsuario'];?> </span>
                <span class="col-4 text-center fw-bold"><?php echo $unUso['fechaUsoPromo'];?> </span>
                <span class="col-4 text-center fw-bold"><?php echo $unUso['estado'];?> </span>

              </div>
              
          <?php }
          //cuento y muestro los usos
          $cantidadUsos = mysqli_num_rows($resultado);
          echo '<div class="text-center fw-bold" >'.'Cantidad de usos: ' . $cantidadUsos . '</div>';}
        }?>

    </div>
  </div>
</div>



<?php renderFooter(); ?>