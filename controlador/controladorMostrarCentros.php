<?php
require("../modelo/conexion2.php");
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

$query = 'SELECT * FROM centros WHERE 1 AND tipo = "Banco de sangre"';
$result = mysqli_query($conexion, $query) or die (mysqli_error());

header("Content-type: text/xml");

// Inicia el documento XML
echo "<?xml version='1.0' ?>";
echo '<centros>';
$ind=0;
// Busca e imprime los datos
while ($row = @mysqli_fetch_assoc($result)){
  // Se agrega los datos al archivo XML
  echo '<centro ';
  echo 'id="' . $row['id'] . '" ';
  echo 'nombre="' . parseToXML($row['nombre']) . '" ';
  echo 'direccion="' . parseToXML($row['direccion']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'tipo="' . $row['tipo'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// Se guarda el XML
echo '</centros>';
?>
