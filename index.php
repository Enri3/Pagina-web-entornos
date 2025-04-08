<head>
    <meta charset="utf-8">
    <title>pagina de prueba</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-danger-subtle">
<?php
include_once("header.html");
?>
<br>
<br>
<br>
<?php
?>
<form class="bg-danger w-25 mx-auto mb-0 p-3" action="formulario.php" method="get">
    <h1>Registro</h1>
    <input type="user" class="form-control" name="usuario" placeholder="Usuario">
    <br>
    <input type="email" class="form-control" name="mail" placeholder="Email">
    <br>
    <input type="password" class="form-control" name="contra" placeholder="Contrasena">
    <br>
    <button type="submit" class="btn btn-primary w-100">Enviar</button>
</form>
<?php
?>
<form class="bg-danger w-25 mx-auto mb-0 p-3" action="buscarCuenta.php" method="get">
    <h1>Inicio de secion</h1>
    <input type="user" class="form-control" name="usuario" placeholder="Usuario">
    <br>
    <input type="password" class="form-control" name="contra" placeholder="Contrasena">
    <br>
    <button type="submit" class="btn btn-primary w-100">Enviar</button>
</form>
<?php
include_once("footer.html");
?>
</body>