<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="icon" type="image/png" href="../img/logo.png"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/highcharts.js"></script>
    <script type="text/javascript" src="../js/export-data.js"></script>
    <script type="text/javascript" src="../js/exporting.js"></script>
    <link rel="stylesheet" href="../css/materialize.css">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <script type="text/javascript" src="../js/funciones.js"></script>
    <script type="text/javascript" src="../js/funcionAccionPanel.js"></script>

  </head>
  <body>
    <?php

      session_start();
      if(!isset($_SESSION["FK_Privilegio"]) || $_SESSION["FK_Privilegio"] != "Administrador"){
        header('Location: index.php');
      }
      include("../controlador/formulario.php");
      require("../controlador/header.php");

    ?>

    <a id="btnMenuAdmin" href="#" data-target="mobile-demo2" class="sidenav-trigger hide-on-large-only">
      <i id="iconoMenuAdmin" class="material-icons">keyboard_arrow_down</i><span>Panel</span></a>
    <div class="container container2">
      <ul id="mobile-demo2" class="sidenav sidenav-fixed z-depth-0 show-on-large">
	       <li><a class="subheader">Panel de administración</a></li>
	       <li id="search"><a href="vistaBuscar.php"><i class="material-icons left">search</i>Buscar usuario</a></li>
	       <li id="verStats"><a href="vistaGraficos.php"><i class="material-icons left">equalizer</i>Ver estadísticas</a></li>
        <li><a href="vistaCorreos.php"><i class="material-icons left">email</i>Enviar correos</a></li>
      </ul>
      <div id="contenedorPanel">
        <!--Div buscar usuario-->
        <div id="buscarUser">
          <div  class="row input-field blue-grey lighten-4" style="padding: 30px; padding-top: 50px; padding-left:25%;">
            <span class="col s12" style="color: #0d47a1; font-weight: bold;">Buscar un usuario</span><p>
            <input type="text" id="txtRutBuscar" name="txtRut" value="" class="col s12 l5">
            <button type="button" id="btnBuscarUser">Buscar</button>
          </div>
        </div>
        <div>
          <h3 class="center" style="font-family: 'Maven Pro', sans-serif;">Resultados buscador</h3>
          <div class="" style="padding: 50px; font-size: 18px;">
            <div class="row" id="tablaBuscarUser">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Modal ver ficha-->
    <div id="modalMostrarFicha" class="modal"></div>
    <!--Modal ingresar bloqueo-->
    <div id="modalBloqueo" class="modal">
      <div class="modal-content">
        <form id="formBloqueo" method="post">
          <h4 style="font-family: 'Maven Pro', sans-serif;" class="center">Bloqueo de usuario</h4>
          <label class="grey-text">Rut a bloquear</label>
          <input type="text" id="txtIdBloqueo" name="txtIdBloqueo" value="" readonly><p>
          <label class="grey-text">Tipo de bloqueo</label>
          <select class="browser-default" id="selectBloqueo" name="selectBloqueo">
            <option value="Bloqueo diario">Bloqueo diario</option>
            <option value="Bloqueo semanal">Bloqueo semanal</option>
            <option value="Bloqueo mensual">Bloqueo mensual</option>
            <option value="Bloqueo permanente">Bloqueo permanente</option>
          </select><br>
          <label class="grey-text">Observación de bloqueo</label>
          <textarea id="comentarioBloqueo" name="comentarioBloqueo" rows="8" cols="80"></textarea><p>
          <input type="submit" class="btn red right" id="btnIngresarBloqueo" name="btnIngresarBloqueo" value="Bloquear">
        </form>
      </div>
      <div id="respuestaBloqueo"></div>
    </div>
    <?php
      require("../controlador/footer.php");
    ?>
  </body>
</html>
