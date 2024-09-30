<?php
if (isset($_POST['usuario']) and isset($_POST['mail']) and isset($_POST['contra'])) {
	$name = md5($_POST['usuario']);
	$email = md5($_POST['mail']);
    $contra = md5($_POST['contra']);
	include_once("connectDB.php");
	$result = mysqli_query($nombreConexion, "INSERT INTO cuentas (usuario, contrasena, mail) VALUES ('$name', '$contra', '$email');");
	exit(header("Location: buscarcuenta.php"));
} else {
	echo 'You need to provide your name and email address.';
	exit(header("Location: index.html"));
}