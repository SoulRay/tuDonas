<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Quienes Somos</title>
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
        <!--Contenedor-->
        <div class="container">
            <span class="red-text center"><h4>Quienes Somos</h4></span><br>
            Somos una empresa comprometida con el ámbito social y las personas. Buscamos la sencillez,
            agilidad y automatización de los procesos, para dar una comodidad y una ayuda a la gente que lo necesite. Este proyecto está enfocado
            al Hospital y a la gente que se trata para el tema de la donación de sangre.<p>
            Muchas veces, las personas no tienen el hábito de donar, principalmente, solo lo hacen por algún familiar o persona conocida o porque no
            conocen su última fecha de donación, ya que esta es una información difícil de conseguir a través algún medio oficial del hospital. Además,
            la gente se encuentra muy desinformada, ya sea por falta de información o por poseer información errónea, por ejemplo, con el tema de los tatuajes y
            enfermedades (Hipertensión, diabetes) donde la gente cree que debido a esto no puede donar. Estos casos, evitan que la gente vaya a donar, provocando
            una falta de reservas necesarias para las transfusionesd de sangre.
            <div class="col s12"> <span class="red-text center"><h4>Nuestros Principios</h4></span> </div><br>
            <div class="row center">
                <div class="col s4">
                    <i class="material-icons center large blue-text text-darken-4">domain</i>
                     <h4>Misión</h4>
                    <p>Entregar información importante y herramientas necesaria en relación con la donación de sangre mediante una aplicación web,
                      ayudando tanto a las personas a llevar un control en las donaciones como a las que buscan información.</p>
                </div>
                <div class="col s4">
                    <i class="material-icons center large blue-text text-darken-4">public</i>
                    <h4>Visión</h4>
                    <p>Estar en el uso de la mayoría de los donantes de sangre, creando un hábito de donación.</p>
                </div>
                <div class="col s4">
                    <i class="material-icons center large blue-text text-darken-4">group</i>
                    <h4>Valores</h4>
                    <p>Los valores definen nuestro comportamiento y sirven de guía para nuestras acciones.
                    <li>Trabajo en equipo</li>
                    <li>Compromiso</li>
                    <li>Respetuo mutuo</li>
                    </p>
                </div>
            </div>
            <div class="col s12"> <span class="red-text center"><h4>Conoce al Equipo</h4></span> <br> </div>
                <div class="row">
                    <div class="col s2">
                        <img src='../img/alexanderEsquivel.jpg' alt='admin' class='circle responsive-img z-depth-1'>
                    </div>
                    <div class="col s10">
                        <h4>Alexander Esquivel</h4>
                        <p> Alexander es un especialista en sistemas de información con una especialización en interacción con computadoras humanas.
                        Trabajó como desarrollador de software para Intuit el verano pasado.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col s2">
                        <img src='../img/cristopherRodriguez.jpg' alt='admin' class='circle responsive-img z-depth-1'>
                    </div>
                    <div class="col s10">
                        <h4>Cristopher Rodríguez</h4>
                        <p> Cristopher es un especialista en sistemas de información con una especialización en ciencias de la computación.
                        Trabajó como desarrollador de Front End en Shift Collaborative el verano pasado. </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col s2">
                        <img src='../img/santiagoHerrera.jpg' alt='admin' class='circle responsive-img z-depth-1'>
                    </div>
                    <div class="col s10">
                        <h4>Santiago Herrera</h4>
                        <p> Santiago es un especialista en sistemas de información con una especialización en interacción con computadoras humanas.
                        El verano pasado, trabajó como analista de tecnología en PPG Industries. </p>
                    </div>
                </div>
            <div class="col s12"> <span class="red-text center"><h4>Agradecimientos</h4></span> <br> </div>
            <div class="row center">
                <div class="col s2">
                    <img src='../img/inacap.png' alt='admin' class='circle responsive-img z-depth-1'>
                     <h4>Inacap</h4>
                    <p>Es un Sistema Integrado de Educación Superior, constituido por la Universidad Tecnológica de Chile INACAP,
                    el Instituto Profesional INACAP y el Centro de Formación Técnica INACAP, que comparten una Misión y Valores Institucionales.
                    </p>
                </div>
                <div class="col s1"></div>
                <div class="col s2">
                    <img src='../img/guia.jpg' alt='admin' class='circle responsive-img z-depth-1'>
                    <h4>Luis Bravo</h4>
                    <p>Profesor guía durante el proceso de tesis, el cual nos ayudó a resolver dudas y problemas desde el primer día
                    hasta la presentación ante la comisión.
                    </p>
                </div>
                <div class="col s1"></div>
                <div class="col s2">
                    <img src='../img/bancosangre.png' alt='admin' class='circle responsive-img z-depth-1'>
                    <h4>Banco de Sangre</h4>
                    <p>Agradecemos al Banco de Sangre del Hospital San Juan de Dios y su encargada, por recibirnos y orientarlos en la realización de nuestra página web.
                    </p>
                </div>
                <div class="col s1"></div>
                <div class="col s2">
                    <img src='../img/profesores.jpg' alt='admin' class='circle responsive-img z-depth-1'>
                    <h4>Profesores</h4>
                    <p>Gracias a todos los profesores en estos ocho semestres de la carrera que nos entregaron todos sus conocimientos para el egreso al mundo laboral.
                    </p>
                </div>
                <div class="col s1"></div>
            </div>
        </div>


    <?php
      //footer
      require_once('../controlador/footer.php');
    ?>
</body>
</html>
