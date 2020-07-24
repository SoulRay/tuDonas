<?php

class Evento
{
  private $title;
  private $description;
  private $color;
  private $textColor;
  private $start;
  private $end;
  private $lugarEvento;
  private $FK_Usuario_Evento;

  public function getTitle()
  {
      return $this->title;
  }

  public function setTitle($rutUsuario)
  {
    $this->title = $title;
  }
  public function getDescription()
  {
      return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getColor()
  {
      return $this->color;
  }

  public function setColor($color)
  {
    $this->color = $color;
  }
  public function getTextColor()
  {
      return $this->textColor;
  }

  public function setTextColor($textColor)
  {
    $this->textColor = $textColor;
  }
  public function getStart()
  {
      return $this->start;
  }

  public function setStart($start)
  {
    $this->start = $start;
  }
  public function getEnd()
  {
      return $this->end;
  }

  public function setEnd($end)
  {
    $this->end = $end;
  }
  public function getLugarEvento()
  {
      return $this->lugarEvento;
  }

  public function setLugarEvento($lugarEvento)
  {
    $this->lugarEvento = $lugarEvento;
  }
  public function getFK_Usuario_Evento()
  {
      return $this->FK_Usuario_Evento;
  }

  public function setFK_Usuario_Evento($FK_Usuario_Evento)
  {
    $this->FK_Usuario_Evento = $FK_Usuario_Evento;
  }

  function ingresarEvento($title,$description,$color,$textColor,$start,$end,$lugarEvento,$rut){
    require("../modelo/conexion2.php");
    $resultados = mysqli_query($conexion, "INSERT INTO eventos (title,description,color,textColor,start,end, lugarEvento, FK_Usuario_Evento)
    VALUES('$title','$description','$color','$textColor','$start','$end', '$lugarEvento', '$rut')");
    if(mysqli_affected_rows($conexion) > 0)
    {
        ?> <script>
          M.toast({
            html: 'Evento creado',
            displayLength: 4000,
            inDuration: 1000,
            outDuration: 1000,
            classes: 'rounded'
          });
          //setTimeout(function(){window.location.href = 'calendario.php';}, 2000);

          </script>
        <?php
    }
    else
    {
        echo "No se pudieron guardar los datos";
    }
  }
  function modificarEvento($title,$description,$color,$textColor,$start,$end,$lugarEvento,$id){
    require("../modelo/conexion2.php");
    $resultados = mysqli_query($conexion, "UPDATE eventos SET title='$title',description='$description',
      color='$color',textcolor='$textColor',start='$start',end='$end', lugarEvento='$lugarEvento' WHERE id = '$id'");
    if($resultados = false){
      echo "Error en la consulta";
    }
    else{
      if (mysqli_affected_rows($conexion) != 0)
      {
      ?>
        <script>
          M.toast({
            html: 'Evento modificado',
            displayLength: 4000,
            inDuration: 1000,
            outDuration: 1000,
            classes: 'rounded'
          });
          //setTimeout(function(){window.location.href = 'calendario.php';}, 2000);
        </script>

      <?php
      }
      else {
        echo "Error al modificar";
      }
    }
  }
  function eliminarEvento($id){
    require("../modelo/conexion2.php");
    $resultados = mysqli_query($conexion, "DELETE FROM eventos WHERE id='$id'");
    if($resultados = false){
      echo "SIN RESULTADOS";
    }else{
      if(mysqli_affected_rows($conexion) != 0)
      {
      ?> <script>
          M.toast({
            html: 'Evento eliminado',
            displayLength: 4000,
            inDuration: 1000,
            outDuration: 1000,
            classes: 'rounded'
          });
          //setTimeout(function(){window.location.href = 'calendario.php';}, 2000);
        </script>
        <?php
      }
      else{
        echo "Error al eliminar";
      }
    }
  }
}

?>
