      <!--Header Nav-->
      <div class="navbar-fixed" style="z-index: 998;">
        <nav>
          <div class="nav-wrapper blue darken-4">
            <a href="index.php" class="brand-logo center"><img src="../img/logo.png" width="50px" height="50px"><span class="hide-on-small-only">Tú donas</span></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger show-on-large"><i class="material-icons left">menu</i><span class="hide-on-med-and-down"><b>Menú</b></span></a>
            <div class="">
              <a id="iconNot" href="#" class="left" style="padding-left:10px;"><i class="material-icons dropdown-trigger" data-target="dropdownNot">notifications</i></a>
              <label id="labelNotificacion" class="labelNotificacion dropdown-trigger" data-target="dropdownNot">0</label>
              <input id="valorSesion2" readonly hidden type="text" value="<?php echo $_SESSION["FK_Privilegio"] ?>">
            </div>

            <!--Dropdown notificaciones-->
            <ul id='dropdownNot' class='dropdown-content'>
              <li>
                <span id="textoMensajes" class="black-text"></span>

              </li>
            </ul>
            <script type="text/javascript" src="../js/funcionNotificaciones.js"></script>
          </div>
        </nav>
      </div>
    <!--Header versión mobile-->
       <ul class="sidenav" id="mobile-demo">
        <div class="user-view">
           <div class='col s12 m12 l5'>
               <?php include("../controlador/mostrarUsuarioControlador.php");?>

          </div>
          <br>
        </div>
         <li class="active"><a href="index.php"><i class="material-icons left">home</i>Inicio</a></li>
         <li><a href="campanas.php"><i class="material-icons left">computer</i>Campañas</a></li>
         <li><a href="calendario.php"><i class="material-icons left">date_range</i>Colectas de reposición</a></li>
         <li><a href="centros.php"><i class="material-icons left">location_on</i>Centros de Atención</a></li>
         <li><a href="noticias.php"><i class="material-icons left">library_books</i>Noticias</a></li>
         <li><a href="recomendaciones.php"><i class="material-icons left">favorite_border</i>Recomendaciones</a></li>
         <li><a href="quienesSomos.php"><i class="material-icons left">info_outline</i>Quiénes Somos</a></li>
         <li><a class="dropdown-trigger" href="#!" data-target="dropdown2"><i class="material-icons center">person
           </i>Cuenta<i class="material-icons right">arrow_drop_down</i></a></li>
       </ul>
