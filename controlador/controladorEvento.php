<?php
  include("../modelo/modeloEvento.php");
  $e = new Evento();
  if(isset($_POST["lugarEvento"])){
    $title = $_POST["title"];
    $description = $_POST["description"];
    $color = $_POST["color"];
    $textcolor = $_POST["textColor"];
    $start = $_POST["start"];
    $end = $_POST["end"];
    $lugarEvento = $_POST["lugarEvento"];
    $rut = $_POST["rutHidd"];
    if($title=="" || $description=="" || $color=="" || $textcolor=="" || $start=="" || $end=="" || $lugarEvento==""){
      ?>
        <script>
          alert("No deje campos vacíos");
        </script>

      <?php
    }
    else{
      $e->ingresarEvento($title,$description,$color,$textcolor,$start,$end,$lugarEvento,$rut);
    }
  }
  else if(isset($_POST["id"])){
    $id = $_POST["id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $color = $_POST["color"];
    $textcolor = $_POST["textColor"];
    $start = $_POST["start"];
    $end = $_POST["end"];
    $lugarEvento = $_POST["lugar"];
    if($id =="" || $title=="" || $description=="" || $color=="" || $textcolor=="" || $start=="" || $end=="" || $lugarEvento ==""){
      ?>
        <script>
          alert("No deje campos vacíos");
        </script>

      <?php
    }
    else{
      $e->modificarEvento($title,$description,$color,$textcolor,$start,$end,$lugarEvento,$id);
    }
  }
  else if(isset($_POST["idEvento"])){
    $id = $_POST["idEvento"];
    $e->eliminarEvento($id);
  }
?>
