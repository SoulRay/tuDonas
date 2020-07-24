<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Recomendaciones</title>
    <link rel="icon" type="image/png" href="../img/logo.png"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/funciones.js"></script>
    <script type="text/javascript" src="../js/funcionLogin.js"></script>
  </head>
  <body>

    <?php
      session_start();
      //Formulario de registro
      include_once("../controlador/formulario.php");
      //Header
      require_once('../controlador/header.php');
    ?>

     <!--Container body-->
     <div class="container">
       <span class="red-text center"><h4>¿En qué consiste el proceso de donación?</h4></span>
       <div class="row">
         <!--Card Entrevista-->
         <div class="col s12 m6">
           <div class="card medium">
             <div class="card-image">
               <img src="../img/entrevista.jpg" height="250px">
              <span class="card-title"><i class="material-icons medium red-text left">looks_one</i></span>
             </div>
             <div class="card-content">
               <p><b>Entrevista Confidencial:</b> Con preguntas tendientes a protegerlo a usted como donante y a los posibles receptores de sangre.</p>
             </div>
            </div>
         </div>
         <!--Card Chequeo salud-->
         <div class="col s12 m6">
           <div class="card medium">
            <div class="card-image">
              <img src="../img/chequeosalud3.jpg" height="380px">
              <span class="card-title"><i class="material-icons medium red-text left">looks_two</i></span>
            </div>
            <div class="card-content">
             <p><b>Chequeo Salud:</b> Verificando el peso, la presión arterial y la Hemoglobina con el objetivo de no causarle daño.</p>
            </div>
          </div>
         </div>
        <!--Card Extraccion Sangre-->
         <div class="col s12 m6">
           <div class="card medium">
             <div class="card-image">
               <img src="../img/extraccion.jpg" height="250px">
               <span class="card-title"><i class="material-icons medium red-text left">looks_3</i></span>
             </div>
             <div class="card-content">
               <p><b>Extracción de sangre:</b> Utilizando material estéril y desechable.</p>
             </div>
           </div>
         </div>
         <!--Card Analisis laboratorio-->
         <div class="col s12 m6">
           <div class="card medium">
             <div class="card-image">
               <img src="../img/testeolab.jpg" height="250px">
               <span class="card-title"><i class="material-icons medium red-text left">looks_4</i></span>
             </div>
             <div class="card-content">
               <p><b>Revisión de la muestra:</b> Se tomará una muestra de su sangre para realizar test de laboratorio para detectar
              Sifilis, Hepatitis B y C, Chagass, SIDA, HTLV-1 y Grupo Sanguíneo</p>
             </div>
           </div>
         </div>
       </div>

        <span class="red-text center"><h4>Al finalizar el proceso de donación</h4></span>
       <div class="row">
       <div class="col s12 m6">
           <div class="card medium">
             <div class="card-image">
               <img src="../img/jugo.jpg" height="250px">
              <span class="card-title"><i class="material-icons medium red-text left">looks_one</i></span>
             </div>
             <div class="card-content">
               <p><b>Alimentarse:</b> Una vez extraída la sangre, medio litro aproximadamente, el donador recibirá un refrigerio que debe consumir tan pronto termine el procedimiento,
               antes de retirarse de las instalaciones. Si en ese tiempo se siente bien, puede irse.</p>
             </div>
            </div>
         </div>
         <!-- -->
         <div class="col s12 m6">
           <div class="card medium">
             <div class="card-image">
               <img src="../img/durmiendo.jpg" height="250px">
              <span class="card-title"><i class="material-icons medium red-text left">looks_two</i></span>
             </div>
             <div class="card-content">
               <p><b>Reposo Moderado:</b> Se recomienda no hacer esfuerzos (ejercicio vigoroso, cargar cosas pesadas) en las siguientes 24 horas.
               El volumen de sangre se recupera en un lapso de 2 a 3 semanas, consumiendo líquidos y llevando una buena alimentación.</p>
             </div>
            </div>
         </div>
         <!-- -->
         <div class="col s12 m6">
           <div class="card medium">
             <div class="card-image">
               <img src="../img/postDonacion3.jpg" height="250px">
              <span class="card-title"><i class="material-icons medium red-text left">looks_3</i></span>
             </div>
             <div class="card-content">
               <p><b>Nota:</b> Si al finalizar el proceso, el donador sabe que, por cualquier razón no mencionada al personal del banco de sangre, no debería donar,
               existe un buzón donde puede autoexcluirse. Esto siempre será mejor que hacer correr un riesgo a otra persona.</p>
             </div>
            </div>
         </div>
         <!-- -->
         <div class="col s12 m6">
           <div class="card medium">
             <div class="card-image">
               <img src="../img/postDonacion4.jpg" height="250px">
              <span class="card-title"><i class="material-icons medium red-text left">looks_4</i></span>
             </div>
             <div class="card-content">
               <p><b>Tiempo para volver a donar:</b> Deben pasar más de 3 meses para los hombres y 4 meses para las mujeres antes de donar nuevamente.</p>
             </div>
            </div>
         </div>
        </div>
     </div>

  <?php
    //footer
    require_once('../controlador/footer.php');
  ?>
  </body>
</html>
