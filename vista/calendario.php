<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Calendario de Colectas</title>
    <link rel="icon" type="image/png" href="../img/logo.png "/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/moment.min.js"></script>
    <link rel="stylesheet" href="../css/materialize.css">
    <link rel="stylesheet" href="../css/fullcalendar.css">
    <link rel="stylesheet" href="../css/fullcalendar.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/funciones.js"></script>
    <script type="text/javascript" src="../js/fullcalendar.min.js"></script>
    <script type="text/javascript" src="../js/es.js"></script>
    <script type="text/javascript" src="../js/funcionCalendario.js"></script>
    <script type="text/javascript" src="../js/funcionLogin.js"></script>

  </head>
  <?php

    session_start();
    include_once("../controlador/formulario.php");
    require("../controlador/header.php");

  ?>
  <!--Modal ver evento-->
  <div id="modal9" class="modal row">
    <div class="modal-content">
      <h5 class="center" id="tituloModal">Modal Header</h5>
      <div class="input-field col s12" hidden>
        <i class="material-icons prefix">vpn_key</i>
        <input type="text" id="txtIdEvento" value="" required readonly>
        <label for="txtIdEvento">ID Evento</label>
      </div>
      <div class="input-field col s12">
        <i class="material-icons prefix">edit</i>
        <input type="text" id="txtTitulo" value="" required>
        <label for="txtTitulo">Título evento</label>
      </div>
      <div class="input-field col s12 l6">
        <i class="material-icons prefix">event_available</i>
        <input type="text" id="txtFecha" value="" required readonly>
        <label for="txtFecha">Fecha inicio (Año, Mes, Día)</label>
      </div>
      <div class="input-field col s12 l6">
        <i class="material-icons prefix">alarm_add</i>
        <input type="time" id="txtHora" value="" class="timepicker" required>
        <label for="txtHora">Hora inicio (Mínimo 09:00)</label>
      </div>
      <?php
        if(!isset($_SESSION["usuario"]) || $_SESSION["FK_Privilegio"] == "Usuario")
        {
          echo '
          <div class="input-field col s12 l6">
            <i class="material-icons prefix">event_busy</i>
            <input type="text" id="txtFechaTermino" value="" required readonly">
            <label for="txtFechaTermino">Fecha término (Año, Mes, Día)</label>
          </div>
          ';
        }
        else{
          echo '
          <div class="input-field col s12 l6">
            <i class="material-icons prefix">event_busy</i>
            <input type="text" id="txtFechaTermino" class="datepicker">
            <label for="txtFechaTermino">Fecha término (Año, Mes, Día)</label>
          </div>
          ';
        }
      ?>
      <div class="input-field col s12 l6">
        <i class="material-icons prefix">alarm_off</i>
        <input type="time" id="txtHoraTermino" value="" class="timepicker" required>
        <label for="txtHoraTermino">Hora termino (Máximo 19:00)</label>
      </div>
      <div class="input-field col s12">
        <i class="material-icons prefix">place</i>
        <input type="text" id="txtLugar" value="" required>
        <label for="txtLugar">Lugar evento</label>
      </div>
      <div class="input-field col s12">
        <i class="material-icons prefix">more</i>
        <textarea id="txtDescripcion" rows="8" cols="80" required></textarea>
        <label for="txtDescripcion">Descripción</label>
      </div>
      <div class="input-field col s12">
        <i class="material-icons prefix">format_color_fill</i>
        <input type="color" id="txtColor" value="">
        <label for="txtColor">Color</label>
      </div>
    </div>
    <div class="modal-footer">
      <button name="boton" id="btnModificarEvento" value="modificar" class="btn red boton">Modificar</button>&nbsp;
      <button name="boton" id="btnEliminarEvento" value="borrar" class="btn red boton">Borrar</button>&nbsp;
    </div>
  </div>
  <!--Modal crear evento-->
  <div id="modal8" class="modal row">
    <div class="modal-content">
      <div class="input-field col s12">
        <i class="material-icons prefix">edit</i>
        <input type="text" id="txtTitulo2" value="">
        <label for="txtTitulo2">Título evento</label>
      </div>
      <div class="input-field col s12 l6">
        <i class="material-icons prefix">event_available</i>
        <input type="text" id="txtFecha2" value="" readonly>
        <label for="txtFecha2">Fecha inicio (Año, Mes, Día)</label>
      </div>
      <div class="input-field col s12 l6">
        <i class="material-icons prefix">alarm_add</i>
        <input type="time" id="txtHora2" value="12:00:00" class="timepicker">
        <label for="txtHora2">Hora inicio (Mínimo 09:00)</label>
      </div>
      <div class="input-field col s12 l6">
        <i class="material-icons prefix">event_busy</i>
        <input type="text" id="txtFechaTermino2" class="datepicker">
        <label for="txtFechaTermino2">Fecha término (Año, Mes, Día)</label>
      </div>
      <div class="input-field col s12 l6">
        <i class="material-icons prefix">alarm_off</i>
        <input type="time" id="txtHoraTermino2" value="19:00:00" class="timepicker">
        <label for="txtHoraTermino2">Hora termino (Máximo 19:00)</label>
      </div>
      <div class="input-field col s12">
        <i class="material-icons prefix">place</i>
        <input type="text" id="txtLugar2" value="">
        <label for="txtLugar2">Lugar evento</label>
      </div>
      <div class="input-field col s12">
        <i class="material-icons prefix">more</i>
        <textarea id="txtDescripcion2" rows="8" cols="80"></textarea>
        <label for="txtDescripcion2">Descripción</label>
      </div>
      <div class="input-field col s12">
        <i class="material-icons prefix">format_color_fill</i>
        <input type="color" id="txtColor2" value="">&nbsp;
        <label for="txtColor2">Color</label>
      </div>
    </div>
    <div class="modal-footer">
      <button id="btnAgregarEvento" name="boton" value="agregar" class="btn red boton">Agregar</button>&nbsp;
      <button name="boton" value="cancelar" class="btn red boton">Cancelar</button>
    </div>
  </div>

  <body>

    <div class="container">
      <div id="respuestaEvento"></div>
      <div id="calendario">
      </div>
      <input type="text" id="valorSesion" readonly hidden value="<?php echo $_SESSION["FK_Privilegio"]; ?>">
      <input type="text" id="rutHidd" readonly hidden value="<?php echo $_SESSION["usuario"]; ?>"><br>
    </div>
    <?php include_once("../controlador/footer.php");  ?>
  </body>
</html>
