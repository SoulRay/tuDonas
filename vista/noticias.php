<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../img/logo.png "/>
    <title>Noticias</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/funciones.js"></script>
    <script type="text/javascript" src="../js/funcionNoticias.js"></script>
    <script type="text/javascript" src="../js/funcionLogin.js"></script>
    <script type="text/javascript" src="../js/validarLogin.js"></script>
  </head>
  <body>
    <?php
      session_start();
      include_once("../controlador/formulario.php");
      include("../controlador/header.php");
    ?>
    <div class="container" style="background-color: ##eeeeee; height: 100% !important;">
      <div class="row">
        <div id="divNoticias" class="col s12 m6" style="padding-top: 20px;">

        </div>
        <div class="col s2 hide-on-small-only">

        </div>
        <div id="menuNoticias" class="col m4 blue-text hide-on-small-only">
          <h5 style="padding:5px;">Buscar noticia</h5><br>
          <input type="text" id="txtBuscarNoticia" value=""><br><br>
          <a href="noticias.php" class="btn-floating btn-large blue tooltipped" data-position="bottom" data-tooltip="Ver noticias"><i class="material-icons">home</i></a>
          <?php if(!isset($_SESSION["usuario"]))
          {

          }
          else if($_SESSION["FK_Privilegio"] == "Administrador"){
            ?>
              <a class="btn-floating btn-large red tooltipped" data-position="bottom" data-tooltip="Agregar noticia" onclick="mostrarModalAgregar()" id="btnAgregarNoticia"><i class="material-icons">add</i></a>
              <a class="btn-floating btn-large yellow darken-3 tooltipped" value="" data-position="bottom" data-tooltip="Modificar noticia" onclick="mostrarModalModificar()" id="btnActualizarNoticia"><i class="material-icons">refresh</i></a>
              <a class="btn-floating btn-large green tooltipped" value="" data-position="bottom" data-tooltip="Eliminar noticia" onclick="eliminarNoticia()" id="btnEliminarNoticia"><i class="material-icons">delete</i></a>
              <div id="divMensajeNoticia">

              </div>
            <?php
          }?>
        </div>
      </div>
    </div>

    <!--Modal agregar noticia-->
    <div id="modalAgregarNoticia" class="modal">
      <h4 style="padding-top: 20px;" class="center">Agregar noticia</h4>
      <div class="modal-content">
        <form id="formAgregarNoticia" action="index.html" method="post">
          <div class='input-field col s12'>
            <i class="material-icons prefix">edit</i>
            <input type='text' name='txtTituloNoticia' required>
            <label for='txtTituloNoticia'>Titulo noticia</label>
          </div>
          <div class='input-field col s12'>
            <i class="material-icons prefix">more</i>
            <textarea class="materialize-textarea" name='txtDescripcionNoticia' required></textarea>
            <label for='txtDescripcionNoticia'>Descripción noticia</label>
          </div>
          <div class='input-field col s12'>
            <i class="material-icons prefix">vpn_key</i>
            <input type="text" name='txtRutNoticia' value="<?php echo $_SESSION["usuario"]; ?>" required readonly>
            <label for='txtRutNoticia'>Rut creador</label>
          </div>
          <div class="file-field input-field">
            <div class="btn">
              <span>Imagen noticia</span>
              <input type='file' name='imagenNoticia' required>
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
          </div>
          <input type="submit" name="btnEnviarNoticia" value="Enviar">
          <div id="respuestaAgregar"></div>
        </form>
      </div>
    </div>

    <!--Modal modificar noticia-->
    <div id="modalModificarNoticia" class="modal">
      <h4 style="padding-top: 20px;" class="center">Modificar noticia</h4>
      <div class="modal-content">
        <form id="formModificarNoticia" action="index.html" method="post">
          
        </form>
      </div>
    </div>

  </body>
  <?php include("../controlador/footer.php");  ?>
</html>
