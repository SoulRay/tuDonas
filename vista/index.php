<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inicio</title>
    <link rel="icon" type="image/png" href="../img/logo.png "/>
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

    <!--Slider imagenes grandes-->
        <div class="slider">
           <ul class="slides">
             <li>
               <img src="../img/donacion5.png" class="responsive-img">
               <div class="caption center-align">
                 <h3>Donar es vida</h3>
                 <h5 class="light grey-text text-lighten-3">Solo tomará un poco tiempo de tu vida que podrá ayudar a muchos</h5>
               </div>
             </li>
             <li>
               <img src="../img/donacion1.png" class="responsive-img">
               <div class="caption center-align">
                 <h3>Transformate en Donador Altruista</h3>
                 <h5 class="light grey-text text-lighten-3">Genera el Habito de Donar</h5>
               </div>
             </li>
             <li>
               <img src="../img/donacion3.png" class="responsive-img">
               <div class="caption center-align">
                 <h3 class="black-text">Adentrate en Tu Donas</h3>
               </div>
             </li>
           </ul>
          </div>
          <br>
      <!--Container body-->
        <div class="container">
          <div class="row">
            <!--Video donación (autoplay = ?rel=0&autoplay=1 en el link)-->
            <div class="video-container"><br>
              <iframe width="560" height="315" src="https://www.youtube.com/embed/gRdSST9WDxw" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
            </div>
            <br>
            <!--Información sangre-->
            <div id="queessangre" class="col s12">
              <h4 style="padding-bottom: 30px;" class="red-text center">¿Qué es la sangre?</h4>
            </div>
            <div class="col s12 l4">
              <img src="../img/donando.gif" height="350" width="350" class="responsive-img">
            </div>
            <div class="col s12 l8 valign-wrapper" style="padding:20px; font-size:18px;">
              <span class="">La sangre es un líquido que circula por los vasos saguíneos, del cuerpo de las personas y los
              animales. Se conforma de dos fases: <b>Sólida</b> (Plaquetas, glóbulos blancos y rojos) y <b>líquida</b> (Plasma). La sangre cumple múltiples
              funciones, como la defensa ante infecciones y la distribución de nutrientes. En la donación de sangre, la sangre extraída(luego de ser analizada),
              se utiliza para tratamientos y enfermedades, como por ejemplo la anemia. Además, se utiliza para procedimientos quirúrgicos, transplantes,
              hermorragias, quemaduras y recomposición del stock del hospital.
              </span>
            </div>
            <div id="composicion" class="col s12">
              <h4 id="composicion" style="padding-bottom: 30px;" class="red-text center">Composición de la sangre</h4>
            </div>
            <div class="col s12 m6 l3">
              <img src="../img/globuloblanco.jpg" height="200px" width="200px" class="circle"><br>
              <h5><b>Glóbulos blancos</b></h5><br>
              <span>Los glóbulos blancos son parte del sistema inmunológico, ayudan a combatir infecciones y otras enfermedades.
              Existen tres tipos: <b>Granulocitos, monocitos y los linfocitos</b></span>
            </div>
            <div class="col s12 m6 l3">
              <img src="../img/globulo.jpg" height="200px" width="200px" class="circle"><br>
              <h5><b>Glóbulos rojos</b></h5><br>
              <span>Los glóbulos rojos son los encargados de transportar oxígeno desde los pulmones hacias
              todas las partes del cuerpo, gracias a una proteína llamada <b>Hemoglobina</b></span>
            </div>
            <div class="col s12 m6 l3">
              <img src="../img/plasma.jpg" height="200px" width="200px" class="circle"><br>
              <h5><b>Plasma</b></h5><br>
              <span>El plasma sanguíneo es una porción líquida de la sangre, compuesto por 92% y el resto de proteínas
                y sales minerales. En el plasma están inmersos los demás elementos formes de la sangre.</span>
            </div>
            <div class="col s12 m6 l3">
              <img src="../img/plaqueta.jpg" height="200px" width="200px" class="circle"><br>
              <h5><b>Plaquetas</b></h5><br>
              <span>Las plaquetas sanguíneas permiten que la sangre se coagule, ayudando a la detención de sangrado
              en caso de una ruptura de un vaso sanguíneo, además de evitar hemorragias dentro del cuerpo.</span>
            </div>
            <!--Grupos sanguíneos-->
            <div id="grupos" class="">
              <div class="col s12"><h4 style="padding-bottom: 30px;" class="red-text center">Grupos sanguíneos</h4></div>
              <div id="sistemaabo" class="col s12 m6">
                <h5><b>Sistema ABO</b></h5>
                <span>Los glóbulos rojos contienen una proteína en su superficie que llamadas antígenos, loss cuales
                fueron nombrados como <b>A, B, AB y O</b>. La diferencia de estos grupos se asocia a la incompatiblidad entre estos mismos,
                donde se presenta una diferencia entre proteínas presentes de los glóbulos rojos del donante y el receptor.<p>
                Existen solo dos tipos de antígenos: A y B. En la cual se clasifican en los grupos de la siguiente manera:<p>
                <b class="red-text">Grupo A</b> Antígenos A, contiene anticuerpos contra Antígenos B, por lo que el Grupo B es rechazado<br>
                <b class="red-text">Grupo B</b> Antígenos B, contiene anticuerpos contra Antígenos A, por lo que el Grupo A es rechazado<br>
                <b class="red-text">Grupo AB</b> Antígenos A y B, no contiene anticuerpos contra Antígenos A y B, por lo que es considerado como <b>receptor universal</b><br>
                <b class="red-text">Grupo O</b> No tiene antígenos en la superficie de los glóbulos.
              </span>
              </div>
              <div id="sistemarh" class="col s12 m6">
                <h5><b>Sistema RH</b></h5>
                <span>El sistema RH posee la misma lógica que el Sistema ABO, contiene el Antígeno RH o mejor llamado <b>Antígeno D</b>.<br>
                Alrededor del 95% de la población Chilena posee el Antígeno D, lo que quire decir que son Rh positivo, en
                contraste con el 5% que no la posee, se clasifica como Rh negativo. El grupo sanguíneo es definido por estos dos sistemas: <b>ABO + RH</b></span>
              </div>
              <div class="col s12 m6">
                <img id="imgtiposangre" src="../img/tiposangre.png">
              </div>
            </div>
          <!--Compatibilidad grupos-->
          <div>
            <div id="compatibilidad" class="col s12" style="padding-top: 20px;">
              <h4 class="red-text center">Compatibilidad de grupos sanguíneos</h4>
              <table>
                <tr>
                  <td></td>
                  <td colspan="8"><h5 class="center">Donantes</h5></td>
                </tr>
                <tr>
                  <td></td>
                  <td><b>O-</b></td>
                  <td><b>O+</b></td>
                  <td><b>B-</b></td>
                  <td><b>B+</b></td>
                  <td><b>A-</b></td>
                  <td><b>A+</b></td>
                  <td><b>AB-</b></td>
                  <td><b>AB+</b></td>
                </tr>
                <tr>
                  <td><b>AB+</b></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                </tr>
                <tr>
                  <td><b>AB-</b></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>A+</b></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                  <td></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>A-</b></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>B+</b></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>B-</b></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>O+</b></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>O-</b></td>
                  <td><i class="material-icons red-text">favorite_border</i></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>
          </div>
          <!--Colapsable con información-->
            <div id="colapsable">
              <div class="col s12" style="padding-bottom:50px;">
                <ul id="requisitos" class="collapsible">
                  <span class="center"><h4>Requisitos para la donación de sangre</h4></span>
                  <li class="active">
                    <div class="collapsible-header blue-grey lighten-5"><i class="material-icons green-text">check_circle</i>Puedes donar sangre si cumples estas condiciones</div>
                    <div class="collapsible-body"><span>
                      • Tienes documento de identidad con nombre y RUN.<br>• Tienes entre 18 y 65 años.<br>• Has dormido al menos 5 horas.
                      <br>• Pesas más de 50kg.<br>• Has comido en las últimas 5 horas (desayuno y/o almuerzo).<br>• En caso de haber donado,
                      has dejado pasar un periodo de 3 meses en caso de los hombres y 4 meses en caso de las mujeres.
                    </span></div>
                  </li>
                  <li>
                    <div class="collapsible-header blue-grey lighten-5"><i class="material-icons red-text">cancel</i>No puedes donar sangre si</div>
                    <div class="collapsible-body"><span>
                      • Has tenido relación sexual con una nueva persona hace menos de 8 meses (con o sin condón).<br>
                      • Has tenido relaciones sexuales con más de una persona en los últimos 8 meses (con o sin condón).<br>
                      • Has tenido relaciones con personas que ejercen el comercio sexual en los últimos 12 meses.<br>
                      • Te has realizado tatuajes, piercings (aros) o sesiones de acupuntura en los últimos 8 meses.<br>
                      • Has consumo alcohol o marihuana en las últimas 12 horas.<br>• Has consumido drogas.<br>
                      • Has tomado antibióticos en los últimos 7 días.<br>• Has tenido diarrea en los últimos 14 días.<br>
                      • Le han realizado endoscopía o colonoscopía en los últimos 8 meses.<br>
                      • Está embarazada, ha tenido parto o aborto en los últimos 6 meses.<br>
                      • Personas portadoras de enfermedades que se transmiten por la sangre:
                      SIDA, Hepatitis B, Hepatitis C, Enfermedad de Chagas, Infección por virus
                      linfotrópico humano (HTLV I-II) y Sífilis.
                    </span></div>
                  </li>
                  <li>
                    <div class="collapsible-header blue-grey lighten-5"><i class="material-icons blue-text">help_outline</i>Consultar antes de inscribirse como donante si</div>
                    <div class="collapsible-body"><span>
                      • Consume algún medicamento.<br>• Se ha efectuado un tratamiento dental en los últimos 7 días.<br>
                      • Tiene alguna enfermedad crónica.<br>• Ha sido operado en los últimos meses.
                    </span></div>
                  </li>
                  <li>
                    <div class="collapsible-header blue-grey lighten-5"><i class="material-icons red-text">opacity</i>Mitos acerca de la donación de sangre</div>
                    <div class="collapsible-body"><span>
                      • Las personas que tienen tatuajes sí pueden donar sangre, siempre que hayan pasado más de 8 meses desde el último<br>
                      • Las personas con hipertensión si pueden donar sangre, siempre que tengan su presión dentro de los rangos aceptables para la donación.<br>
                      • Las personas con diabetes y que se encuentren en tratamiento con medicamentos sí pueden donar sangre.<br>
                      • Las personas que consumieron alcohol hace más de 12 horas sí pueden donar sangre.<br>
                      • Las personas que consumieron marihuana hace más de 12 horas sí pueden donar sangre.<br>
                      • Las personas deben haber comido en las últimas 5 horas antes de donar.
                    </span></div>
                  </li>
                </ul>
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
