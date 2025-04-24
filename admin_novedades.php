<?php
require_once 'includes/header.php';
require_once 'includes/footer.php';
require_once 'includes/auth.php';
require_once 'includes/conexion.php';

verificarAcceso('administrador'); // Solo usuarios admin pueden pasar

renderHeader("Gestión de Novedades");

//Insertar Novedad
if (isset($_POST['crear_novedad'])){
    $textoNovedad = $_POST['textoNovedad'];
    $fechaDesdeNovedad = $_POST['fechaDesdeNovedad'];
    $fechaHastaNovedad = $_POST['fechaHastaNovedad'];
    $tipoUsuario = $_POST['tipoUsuario'];

    if (date('Y-m-d') > $fechaDesdeNovedad || $fechaDesdeNovedad > $fechaHastaNovedad) {
        header("Location: admin_novedades.php?mensaje=La+fecha+de+inicio+no+puede+ser+mayor+a+la+fecha+de+hoy+o+a+la+fecha+de+fin.");
        exit;
    }

    // Insertar la novedad en la base de datos
    $query = "INSERT INTO novedades (textoNovedad, fechaDesdeNovedad, fechaHastaNovedad, tipoUsuario) 
              VALUES ('$textoNovedad', '$fechaDesdeNovedad', '$fechaHastaNovedad', '$tipoUsuario')";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: admin_novedades.php?mensaje=Novedad+creada+correctamente");
        exit;
    } else {
        header("Location: admin_novedades.php?mensaje=Error+al+crear+la+novedad:+");
        exit;
    }
}

//Editar Novedad
if (isset($_POST['editar_novedad'])) {
    $codNovedad = $_POST['codNovedad']; // ID del local que se edita
    $textoNovedad = $_POST['textoNovedad'];
    $fechaDesdeNovedad = $_POST['fechaDesdeNovedad'];
    $fechaHastaNovedad = $_POST['fechaHastaNovedad'];
    $tipoUsuario = $_POST['tipoUsuario'];
  
    if (date('Y-m-d') > $fechaDesdeNovedad || $fechaDesdeNovedad > $fechaHastaNovedad) {
        header("Location: admin_novedades.php?mensaje=La+fecha+de+inicio+no+puede+ser+mayor+a+la+fecha+de+hoy+o+a+la+fecha+de+fin.");
        exit;
    }

    $query = "UPDATE novedades 
              SET textoNovedad='$textoNovedad', fechaDesdeNovedad='$fechaDesdeNovedad', fechaHastaNovedad='$fechaHastaNovedad', tipoUsuario='$tipoUsuario'
              WHERE codNovedad='$codNovedad'";
  
    if (mysqli_query($conexion, $query)) {
        header("Location: admin_novedades.php?mensaje=Novedad+editada+correctamente");
        exit;
    } else {
        header("Location: admin_novedades.php?mensaje=Error+al+editar+la+novedad");
        exit;
    }
}

//Eliminar Novedad
if (isset($_POST['eliminar_novedad'])) {
    $codNovedad = $_POST['codNovedad'];
  
    $query = "DELETE FROM novedades WHERE codNovedad = $codNovedad";
    if (mysqli_query($conexion, $query)) {
        header("Location: admin_novedades.php?mensaje=Novedad+eliminada+correctamente");
        exit;
    } else {
        header("Location: admin_novedades.php?mensaje=Error+al+eliminar+la+novedad");
        exit;
    }
}

//Mostrar alertas
if (isset($_GET['mensaje']) && $_GET['mensaje'] != "Editar-novedad" && $_GET['mensaje'] != "Eliminar-novedad") { ?>
    <div class="alert alert-success text-center">
      <?= htmlspecialchars($_GET['mensaje']) ?>
    </div>
  <?php 
}

//Trer Novedades
$query = "SELECT * FROM novedades";
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
  die("Error en la consulta: " . mysqli_error($conexion));
}

$novedades = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

?>
<div class="container my-5">
  <h2 class="text-center mb-4">Administrar Novedades</h2>
</div>

<!-- Contenido de la caja -->
<div class="container-fluid py-2 min-vh-100 px-0">
  <div class="d-flex ">

    
    <!-- Listado de novedades -->
    <div class=" fondo_novedad rounded p-3 flex-grow-1 text-light ">

      <h3 class="text-center mb-4">Novedades</h3>

      <?php if (empty($novedades)) { ?>
          <div class="alert alert-info text-center" role="alert">
              No existen novedades cargadas actualmente.
          </div>
      <?php } else  ?>

      <?php foreach($novedades as $novedad) { ?>

        <div class=" d-flex align-items-center justify-content-between rounded mb-3 px-3 py-2 fondo_Novedad border ">
          <span class="ms-3 flex-grow-1 fw-bold"><?php echo $novedad['textoNovedad'];?> </span>

          <span class="ms-3 flex-grow-1 fw-bold"><?php echo $novedad['fechaDesdeNovedad'];?> </span>
          
          <span class="ms-3 flex-grow-1 fw-bold"><?php echo $novedad['fechaHastaNovedad'];?> </span>

          <span class="ms-3 flex-grow-1 fw-bold"><?php echo $novedad['tipoUsuario'];?> </span>
        

          <?php 
            if(isset($_GET['mensaje'])){
              if ($_GET['mensaje'] === "Editar-novedad"){
          ?>

            <button class="btn btn-outline-light btn rounded-pill" data-bs-toggle="modal" data-bs-target="#modalEditarNovedad<?= $novedad['codNovedad'] ?>">Editar novedad</button>

            <!-- Modal para editar novedad -->
            <div class="modal fade" id="modalEditarNovedad<?= $novedad['codNovedad'] ?>" tabindex="-1" aria-labelledby="modalEditarNovedad<?= $novedad['codNovedad'] ?>" aria-hidden="true">
              <div class="modal-dialog">
                <form action="admin_novedades.php" method="POST" class="modal-content bg-white text-dark">

                  <!-- header -->
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel<?= $novedad['codNovedad'] ?>">Editar Novedad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                  </div>

                  <!-- body -->
                  <div class="modal-body">

                    <input type="hidden" name="codNovedad" value="<?= $novedad['codNovedad'] ?>">

                    <div class="mb-3">
                      <label for="textoNovedad" class="form-label">Nombre de la Novedad</label>
                      <input type="text" name="textoNovedad" class="form-control" value="<?= htmlspecialchars($novedad['textoNovedad']) ?>" required>
                    </div>

                    <div class="mb-3">
                      <label for="fechaDesdeNovedad" class="form-label">Fecha desde</label>
                      <input type="date" name="fechaDesdeNovedad" class="form-control" value="<?= htmlspecialchars($novedad['fechaDesdeNovedad']) ?>" required>
                    </div>

                    <div class="mb-3">
                      <label for="fechaHastaNovedad" class="form-label">Fecha desde</label>
                      <input type="date" name="fechaHastaNovedad" class="form-control" value="<?= htmlspecialchars($novedad['fechaHastaNovedad']) ?>" required>
                    </div>
                    
                 </div>

                 <!-- footer -->
                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                   <button type="submit" name="editar_novedad" class="btn btn-primary">Guardar cambios</button>
                 </div>

               </form>
             </div>
            </div>

          <?php }elseif($_GET['mensaje'] === "Eliminar-novedad"){ ?>

            <button class="btn btn-outline-light btn rounded-pill" data-bs-toggle="modal" data-bs-target="#modalEliminarNovedad<?= $novedad['codNovedad'] ?>">Eliminar novedad</button>

            <!-- Modal de confirmación para eliminar -->
            <div class="modal fade" id="modalEliminarNovedad<?= $novedad['codNovedad'] ?>" tabindex="-1" aria-labelledby="labelEliminar<?= $novedad['codNovedad'] ?>" aria-hidden="true">
              <div class="modal-dialog">
                <form action="admin_novedades.php" method="POST" class="modal-content bg-white text-dark">

                  <!-- header -->
                  <div class="modal-header">
                    <h5 class="modal-title" id="labelEliminar<?= $novedad['codNovedad'] ?>">Eliminar Novedad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                  </div>

                  <!-- body -->
                  <div class="modal-body">
                    <input type="hidden" name="codNovedad" value="<?= $novedad['codNovedad'] ?>">
                    <p>¿Estás seguro que querés eliminar la novedad <strong><?= htmlspecialchars($novedad['textoNovedad']) ?></strong>?</p>
                  </div>

                  <!-- footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="eliminar_novedad" class="btn btn-danger">Eliminar</button>
                  </div>

                </form>
              </div>
            </div>

          <?php } }elseif(!isset($_GET['mensaje'])){ ?>

            <!-- Función Ver novedad (WIP)-->
            <button class="btn btn-outline-light btn rounded-pill">Ver más</button>
            
          <?php } ?>

        </div>

      <?php } ?>
    </div>

    <!-- Botones de acciones -->
    <div class="d-flex flex-column col-2 ms-4 gap-3 flex-column justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalNuevaNovedad">Crear Novedad</button>
        <a href="admin_novedades.php?mensaje=Editar-novedad" class="btn btn-secondary">Editar novedad</a>
        <a href="admin_novedades.php?mensaje=Eliminar-novedad" class="btn btn-secondary">Eliminar novedad</a>
    </div>
  </div>
</div>

<!-- Modal para crear novedad -->
<div class="modal fade" id="modalNuevaNovedad" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="admin_novedades.php" method="POST" class="modal-content">

      <!-- header -->
      <div class="modal-header">
        <h5 class="modal-title" id="miModalLabel">Crear Novedad</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- body -->
      <div class="modal-body">

        <div class="mb-3">
          <label for="textoNovedad" class="form-label">Texto de la novedad</label>
          <input type="text" name="textoNovedad" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="fechaDesdeNovedad" class="form-label">Fecha desde</label>
          <input type="date" name="fechaDesdeNovedad" class="form-control" required>
        </div>
        
        <div class="mb-3">
          <label for="fechaHastaNovedad" class="form-label">Fecha desde</label>
          <input type="date" name="fechaHastaNovedad" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="tipoUsuario" class="form-label">Tipo de usuario</label>
          <select name="tipoUsuario" id="tipoUsuario" class="form-select" required>
            <option value="" disabled selected>Seleccionar...</option>
            <option value="Inicial">Inicial</option>
            <option value="Medium">Medium</option>
            <option value="Premium">Premium</option>
          </select>
        </div>

      </div>

      <!-- footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" name="crear_novedad" class="btn btn-primary">Guardar</button>
      </div>

    </form>
  </div>
</div>

<?php renderFooter(); ?>