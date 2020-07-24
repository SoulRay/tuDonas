<?php

require("../modelo/conexion2.php");
$privilegio = $_POST["sesion"];
if($privilegio == "Administrador"){
  $query = "SELECT COUNT(*) FROM campana WHERE FK_Estado=0;";
  $resultados = mysqli_query($conexion, $query);
  if($resultados >= "0"){
    $fila = mysqli_fetch_array($resultados, MYSQLI_NUM);
    echo $fila[0];
  }
}


?>
