<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bienvenido</title>
  </head>
  <link rel="icon" type="image/png" href="../img/logo.png "/>
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/funciondonaciones.js"></script>
  <link rel="stylesheet" href="../css/materialize.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript" src="../js/funciones.js"></script>
  <body>

    <?php
      session_start();
      if(!isset($_SESSION["FK_Privilegio"])){
        header('Location: index.php');
      }
      //Formulario de registro
      include_once("../controlador/formulario.php");
      //Header
      require_once('../controlador/header.php');
    ?>

    <?php
      //echo "<script type=''>alert('Bienvenido: " . $_SESSION['apellido'] . "') </script>";
    ?>


    <div class="container">
      <div class="row">
        <div> <h5 class="center-align"></h5>
            <input type="text" id="txtrut" readonly hidden value="<?php echo $_SESSION["usuario"]; ?>">
            <input type="text" id="pass" readonly hidden value="<?php echo $_SESSION['pass']; ?>">
            <input type="text" id="once" readonly hidden value="<?php echo $_SESSION['once']; ?>">
         </div>
        <div class="col s12 m12 l12" id="divmd">
            <!-- <span class="black-text">

              <ul class="collection">
              <li class="collection-item"> <i class='material-icons iconPerfil'>vpn_key</i> <b> Rut : </b>  ?> </li>
              <li class="collection-item"> <i class='material-icons iconPerfil'>vpn_key</i> <b> Foto : </b>  ?> </li>
              <li class="collection-item"> <i class='material-icons iconPerfil'>person</i> <b> Nombre  :</b></li>
              <li class="collection-item"> <i class='material-icons iconPerfil'>mail</i> <b> Correo  :</b> </li>
              <li class="collection-item"> <i class='material-icons iconPerfil'>vpn_key</i> <b> Tipo Sangre : </b> </li>
              <li class="collection-item"> <i class='material-icons iconPerfil'>vpn_key</i> <b> Factor RH : </b>  </li>
              <li class="collection-item right-align"><input class="btn red modal-trigger" href="#modal1" type="button" name="btnModificarPerfil" value="Modificar perfil"></li>
              <</ul>
            </span> -->

          </div>




          <div class="col s12 m12 l12" id="divFecha">

             <!-- <ul class="collection">
              <li class="collection-item avatar"> <i class="small material-icons red-text">today</i><b> Tu ultima donacion fue: </b>
              </li>
              <li class="collection-item avatar">  <i class="small material-icons red-text">timer</i> <span class="title"><b>Pudes donar el: </b></span>
              </li>
              <li class="collection-item avatar">  <i class="small material-icons red-text">access_time</i> <span class="title"><b>Hoy es: </b></span>
              </li>
            </ul> -->

          </div>

      </div>
    </div>
    <div class="divider"> </div>
    <div class="container">
      <div class="row">
      <!--Carta de ingresar Donaciones-->
        <div class="col s12 m12 l6">
          <h4 class="header">Tus Donaciones</h4>
            <div class="card hoverable">
              <div class="card-image">
                <img src="../img/dd.png">
                <a class="btn-floating halfway-fab waves-effect waves-light red modal-trigger" href="#modal99"  name="bntAgregarDonacion" value="Agregar Donacion"> <i class="material-icons">add</i>  </a>
              </div>
              <div class="card-stacked">
              <div class="card-content">
                <p>En el boton "+" podras agregar la fecha de una donacion anteriormente realizada</p>
              </div>
              </div>
            </div>

        </div>
        <div class="row">


      <!--Recuadro con historial de donaciones -->
        <div class="col s12 m12 l6">
                <span class="red-text center"><h4>Lista Donaciones anteriores</h4></span>
                <input type="text" id="txtrut" readonly hidden value="<?php echo $_SESSION["usuario"]; ?>">
          <div id="tabladonaciones">
          <!-- Respuesta Modelo Donaciones.ObtenerDonaciones  -->
          </div>
        </div>

        <div class="divider"> </div>

        <div class="col s12 m12 l6">
                <span class="red-text center"><h4> Estado Campañas Solicitadas</h4></span>
                <input type="text" id="txtrut" readonly hidden value="<?php echo $_SESSION["usuario"]; ?>">
          <div id="tablaestadocampaña">
          <!-- Respuesta Modelo ObttenerCampañasUsuario  -->
          </div>
        </div>
        </div>
        </div>
    </div>

    <div class="container">

    </div>







    <div class="divider"> </div>


    <!-- Modal de ingresar donaciones -->
    <div class="modal" id="modal99">
        <div class="modal-content ">
          <h4 class="center">Agregar Donacion</h4>

              <div class="input-field">
                <input readonly type="text" id="txtRutDonante" value="<?php echo $_SESSION['usuario']; ?>">
                <label for="txtRutDonante">Rut del Donante</label>
              </div>
              <div class="input-field">
                <input type="text" id="txtFechaDonacion" class="datepicker">
                <label for="txtFechaDonacion">Fecha de la donacion</label>
              </div>
              <div class="input-field">
                <input type="text" id="txtDireccion" value="">
                <label for="txtdireccion">Direccion</label>
              </div>
               <label>Tipo del lugar</label>
                <select class="browser-default" id="stipolugar">
                  <option value="" disabled selected >Elige uno</option>
                  <option value="1">Banco de sangre</option>
                  <option value="2">Lugar de trabajo</option>
                  <option value="3">Institucion de Educacion Superior</option>
                  <option value="4">Colecta Movil</option>
                  <option value="5">Otro Lugar</option>
                </select>

              <div class="modal-footer">
                <input type="text" id="txtgenero" readonly hidden value="<?php echo $_SESSION["genero"]; ?>">
                <button name="btndonaciones" value="Agregar Donacion" class="btn red boton">Agregar</button>&nbsp;
                <button name="btncancelar" value="cancelar" class="btn red boton">Cancelar</button>
              </div>

          </div>
      </div>

      <!-- Modal Modificar datos -->
      <div class="modal" id="modal1">
          <div class="modal-content">
            <h4 class="center">Modificar Datos</h4>
              <div class="input-field">
                <label for="txtNombre2">Nombres Usuario</label>
                <input type="text" id="txtNombre2" value="<?php echo $_SESSION["nombre"];?>">
              </div>
              <div class="input-field">
                <label for="txtApellidos2">Apellidos Usuario</label>
                <input type="text" id="txtApellidos2" value="<?php echo $_SESSION["apellido"];?>">
              </div>
              <div class="input-field">
                <label for="txtCorreo2">Correo</label>
                <input type="text" id="txtCorreo2" value="<?php echo $_SESSION["correo"];?>">
              </div>
              <div class="input-field">
                <label for="txtPassword2">Password</label>
                <input type="password" id="txtPassword2" value="">
              </div>
              <div class="col s12">
              <label for="txtPassword2">Tipo de Sangre</label>
                <select class="browser-default" id="opcionSangre2" name='opcionSangre2' required>
                  <option value="" disabled selected>Seleccione el tipo de sangre</option>
                  <option value="1">O Rh-</option>
                  <option value="2">O Rh+</option>
                  <option value="3">A Rh-</option>
                  <option value="4">A Rh+</option>
                  <option value="5">B Rh-</option>
                  <option value="6">B Rh+</option>
                  <option value="7">AB Rh-</option>
                  <option value="8">AB Rh+</option>
                </select>
              </div>

              <br>

              <input type="text" id="txtrut" readonly hidden value="<?php echo $_SESSION["usuario"]; ?>">
              <button name="btnActualizarDatos" value="actualizar" class="btn red boton">Actualizar</button>
          </div>
        </div>
      </div>
    </div>
    </div>

    <div class="container">
        <div id="rjsDonaciones">
        <!--Respuesta de Ajax -->
        </div>
    </div>
    <?php
      //footer
      require_once('../controlador/footer.php');
    ?>
  </body>
</html>
