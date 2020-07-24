<?php
  class Noticia{

    function cargarNoticias(){
      require("conexion2.php");
      $query = "SELECT * FROM noticias ORDER BY fechaNoticia DESC";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_num_rows($resultados) > 0){
        while($fila = mysqli_fetch_array($resultados)){
          echo "<div id='noticia1'>".$fila["tituloNoticia"]."</div>".
          "<i style='position:relative; top: 3px; color:grey;' class='material-icons'>date_range</i><span class='grey-text'>". date("d-m-Y", strtotime($fila["fechaNoticia"])) ."</span>&nbsp &nbsp;<i style='position:relative; top: 3px; color:grey;' class='material-icons'>person</i><span class='grey-text'>". $fila["idCreador"]."</span>";
          echo "<img id='imgNoticia' src='".$fila["imgNoticia"]."' width='100%' height='300px'><br>";
        }
      }
      else{
        echo "<h4 class='center'>No hay noticias disponibles</h4>";
      }
    }

    function agregarNoticia($titulo,$descripcion,$ruta,$fecha,$rut){
      require("conexion2.php");
      $query = "INSERT INTO noticias(tituloNoticia, descripcionNoticia, imgNoticia, fechaNoticia, idCreador)
      VALUES('$titulo','$descripcion','$ruta','$fecha','$rut')";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_affected_rows($conexion) > 0){
        ?> <script>
          M.toast({
            html: 'Noticia creada',
            displayLength: 3000,
            inDuration: 500,
            outDuration: 500,
            classes: 'rounded'
          });
        </script> <?php
      }
      else{
        echo "Error al añadir una noticia";
      }
    }

    function verNoticia($urlnoticia){
      require("conexion2.php");
      $query = "SELECT * FROM noticias WHERE imgNoticia = '$urlnoticia'";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_num_rows($resultados) > 0){
        $fila = mysqli_fetch_array($resultados);
        echo "<div id='noticia1'>".$fila["tituloNoticia"]."</div>".
        "<i style='position:relative; top: 3px; color:grey;' class='material-icons'>date_range</i><span class='grey-text'>". date("d-m-Y", strtotime($fila["fechaNoticia"])) ."</span>&nbsp &nbsp;<i style='position:relative; top: 3px; color:grey;' class='material-icons'>person</i><span class='grey-text'>". $fila["idCreador"]."</span>";
        echo "<img id='imgNoticia' src='".$fila["imgNoticia"]."' width='100%' height='300px'><br>";
        echo $fila["descripcionNoticia"];
        echo "
          <script>
            $('#btnEliminarNoticia').attr('value','".$fila["idNoticia"]."');
            $('#btnActualizarNoticia').attr('value','".$fila["idNoticia"]."');
          </script>";
      }
    }
    function buscarNoticia($texto){
      require("conexion2.php");
      $query = "SELECT * FROM noticias WHERE tituloNoticia like '%$texto%'";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_num_rows($resultados) > 0){
        while($fila = mysqli_fetch_array($resultados)){
          echo "<div id='noticia1'>".$fila["tituloNoticia"]."</div>".
          "<i style='position:relative; top: 3px; color:grey;' class='material-icons'>date_range</i><span class='grey-text'>". date("d-m-Y", strtotime($fila["fechaNoticia"])) ."</span>&nbsp &nbsp;<i style='position:relative; top: 3px; color:grey;' class='material-icons'>person</i><span class='grey-text'>". $fila["idCreador"]."</span>";
          echo "<img id='imgNoticia' src='".$fila["imgNoticia"]."' width='100%' height='300px'><br>";
        }
      }
      else{
        echo "
          <h5 id='msgBuscarNoticia'>No hay noticias según el criterio de búsqueda</h5>
          <img src='../img/noencontrado.png' width='100%' height='400px'>
        ";
      }
    }
    function eliminarNoticia($idNoticia,$imagen){
      require("conexion2.php");
      $query = "DELETE FROM noticias WHERE idNoticia = '$idNoticia'";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_affected_rows($conexion) > 0){
        ?> <script>
          M.toast({
            html: 'Noticia eliminada',
            displayLength: 3000,
            inDuration: 500,
            outDuration: 500,
            classes: 'rounded'
          });
        </script> <?php
        unlink("$imagen");
      }
      else{
        echo "Error al eliminar la noticia";
      }
    }
    function mostrarDatosNoticia($ruta){
      require("conexion2.php");
      $query = "SELECT * FROM noticias WHERE imgNoticia = '$ruta'";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_num_rows($resultados) > 0){
        $fila = mysqli_fetch_array($resultados);
        echo "
        <label class='blue-text text-darken-4'>Titulo noticia</label>
        <div class='input-field col s12'>
          <i class='material-icons prefix'>edit</i>
          <input type='text' name='txtEditarTitulo' value='".$fila['tituloNoticia']."' required>
        </div>
        <label class='blue-text text-darken-4'>Descripción noticia</label>
        <div class='input-field col s12'>
          <i class='material-icons prefix'>more</i>
          <textarea class='materialize-textarea' name='txtEditarDescripcion' required>".$fila['descripcionNoticia']."</textarea>
        </div>
        <!--FILE INPUT-->
        <div id='divFileInput' class='file-field input-field' style='display:none;'>
          <div class='btn'>
            <span>Imagen noticia</span>
            <input type='file' id='imagenNoticia' name='imagenNoticia'>
          </div>
          <div class='file-path-wrapper'>
            <input id='imagenNoticia2' class='file-path validate' type='text'>
          </div>
        </div>
        <!--CHECKBOX MOSTRAR FILE-->
        <div class='switch'>
          <label>
            Usar actual
            <input type='checkbox' id='checkImagen' onclick='checkearImagen()'>
            <span class='lever'></span>
            Agregar imagen
          </label>
        </div><p>
        <input type='submit' name='btnModificarNoticia' value='Enviar'>
        <div id='respuestaModificar'></div>
        ";
      }
      else{
        echo "Error";
      }
    }
    function actualizarNoticia($titulo,$descripcion,$ruta,$ruta2){
      require("conexion2.php");
      $query = "UPDATE noticias SET tituloNoticia = '$titulo', descripcionNoticia = '$descripcion', imgNoticia='$ruta2' WHERE imgNoticia = '$ruta'";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_affected_rows($conexion) > 0){
        ?> <script>
          M.toast({
            html: 'Noticia modificada',
            displayLength: 3000,
            inDuration: 500,
            outDuration: 500,
            classes: 'rounded'
          });
        </script> <?php
      }
    }
  }


?>
