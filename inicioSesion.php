<?php
    include_once("connectDB.php");

    $table = mysqli_query($nombreConexion, "SELECT * FROM `cuentas`");

    $cont = 0;
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
                    $cont = 1;
                }
            }
        }
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
    <h1>Inicio de sesion</h1>
    <form class="bg-danger w-25 mx-auto mb-0 p-3" action="" method="get">
        <input type="user" class="form-control" name="usuario" placeholder="Usuario">
        <br>
        <input type="password" class="form-control" name="contra" placeholder="Contrasena">
        <br>
        <?php if ($cont == 1){echo "Ingrese contra nuevamente";} ?>
        <br>
        <button type="submit" class="btn btn-primary w-100">Enviar</button>
    </form>
</body>
</html>