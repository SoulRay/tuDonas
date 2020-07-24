
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
    <!--Modal ficha donante-->
    <div class="container container2">
      <ul id="mobile-demo2" class="sidenav sidenav-fixed z-depth-0 show-on-large">
	       <li><a class="subheader">Panel de administración</a></li>
	       <li id="search"><a href="vistaBuscar.php"><i class="material-icons left">search</i>Buscar usuario</a></li>
	       <li id="verStats"><a><i class="material-icons left">equalizer</i>Ver estadísticas</a></li>
	       <li id="confg"><a><i class="material-icons left">settings</i>Opciones</a></li>
      </ul>
      <div id="contenedorPanel" class="row">
          <h4 style="font-family: 'Maven Pro', sans-serif;" class="center">Ficha donante</h4>
          <form id="formFicha2" method="post" enctype="multipart/form-data">
            <label style="font-size: 20px; color: grey;">Rut a ingresar ficha: </span><br>
            <i class="material-icons left">vpn_key</i><input class="col s4" type="text" name="rutFicha" id="rutFicha" value="<?php echo $_GET["id"] ?>" readonly>
            <div class="file-field input-field col s12">
              <div class="btn">
                <span>Ficha</span>
                <input type="file" name="archivo" id="archivo" accept="application/pdf">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
            <input class="right" type="submit" id="btnEnviarFicha" name="btnEnviarFicha" value="Enviar" required>
          </form>
          <div id="respuestaFicha"></div>
      </div>
    </div>
  </body>
  <?php
    require("../controlador/footer.php");
  ?>
</html>
