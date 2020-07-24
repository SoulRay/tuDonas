<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Centros de atencion</title>
    <link rel="icon" type="image/png" href="../img/logo.png "/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/funciones.js"></script>
    <script type="text/javascript" src="../js/mapa.js"></script>
    <script type="text/javascript" src="../js/funcionLogin.js"></script>
    <script type="text/javascript" src="../js/funcionCentro.js"></script>
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
         <span class="red-text center"><h4>Encuentra tu centro mas cercano</h4></span>
          <div class="row">
            <div id="map" style="width:100%;height:500px;" class="initMap"></div>
              <script async defer
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVLcEavhHj58pOnuGLRJD3pdhUtoBf6fU&callback=initMap">
              </script>
          </div>
      </div>

      <!--Contenido tabla de centros-->
      <div class="container">
        <span class="red-text center"><h4>Listado de centros</h4></span>
        <div id="tablaCentros">

        </div>
          <br>

            <?php
              if(!isset($_SESSION["usuario"])){

              }
              elseif($_SESSION["FK_Privilegio"] == "Administrador"){
              echo "<a class='btn-floating btn-large waves-effect waves-light red modal-trigger tooltipped' data-position='bottom' data-tooltip='Agregar un nuevo centro' href='#modal10'><i class='material-icons'>add</i></a> &nbsp;"
                  ;
              echo "<a class='btn-floating btn-large waves-effect waves-light red modal-trigger tooltipped' data-position='bottom' data-tooltip='Eliminar un centro' href='#modal11'><i class='material-icons'>remove</i></a>"
                  ;
              }
            ?>
            <div class='modal' id="modal10">
              <div class='modal-content row'>
                <h4 class='center'>Ingresar Centros de Donación</h4>
                    <div class="center" id="respuesta"></div>
                    <div class='input-field col s6'>
                      <i class="material-icons prefix">account_circle</i>
                      <input type='text' name="txtNombre" id="txtNombre" data-length="50" required>
                      <label for="txtNombre">Nombre</label>
                    </div>
                    <div class='input-field col s6'>
                      <i class="material-icons prefix">location_on</i>
                      <input type='text' name="txtDireccion" id="txtDireccion" data-length="50" required>
                      <label for="txtDireccion">Dirección</label>
                    </div>
                    <div class='input-field col s6'>
                      <i class="material-icons prefix">swap_horiz</i>
                      <input type='text' name="txtLatitud" id="txtLatitud" data-length="10"  required>
                      <label for="txtLatitud">Latitud</label>
                    </div>
                    <div class='input-field col s6'>
                      <i class="material-icons prefix">swap_vert</i>
                      <input type='text' name="txtLongitud" id="txtLongitud" data-length="10" required>
                      <label for="txtLongitud">Longitud</label>
                    </div>
                    <div class="col s12">
                    <label>Tipo de Centro</label>
                    <select class="browser-default" id="opcionTipo" name="opcionTipo" required>
                        <option value="" disabled selected>Seleccione el Tipo</option>
                        <option value="Banco de sangre">Banco de sangre</option>
                        <option value="Hospital">Hospital</option>
                        <option value="Consultorio">Consultorio</option>
                        <option value="Otra institución">Otra institución</option>
                    </select>
                    </div>
                    <div class='input-field col s6'>
                      <i class="material-icons prefix">phone</i>
                      <input type='text' name="txtTelefono" id="txtTelefono" data-length="10" required>
                      <label for="txtTelefono">Telefono</label>
                    </div>
                    <div class='input-field col s6'>
                      <i class="material-icons prefix">web</i>
                      <input type='text' name="txtPagina" id="txtPagina" data-length="30" required>
                      <label for="txtPagina">Pagina web</label>
                    </div>
                    <div class="modal-footer">
                      <button class="btn red right" id="btnEnviar" onclick="Registrar()">Enviar</button>
                    </div>
              </div>
            </div>

            <!--Modal Eliminar -->
            <div class="modal" id="modal11">
              <div class="modal-content row">
                <h4 class="center">Eliminar Centro</h4>
                <div class="center" id="respuesta2"></div>
                  <div>
                  <select class="browser-default" name="opcionCentro" id="opcionCentro" required>

                  </select>
                  </div>
                  <br>
                  <button class="btn red right" id="btnEnviar2" onclick="Eliminar()">Enviar</button>
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
