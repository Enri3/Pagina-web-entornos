<?php
if (isset($_GET['usuario']) and isset($_GET['mail']) and isset($_GET['contra'])) {
	$name = $_GET['usuario'];
	$email = $_GET['mail'];
    $contra = md5($_GET['contra']);
	include_once("connectDB.php");
	$result = mysqli_query($nombreConexion, "INSERT INTO cuentas (usuario, contrasena, mail) VALUES ('$name', '$contra', '$email');");
    ?>
    <table>
        <tr>
            <td>ID</td>
            <td>Uusario</td>
            <td>Contrasena</td>
            <td>Mail</td>
        </tr>
    <?php
    $table = mysqli_query($nombreConexion, "SELECT * FROM `cuentas`");
    if (mysqli_num_rows($table)){
        while($cuenta = mysqli_fetch_assoc($table)){
            echo "<tr><td>".$cuenta['id']."</td>";
            echo "<td>".$cuenta['usuario']."</td>";
            echo "<td>".$cuenta['contrasena']."</td>";
            echo "<td>".$cuenta['mail']."</td></tr>";
        }
    }
    ?></table><?php
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>pagina de prueba</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1>Registro</h1>
    <form class="bg-danger w-25 mx-auto mb-0 p-3" action="" method="get">
        <input type="user" class="form-control" name="usuario" placeholder="Usuario">
        <br>
        <input type="email" class="form-control" name="mail" placeholder="Email">
        <br>
        <input type="password" class="form-control" name="contra" placeholder="Contrasena">
        <br>
        <button type="submit" class="btn btn-primary w-100">Enviar</button>
    </form>
</body>
</html>