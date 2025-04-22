<?php
require_once 'includes/header.php';
require_once 'includes/footer.php';
require_once 'includes/auth.php';
require_once 'includes/conexion.php';

verificarAcceso('administrador'); // Solo usuarios admin pueden pasar

renderHeader("Gestión de Locales");

//Traer locales

$query = "SELECT * FROM locales";
$resultado = mysqli_query($conexion, $query);
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
$locales = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

?>
<div class="container my-5">
    <h2 class="text-center mb-4">Administrar Locales</h2>


</div>


<div class="container-fluid py-5">
    <div class="d-flex">
        <!-- Locales -->
        <div class="bg-secondary bg-opacity-50 rounded p-3" style="width: 400px; height: 500px; overflow-y: auto;">
            <?php
                foreach($locales as $local) { ?>

                    <div class=" d-flex align-items-center justify-content-between rounded mb-3 px-3 py-2 fondo_Local">
                    <span class="ms-3 flex-grow-1 fw-bold"><?php echo $local['nombreLocal'];?> </span>
                    <button class="btn btn-outline-light btn-sm rounded-pill">INFO</button>
                    </div>
                    
                    <?php }

                ?>
        </div>
            <!-- Botones de acciones -->
            <div class="d-flex flex-column ms-4 gap-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevoLocal">Crear Local</button>
                <a href="admin_editar_local.php" class="btn btn-primary">Editar Local</a>
                <a href="admin_eliminar_local.php" class="btn btn-danger">Eliminar Local</a>
            </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalNuevoLocal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="admin_nuevo_local.php" method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="miModalLabel">Crear Local</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="nombreLocal" class="form-label">Nombre del Local</label>
          <input type="text" name="nombreLocal" id="nombreLocal" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="ubicacionLocal" class="form-label">Ubicación</label>
          <input type="text" name="ubicacionLocal" id="ubicacionLocal" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="rubroLocal" class="form-label">Rubro</label>
          <input type="text" name="rubroLocal" id="rubroLocal" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="codUsuario" class="form-label">Dueño del Local</label>
          <select name="codUsuario" id="codUsuario" class="form-select" required>
            <option value="">Seleccionar dueño...</option>
            <?php
            global $conexion;
            $query = "SELECT codUsuario, nombreUsuario FROM usuarios WHERE tipoUsuario = 'dueño de local'";
            $resultado = mysqli_query($conexion, $query);
            if (!$resultado || mysqli_num_rows($resultado) < 1) {
                die("Error en la consulta: " . mysqli_error($conexion));
            }
            $duenios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
            foreach ($duenios as $duenio) {
                echo "<option value='{$duenio['codUsuario']}'>{$duenio['nombreUsuario']}</option>";
            }
            ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>




<?php

renderFooter();
?>