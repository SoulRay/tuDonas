
<?php
  header("Content-Type: application/json");
  require_once("../modelo/conexion2.php");
  $query = "SELECT * FROM eventos";
  $resultados = mysqli_query($conexion, $query);
  if(mysqli_num_rows($resultados) > 0)
  {
    while($fila = mysqli_fetch_array($resultados, MYSQLI_BOTH))
    {
      $id = $fila["id"];
      $title = $fila["title"];
      $description = $fila["description"];
      $color = $fila["color"];
      $textColor = $fila["textColor"];
      $start = $fila["start"];
      $end = $fila["end"];
      $lugarEvento = $fila["lugarEvento"];
      $FK_Usuario_Evento= $fila["FK_Usuario_Evento"];
      $arrayLista[] = array('id'=>$id, 'title'=>$title, 'description'=>$description, 'color'=>$color,
        'textColor'=>$textColor,'start'=>$start, 'end'=>$end, 'lugarEvento'=>$lugarEvento, 'FK_Usuario_Evento'=>$FK_Usuario_Evento);

      }
      /*$array = json_decode(json_encode($arrayLista),true);
      $array = array_values( array_unique( $array, SORT_REGULAR ) );
      $result = json_encode( $array );
      */
      echo json_encode($arrayLista);
    }

?>
