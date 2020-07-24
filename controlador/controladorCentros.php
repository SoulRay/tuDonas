<?php
require("../modelo/conexion2.php");
include("../modelo/modeloCentro.php");
$centro = new Centros();
if(isset($_POST["listarEliminar"])){
  $centro->listarEliminarCentro();
}
elseif(isset($_POST["txtNombre"]))
{
  $centro->setNombre($_POST["txtNombre"]);
  $nombre = $centro->getNombre();
  $centro->setDireccion($_POST["txtDireccion"]);
  $direccion = $centro->getDireccion();
  $centro->setLatitud($_POST["txtLatitud"]);
  $latitud = $centro->getLatitud();
  $centro->setLongitud($_POST["txtLongitud"]);
  $longitud = $centro->getLongitud();
  $centro->setTipo($_POST["opcionTipo"]);
  $tipo = $centro->getTipo();
  $centro->setTelefono($_POST["txtTelefono"]);
  $telefono = $centro->getTelefono();
  $centro->setPagina($_POST["txtPagina"]);
  $pagina = $centro->getPagina();
  if($nombre=="" || $direccion=="" || $latitud=="" || $longitud=="" || $tipo=="" || $telefono=="" || $pagina==""){
    ?> <script>alert("No deje campos vacíos");</script> <?php
  }
  else{
    $centro->ingresarCentro($nombre,$direccion,$latitud,$longitud,$tipo,$telefono,$pagina);
  }
}
elseif(isset($_POST["opcionCentro"])){
  $nombre = $_POST["opcionCentro"];
  $centro->eliminarCentro($nombre);
}
elseif(isset($_POST["cargarCentros"])){
  $centro->verCentrosTabla();
}


?>
