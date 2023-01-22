<?php

$host = "localhost";
$user = "root";
$pass = "root";
$basedatos = "tfgunir";
$conexion = mysqli_connect($host, $user, $pass, $basedatos)
or die("Error en la conexión a la base de datos");
// UTF-8
mysqli_query ($conexion, "SET NAMES 'utf8'");
  
?>