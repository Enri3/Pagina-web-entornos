<!--
Conexión a la BD, la crea si no existe
-->

<?php
$base = 'shopping_db';
$host = 'localhost';
$user = 'root';
$pass = '';
//Inicia la conéx pero a ninguna bd específica (No sabemos si existe)
$conexion = mysqli_connect($host, $user, $pass)
  or die("Error de conexión: " . mysqli_error($conexion));

//Crea si no existe
$sql = "CREATE DATABASE IF NOT EXISTS $base";
$resultado = mysqli_query($conexion, $sql)
  or die("Error al crear la base: " . mysqli_error($conexion));

//Selecciona la base de datos
mysqli_select_db($conexion, $base)
  or die("No se pudo seleccionar la base: " . mysqli_error($conexion));

//Crea las tablas si no existen, las querys las saqué del mysqladmin en el xampp (También está el dump de la versión vieja en el repo, para ver alguna diferencia)

$sqlTabla = "CREATE TABLE IF NOT EXISTS `usuarios` (
            `codUsuario` INT(11) NOT NULL AUTO_INCREMENT ,
            `nombreUsuario` VARCHAR(100) NOT NULL ,
            `email` VARCHAR(100) NOT NULL ,
            `claveUsuario` VARCHAR(255) NOT NULL ,
            `tipoUsuario` ENUM('cliente','dueno','admin') NOT NULL ,
            `categoriaCliente` ENUM('inicial','medium','premium') NOT NULL ,
            PRIMARY KEY (`codUsuario`),
            UNIQUE KEY `email` (`email`)
            ) ENGINE = InnoDB;";

$resultado = mysqli_query($conexion, $sqlTabla)
  or die("Error al crear la tabla: " . mysqli_error($conexion));

$sqlTabla = "CREATE TABLE IF NOT EXISTS `locales` (
  `codLocal` int(11) NOT NULL AUTO_INCREMENT,
  `nombreLocal` varchar(100) NOT NULL,
  `ubicacionLocal` varchar(100) NOT NULL,
  `rubroLocal` varchar(100) NOT NULL,
  `codUsuario` int(100) NOT NULL,
  PRIMARY KEY (`codLocal`)
) ENGINE=InnoDB;";

$resultado = mysqli_query($conexion, $sqlTabla)
  or die("Error al crear la tabla: " . mysqli_error($conexion));

$sqlTabla = "CREATE TABLE IF NOT EXISTS `novedades` (
  `codNovedad` int(11) NOT NULL AUTO_INCREMENT,
  `textoNovedad` varchar(100) NOT NULL,
  `fechaDesdeNovedad` date NOT NULL,
  `fechaHastaNovedad` date NOT NULL,
  `tipoUsuario` enum('cliente','dueño de local','administrador') NOT NULL,
  PRIMARY KEY (`codNovedad`)
) ENGINE=InnoDB;";

$resultado = mysqli_query($conexion, $sqlTabla)
  or die("Error al crear la tabla: " . mysqli_error($conexion));

$sqlTabla = "CREATE TABLE IF NOT EXISTS `promociones` (
  `codPromo` int(11) NOT NULL AUTO_INCREMENT,
  `textoPromo` varchar(100) NOT NULL,
  `fechaDesdePromo` date NOT NULL,
  `fechaHastaPromo` date NOT NULL,
  `categoriaCliente` enum('Inicial','Medium','Premium') NOT NULL,
  `diasSemana` set('1','2','3','4','5','6','7') NOT NULL,
  `estadoPromo` enum('cliente','dueño de local','administrador') NOT NULL,
  `codLocal` int(11) NOT NULL,
  PRIMARY KEY (`codPromo`)
) ENGINE=InnoDB;";

$resultado = mysqli_query($conexion, $sqlTabla)
  or die("Error al crear la tabla: " . mysqli_error($conexion));


$sqlTabla = "CREATE TABLE IF NOT EXISTS `uso_promociones` (
  `codCliente` int(11) NOT NULL,
  `codPromo` int(11) NOT NULL,
  `fechaUsoPromo` date NOT NULL,
  `estado` enum('enviada','aceptada','rechazada') NOT NULL
) ENGINE=InnoDB;";

$resultado = mysqli_query($conexion, $sqlTabla)
  or die("Error al crear la tabla: " . mysqli_error($conexion));
?>