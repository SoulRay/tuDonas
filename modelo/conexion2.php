<?php

$db_host = "localhost";
$db_nombre = "donacionsangretest";
$db_usuario = "root";
$db_password = "";
$conexion = mysqli_connect($db_host,$db_usuario, $db_password);
if(mysqli_connect_errno())
{
  echo "Error en la conexión";
  exit();
}
mysqli_select_db($conexion,$db_nombre) or die("No se encuentra el nombre de la BBDD");
mysqli_set_charset($conexion, "utf8");
?>
