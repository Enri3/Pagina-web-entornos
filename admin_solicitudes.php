<?php
require_once 'includes/header.php';
require_once 'includes/footer.php';
require_once 'includes/auth.php';
require_once 'includes/conexion.php';

verificarAcceso('administrador');

renderHeader("Gestión de descuentos");

// Leer acción
if (isset($_GET['accion']) && ($_GET['accion'] === "Denegar" || $_GET['accion'] === "Aprobar")) {
    $accion = $_GET['accion'];
} else {
    $accion = null;
}

// Enviar decisión de la solicitud
if (isset($_POST['solicitud'])) {
    $codSolicitud = $_POST['codSolicitud'];

    if ($_GET['accion'] === "Aprobar") {
        $estado = "Confirmada";
    } else {
        $estado = "Rechazada";
    }

    $query = "UPDATE solicitudes SET estado='$estado' WHERE codSolicitud='$codSolicitud'";

    if (mysqli_query($conexion, $query)) {
        header("Location: admin_solicitudes.php");
        exit;
    } else {
        header("Location: admin_solicitudes.php");
        exit;
    }
}

// Traer solo solicitudes pendientes
$query = "SELECT * FROM solicitudes WHERE estado='Pendiente'";
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

$solicitudes = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
?>

<div class="container my-5">
  <h2 class="text-center mb-4">Aprobar/denegar solicitudes de descuentos</h2>
</div>

<!-- Contenido de la página -->
<div class="container-fluid py-2 min-vh-100 px-0">
  <div class="d-flex ">

    <!-- Listado de locales -->
    <div class="fondo_local rounded p-3 flex-grow-1 text-light">

      <h3 class="text-center mb-4">Solicitudes</h3>

      <?php if (empty($solicitudes)) { ?>
        <div class="alert alert-info text-center" role="alert">
          No existen solicitudes pendientes actualmente.
        </div>
      <?php } else { ?>

        <?php foreach ($solicitudes as $solicitud) { ?>
          <div class="d-flex align-items-center justify-content-between rounded mb-3 px-3 py-2 fondo_Local border">
            <span class="ms-3 flex-grow-1 fw-bold text-center"><?= $solicitud['codUsuario']; ?></span>
            <span class="ms-3 flex-grow-1 fw-bold text-center"><?= $solicitud['nombreDescuento']; ?></span>
            <span class="ms-3 flex-grow-1 fw-bold text-center"><?= $solicitud['codLocal']; ?></span>

            <?php if ($accion) { ?>
              <button class="btn btn-outline-light btn rounded-pill" data-bs-toggle="modal" data-bs-target="#modalSolicitud<?= $solicitud['codSolicitud'] ?>"><?= $accion ?> solicitud</button>

              <!-- Modal Solicitud -->
              <div class="modal fade" id="modalSolicitud<?= $solicitud['codSolicitud'] ?>" tabindex="-1" aria-labelledby="label<?= $solicitud['codSolicitud'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                  <form action="admin_solicitudes.php?accion=<?= $accion ?>" method="POST" class="modal-content bg-white text-dark">
                    <div class="modal-header">
                      <h5 class="modal-title" id="label<?= $solicitud['codSolicitud'] ?>"><?= $accion ?> solicitud</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="codSolicitud" value="<?= $solicitud['codSolicitud'] ?>">
                      <p>¿Estás seguro que querés <?= $accion ?> la solicitud <strong><?= htmlspecialchars($solicitud['nombreDescuento']) ?></strong>?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="submit" name="solicitud" class="btn btn-success"><?= $accion ?></button>
                    </div>
                  </form>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } ?>
      <?php } ?>
    </div>

    <!-- Botones de acciones -->
    <div class="d-flex flex-column col-2 ms-4 gap-3 flex-column justify-content-center">
      <a href="admin_solicitudes.php?accion=Aprobar" class="btn btn-secondary">Aprobar solicitud</a>
      <a href="admin_solicitudes.php?accion=Denegar" class="btn btn-secondary">Denegar solicitud</a>
    </div>

  </div>
</div>

<?php renderFooter(); ?>
