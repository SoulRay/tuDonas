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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css">
    <script type="text/javascript" src="../js/funciones.js"></script>
    <script type="text/javascript" src="../js/funcionEnviarCorreos.js"></script>
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
          <h4 id="tituloCorreos" class="center">Usuario activados para donar</h4>
          <button id="divEnviarCorreos">Enviar correos</button>
          <!--<table>
            <thead>
              <th>Rut</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Genero</th>
              <th>Fecha donación</th>
            </thead>
            <tbody id="tablaCorreos">
            </tbody>
          </table>-->
          <div class="row" id="tablaCorreos">

          </div>
          <div id="respuestaEnviarCorreo">

          </div>
        </div>
    </div>
    <?php
      require("../controlador/footer.php");
    ?>
  </body>
</html>
