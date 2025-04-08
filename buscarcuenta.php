<?php
include_once("connectDB.php");

$table = mysqli_query($nombreConexion, "SELECT * FROM `cuentas`");

if (isset($_GET['usuario']) and isset($_GET['contra'])) {
	$name = $_GET['usuario'];
    $contra = md5($_GET['contra']);
    if (mysqli_num_rows($table)){
        while($cuenta = mysqli_fetch_assoc($table)){
            if ($name == $cuenta['usuario'] and $contra == $cuenta['contrasena']){
                ?><html><br></html><?php
                echo "enrico esta feliz";
                ?><html><br></html><?php
            }else{
                
            }
        }
    }
} else {
	echo 'You need to provide your name and email address.';
	exit(header("Location: index.html"));
}
?>