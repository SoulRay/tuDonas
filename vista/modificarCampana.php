<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Modificar Campaña</title>
    <link rel="icon" type="image/png" href="../img/logo.png "/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/funciones.js"></script>
    <script type="text/javascript" src="../js/funcionCampana.js"></script>

  </head>
  <body>

    <?php
      session_start();
      //Formulario de registro
      include_once("../controlador/formulario.php");
      //Header
      require_once('../controlador/header.php');
    ?>

     <div class="container">
         <div class="row separar-top">
           <div class="col s12">
             <label class='grey-text'>RUN Paciente</label>
             <input type="text" id="txtRut2" name="txtRut2" value="<?php echo $_POST["txtModificarCampana"]; ?>" readonly>
           </div>
           <div id="divInputsModificar">
           </div>
           <input class="btn red right" onclick="Actualizar()" type="submit" name="btnActualizar" value="Actualizar">
           <div id="mostrarRespuesta">

           </div>
         </div>
     </div>

    <?php
      //footer
      require_once('../controlador/footer.php');
    ?>
  </body>
</html>
