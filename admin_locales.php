<?php
require_once 'includes/header.php';
require_once 'includes/footer.php';
require_once 'includes/auth.php';
require_once 'includes/conexion.php';

verificarAcceso('administrador'); // Solo usuarios admin pueden pasar

renderHeader("Gestión de Locales");

//Traer locales

if (isset($_POST['crear_local'])){
    
    global $conexion;
    
    $nombreLocal = $_POST['nombreLocal'];
    $ubicacionLocal = $_POST['ubicacionLocal'];
    $rubroLocal = $_POST['rubroLocal'];
    $codUsuario = $_POST['codUsuario'];
    
    
    $query = "INSERT INTO locales (nombreLocal, ubicacionLocal, rubroLocal, codUsuario) VALUES ('$nombreLocal', '$ubicacionLocal', '$rubroLocal', '$codUsuario')";
    if (mysqli_query($conexion, $query)) {
        header("Location: admin_locales.php?mensaje=Local+creado+correctamente");
        exit;
    } else {
        header("Location: admin_locales.php?mensaje=Error+al+crear+el+local:+");
        exit;
    }
}

if (isset($_POST['editar_local'])) {
  global $conexion;

  $codLocal = $_POST['codLocal']; // ID del local que se edita
  $nombreLocal = $_POST['nombreLocal'];
  $ubicacionLocal = $_POST['ubicacionLocal'];
  $rubroLocal = $_POST['rubroLocal'];
  $codUsuario = $_POST['codUsuario'];

  $query = "UPDATE locales 
            SET nombreLocal='$nombreLocal', ubicacionLocal='$ubicacionLocal', rubroLocal='$rubroLocal', codUsuario='$codUsuario'
            WHERE codLocal='$codLocal'";

  if (mysqli_query($conexion, $query)) {
      header("Location: admin_locales.php?mensaje=Local+editado+correctamente");
      exit;
  } else {
      header("Location: admin_locales.php?mensaje=Error+al+editar+el+local");
      exit;
  }
}

if (isset($_POST['eliminar_local'])) {
  global $conexion;
  $codLocal = $_POST['codLocalEliminar'];

  $query = "DELETE FROM locales WHERE codLocal = $codLocal";
  if (mysqli_query($conexion, $query)) {
      header("Location: admin_locales.php?mensaje=Local+eliminado+correctamente");
      exit;
  } else {
      header("Location: admin_locales.php?mensaje=Error+al+eliminar+el+local");
      exit;
  }
}

if (isset($_GET['mensaje']) && $_GET['mensaje'] != "Editar-local" && $_GET['mensaje'] != "Eliminar-local") {
?>
  <div class="alert alert-success text-center">
      <?= htmlspecialchars($_GET['mensaje']) ?>
  </div>
<?php
}

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


<div class="container-fluid py-2 min-vh-100 px-0">
    <div class="d-flex ">
        <!-- Locales -->
        <div class=" fondo_local rounded p-3 flex-grow-1 text-light ">
            <?php
                foreach($locales as $local) { ?>

                    <div class=" d-flex align-items-center justify-content-between rounded mb-3 px-3 py-2 fondo_Local border ">
                    <span class="ms-3 flex-grow-1 fw-bold"><?php echo $local['nombreLocal'];?> </span>
                    <?php 
                    if(isset($_GET['mensaje'])){
                      if ($_GET['mensaje'] === "Editar-local"){
                        ?>
                        <button class="btn btn-outline-light btn rounded-pill" data-bs-toggle="modal" data-bs-target="#modalEditarLocal<?= $local['codLocal'] ?>">Editar local</button>
                        <!-- Modal para editar local -->
                        <div class="modal fade" id="modalEditarLocal<?= $local['codLocal'] ?>" tabindex="-1" aria-labelledby="modalEditarLocal<?= $local['codLocal'] ?>" aria-hidden="true">
                          <div class="modal-dialog">
                            <form action="admin_locales.php" method="POST" class="modal-content bg-white text-dark">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalEditarLabel<?= $local['codLocal'] ?>">Editar Local</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                              </div>
                              <div class="modal-body">

                                <input type="hidden" name="codLocal" value="<?= $local['codLocal'] ?>">

                                <div class="mb-3">
                                  <label for="nombreLocal" class="form-label">Nombre del Local</label>
                                  <input type="text" name="nombreLocal" class="form-control" value="<?= htmlspecialchars($local['nombreLocal']) ?>" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Ubicación</label>
                                  <input type="text" name="ubicacionLocal" class="form-control" value="<?= htmlspecialchars($local['ubicacionLocal']) ?>" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Rubro</label>
                                  <input type="text" name="rubroLocal" class="form-control" value="<?= htmlspecialchars($local['rubroLocal']) ?>" required>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Dueño del Local</label>
                                  <select name="codUsuario" class="form-select" required>
                                    <?php
                                    $query = "SELECT codUsuario, nombreUsuario FROM usuarios WHERE tipoUsuario = 'dueño de local'";
                                    $duenios = mysqli_query($conexion, $query);
                                    while ($duenio = mysqli_fetch_assoc($duenios)) {
                                        $selected = ($duenio['codUsuario'] == $local['codUsuario']) ? 'selected' : '';
                                        echo "<option value='{$duenio['codUsuario']}' $selected>{$duenio['nombreUsuario']}</option>";
                                    }
                                    ?>
                                  </select>
                                </div>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="editar_local" class="btn btn-primary">Guardar cambios</button>
                              </div>
                            </form>
                          </div>
                        </div>
                        <?php
                        }elseif($_GET['mensaje'] === "Eliminar-local"){
                        ?>
                        <button class="btn btn-outline-light btn rounded-pill" data-bs-toggle="modal" data-bs-target="#modalEliminarLocal<?= $local['codLocal'] ?>">Eliminar local</button>
                        <!-- Modal de confirmación para eliminar -->
                        <div class="modal fade" id="modalEliminarLocal<?= $local['codLocal'] ?>" tabindex="-1" aria-labelledby="labelEliminar<?= $local['codLocal'] ?>" aria-hidden="true">
                          <div class="modal-dialog">
                            <form action="admin_locales.php" method="POST" class="modal-content bg-white text-dark">
                              <div class="modal-header">
                                <h5 class="modal-title" id="labelEliminar<?= $local['codLocal'] ?>">Eliminar Local</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" name="codLocalEliminar" value="<?= $local['codLocal'] ?>">
                                <p>¿Estás seguro que querés eliminar el local <strong><?= htmlspecialchars($local['nombreLocal']) ?></strong>?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="eliminar_local" class="btn btn-danger">Eliminar</button>
                              </div>
                            </form>
                          </div>
                        </div>
                        <?php
                        }
                    }
                    ?>
                      <button class="btn btn-outline-light btn rounded-pill">Ver más</button>
                      <?php
                    ?>
                    </div>
                    
                    <?php }

                ?>
        </div>
            <!-- Botones de acciones -->
            <div class="d-flex flex-column col-2 ms-4 gap-3 flex-column justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalNuevoLocal">Crear Local</button>
                <a href="admin_locales.php?mensaje=Editar-local" class="btn btn-secondary">Editar local</a>
                <a href="admin_locales.php?mensaje=Eliminar-local" class="btn btn-secondary">Elimar local</a>
            </div>
    </div>
</div>

<!-- Modal para crear local -->
<div class="modal fade" id="modalNuevoLocal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="admin_locales.php" method="POST" class="modal-content">
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
          <select name="rubroLocal" id="rubroLocal" class="form-select" required>
                    <option value="">Seleccionar...</option>
                    <option value="Indumentaria">Indumentaria</option>
                    <option value="Perfumeria">Perfumeria</option>
                    <option value="Comida">Comida</option>
                    <option value="Bazar">Bazar</option>
                </select>
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
        <button type="submit" name="crear_local" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>

<?php



renderFooter();
?>