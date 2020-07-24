<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Campañas de donación</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link rel="icon" type="image/png" href="../img/logo.png "/>
    <link rel="stylesheet" href="../css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css">
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/funciones.js"></script>
    <script type="text/javascript" src="../js/funcionCampana.js"></script>
    <script type="text/javascript" src="../js/funcionLogin.js"></script>
    <script type="text/javascript" src="../js/validarLogin.js"></script>
  </head>
  <body>

    <?php
      session_start();
      //Formulario de registro
      include_once("../controlador/formulario.php");
      //Header
      require_once('../controlador/header.php');
    ?>

    <!--Body Container-->
      <div class="container">
        <span class="red-text center"><h4>Filtrar campañas</h4></span>
          <div class="row blue-grey lighten-4" id="formularioFiltroCampana">
            <div class="col s12"></div>
            <div style="padding-bottom: 20px" class="input-field col s12">
              <i class="material-icons prefix">search</i>
              <input type="text" name="txtRut" id="txtRut" value="">
              <label for="txtTitulo">Buscar por rut</label>
            </div>
            <div class="col s12">
              <b class="black-text">Buscar por tipo de sangre</b>
                <select class="browser-default" id="opcionSangre" name='opcionSangre' required>
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
            <div style="padding-top: 40px;" class="col s12">
              <button class='btn blue darken-4' name='btnCampana' id='btnCampana2' value='buscarTodos' onclick="Cargar()">Buscar todos</button><br>
            </div>
        </div>
        <!--Controlador usuarios CRUD Campañas-->
        <div class="row">
          <?php
            if(!isset($_SESSION["usuario"])){

            }
            elseif($_SESSION["FK_Privilegio"] == "Administrador"){
            echo "
              <div style='position: relative; height: 70px; padding-top: 100px;'>
                <div class='fixed-action-btn horizontal' style='position: absolute; display: inline-block; left: 24px;'>
                  <a data-tooltip='Gestionar campañas' data-position='bottom' class='tooltipped  btn-floating btn-large red'>
                    <i class='large material-icons'>mode_edit</i>
                  </a>
                  <ul>
                    <li>
                      <a id='btnCampanasAnteriores' data-tooltip='Finalizadas' data-position='bottom' class='tooltipped btn-floating red'>
                        <i class='material-icons'>history</i>
                      </a>
                    </li>
                    <li>
                      <a id='txtCrearcamp2' data-tooltip='Eliminar' data-position='bottom' class='tooltipped modal-trigger btn-floating purple darken-1' href='#modal5'>
                        <i class='material-icons'>delete_forever</i>
                      </a>
                    </li>
                    <li>
                      <a id='txtCrearcamp3' data-tooltip='Actualizar' data-position='bottom' class='tooltipped modal-trigger btn-floating green' href='#modal4'>
                        <i class='material-icons'>refresh</i>
                      </a>
                    </li>
                    <li>
                      <a id='btnAgregarCampanaAdmin' data-tooltip='Agregar' data-position='bottom' class='tooltipped modal-trigger btn-floating yellow darken-3' href='#modal7'>
                        <i class='material-icons'>add</i>
                      </a>
                    </li>
                    <li>
                      <a id='txtCrearcamp' data-tooltip='Solicitudes' data-position='bottom' class='tooltipped modal-trigger btn-floating blue' href='#modal6'>
                        <i class='material-icons'>thumb_up</i>
                      </a>
                    </li>
                    <label id='labelNotificacion2'></label>
                  </ul>
                </div>
              </div>"
                ;
            }
            else{
              echo"
                <div id='divSolicitar'></div>
              ";
            }
          ?>
        </div>
        <!--Modal Actualizar campaña-->
        <div id="modal4" class="modal">
          <div class="modal-content row">
            <form class="" action="modificarCampana.php" method="post" id="formActualizar1">
              <h4 style="padding-bottom: 20px;" class="red-text center">Actualizar campaña</h4>
              <div style="padding-bottom: 20px" class="input-field col s12">
                <i class="material-icons prefix">edit</i>
                <input class="" id="txtModificarCampana" name="txtModificarCampana" type="text" name="" value="" required>
                <label for="txtTitulo">Rut a modificar</label>
              </div>
              <div style="position: relative;">
                <input style="background-color:#0d47a1;" class="btn col s12" type="submit" value="Enviar" id="btnEnviarModificar" name="btnEnviarModificar"><p>
              </div>
              <div class="col s12" id="divrespuesta">

              </div>
            </form>
          </div>
        </div>
        <!--Modal eliminar Campaña-->
        <div id="modal5" class="modal">
          <div class="modal-content row">
            <div id='divEliminar' class='input-field col s12'>
              <h4 class="red-text center">Eliminar campaña</h4>
              <div style="padding-bottom: 20px" class="input-field col s12">
                <i class="material-icons prefix">edit</i>
                <input type='text' id='txtEliminarCampana' name='txtEliminarCampana' value=''>
                <label for="txtTitulo">Rut a eliminar</label>
              </div>
              <input type="submit" style="background-color:#0d47a1; width: 100%;" class='btn modal-trigger' value="Eliminar" onclick="Eliminar()">
              <div id='respuestaEliminar' class='center col s12'>
              </div>
            </div>
          </div>
        </div>
        <!--Modal crear campana-->
        <div id="modal7" class="modal">
          <div class="modal-content row" >
            <h4 class='center'>Crea una Campaña</h4>
              <div class="center" id="respuesta"></div>
              <div class="input-field col s12 l6">
                <i class="material-icons prefix">vpn_key</i>
                <input type="text" id="rutUsuarioA" name="rutUsuarioA" value="<?php echo $_SESSION["usuario"]; ?>" required readonly>
                <label for="rutUsuarioA">Rut del usuario creador</label>
              </div>
              <div class="input-field col s12 l6">
                <i class="material-icons prefix">vpn_key</i>
                <input type="text" id="rutPersonaA" name="rutPersonaA" value="" required>
                <label for="rutPersonaA">Rut de la persona</label>
              </div>
              <div class="input-field col s12 l6">
                <i class="material-icons prefix">person</i>
                <input type="text" id="nombresPersonaA" name="nombresPersonaA" value="" required>
                <label for="nombresPersonaA">Nombres</label>
              </div>
              <div class="input-field col s12 l6">
                <i class="material-icons prefix">person_outline</i>
                <input type="text" id="apellidosPersonaA" name="apellidosPersonaA" value="" required>
                <label for="apellidosPersonaA">Apellidos</label>
              </div>
                <label>Tipo sangre</label>
                <select class='browser-default' id="txtTiposangreA" name='txtTiposangreA' required>
                  <option disabled selected>Seleccione el tipo de sangre</option>
                  <option value="1">O Rh-</option>
                  <option value="2">O Rh+</option>
                  <option value="3">A Rh-</option>
                  <option value="4">A Rh+</option>
                  <option value="5">B Rh-</option>
                  <option value="6">B Rh+</option>
                  <option value="7">AB Rh-</option>
                  <option value="8">AB Rh+</option>
                </select>
                <label>Nombre del centro</label>
                <select class='browser-default' id='nombreCentroA' name='nombreCentroA' required>
                  <option disabled selected>Seleccione el centro</option>
                  <option value="1">Centro Met. de Sangre</option>
                  <option value="2">Hospital Sótero del Río</option>
                  <option value="3">Hospital Barros Luco</option>
                  <option value="4">Hospital Padre Hurtado</option>
                  <option value="5">Hospital San José</option>
                  <option value="6">Hospital La Florida</option>
                  <option value="7">Hospital El Carmen</option>
                  <option value="8">Hospital Luis Tisné</option>
                  <option value="9">Hospital Salvador</option>
                </select>
                <div class="input-field">
                  <i class="material-icons prefix">border_color</i>
                  <textarea id="comentarioPersonaA" name="comentarioPersonaA" rows="8" cols="80"></textarea>
                  <label for="comentarioPersonaA">Ingrese la descripción de la campaña</label>
                </div>
                <button class="btn red right" onclick="RegistrarAdmin()">Enviar</button>
          </div>
        </div>
        <!--Modal solicitar campaña-->
        <div id="modal3" class="modal">
          <div class="modal-content row" >
            <h4 class='center'>Crea una Campaña</h4>
              <div class="center" id="respuesta"></div>
              <div class="input-field col s12 l6">
                <input type="text" id="rutUsuarioC" name="rutUsuarioC" value="<?php echo $_SESSION["usuario"]; ?>" required readonly>
                <label for="rutUsuarioC">Rut del usuario creador</label>
              </div>
              <div class="input-field col s12 l6">
                <input type="text" id="rutPersonaC" name="rutPersonaC" value="" required>
                <label for="rutPersonaC">Rut de la persona</label>
              </div>
              <div class="input-field col s12 l6">
                <input type="text" id="nombresPersonaC" name="nombresPersonaC" value="" required>
                <label for="nombresPersonaC">Primer y segundo Nombre</label>
              </div>
              <div class="input-field col s12 l6">
                <input type="text" id="apellidosPersonaC" name="apellidosPersonaC" value="" required>
                <label for="apellidosPersonaC">Apellido paterno y materno</label>
              </div>
                <label>Tipo sangre</label>
                <select class='browser-default' id="txtTiposangreC" name='txtTiposangreC' required>
                  <option disabled selected>Seleccione el tipo de sangre</option>
                  <option value="1">O Rh-</option>
                  <option value="2">O Rh+</option>
                  <option value="3">A Rh-</option>
                  <option value="4">A Rh+</option>
                  <option value="5">B Rh-</option>
                  <option value="6">B Rh+</option>
                  <option value="7">AB Rh-</option>
                  <option value="8">AB Rh+</option>
                </select>
                <label>Nombre del centro</label>
                <select class='browser-default' id='nombreCentroC' name='nombreCentroC' required>
                  <option disabled selected>Seleccione el centro</option>
                  <option value="1">Centro Met. de Sangre</option>
                  <option value="2">Hospital Sótero del Río</option>
                  <option value="3">Hospital Barros Luco</option>
                  <option value="4">Hospital Padre Hurtado</option>
                  <option value="5">Hospital San José</option>
                  <option value="6">Hospital La Florida</option>
                  <option value="7">Hospital El Carmen</option>
                  <option value="8">Hospital Luis Tisné</option>
                  <option value="9">Hospital Salvador</option>
                </select>
                <div class="input-field">
                  <textarea id="comentarioPersonaC" name="comentarioPersonaC" rows="8" cols="80"></textarea>
                  <label for="comentarioPersonaC">Ingrese la descripción de la campaña</label>
                </div>
                <button class="btn red right" onclick="Registrar()">Enviar</button>
          </div>
        </div>

        <!--Modal Gestionar solicitudes-->
        <div id="modal6" class="modal">
          <div class="modal-content row">
            <table>
              <thead>
                <th>Rut paciente</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Tipo Sangre</th>
                <th>Centro</th>
                <th>Dirección</th>
                <th>Estado</th>
              </thead>
              <tbody id="tablaSolicitudes">
              </tbody>
            </table>
          </div>
        </div>

        <!--Campañas generales-->
        <div id="divCampanas">
          <div id="loaderCampanas" class="preloader-wrapper big active">
            <div class="spinner-layer spinner-red-only">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div>
              <div class="gap-patch">
                <div class="circle"></div>
              </div>
              <div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  <?php
    //footer
    require_once('../controlador/footer.php');
  ?>
  </body>
</html>
