<?php
if (isset($_GET['usuario']) and isset($_GET['mail']) and isset($_GET['contra'])) {
	$name = $_GET['usuario'];
	$email = $_GET['mail'];
    $contra = md5($_GET['contra']);
	include_once("connectDB.php");
	$result = mysqli_query($nombreConexion, "INSERT INTO cuentas (usuario, contrasena, mail) VALUES ('$name', '$contra', '$email');");
	exit(header("Location: muestraCuentas.php"));
} else {
	echo 'You need to provide your name and email address.';
	exit(header("Location: index.html"));
}