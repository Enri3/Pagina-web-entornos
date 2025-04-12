<?php

function redireccion($tipo){
  if ($tipo === 'administrador') {
      header("Location: admin_dashboard.php");
  } elseif ($tipo === 'dueño de local') {
      header("Location: dueño_dashboard.php");
  } elseif ($tipo === 'cliente') {
      header("Location: cliente_dashboard.php");
  }
  exit;
}
?>