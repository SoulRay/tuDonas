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
    <script type="text/javascript" src="../js/funcionObtenerPerfil.js"></script>
    <script type="text/javascript" src="../js/funcionObtenerBloqueo.js"></script>

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
	       <li id="verStats"><a href="vistaGraficos.php"><i class="material-icons left">equalizer</i>Ver estadísticas</a></li>
         <li><a href="vistaCorreos.php"><i class="material-icons left">email</i>Enviar correos</a></li>
      </ul>
      <div id="contenedorPanel" class="row">
        <div id="contenedorMostraBloqueo">
          <div class="" id="contenedorBloqueo">
            <div class="" id="iconoBloqueo">
              <i class="material-icons">format_color_reset</i>
            </div>
            <span id="textoBloqueo"></span>
          </div>
        </div>
        <div class="row">
          <div class="col s12" style="padding: 5px;" hidden>
            <i class="material-icons iconPerfil">vpn_key</i> <b>RUT</b>
            &nbsp;&nbsp;<span id="rutusuarioB"><?php echo $_GET["id"]; ?></span>
          </div>
          <div id="datosUsuario" class="col s12">
          </div>
        </div>
        <div id="divBotonVerPerfilFicha">
          <button class="tooltipped" data-position="bottom" data-tooltip="Ver ficha de donación" id="btnVerFichaPerfil">Ver ficha</button>
          <button class="tooltipped" data-position="bottom" data-tooltip="Bloquear donación de usuario" id="btnBloqUser">Bloquear</button>
        </div>
      </div>
    </div>
    <!--Modal mostrar ficha-->
    <div id="modalMostrarFicha" class="modal"></div>
    <!--Modal bloqueo usuario-->
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
  </body>
  <?php
    require("../controlador/footer.php");
  ?>
</html>
