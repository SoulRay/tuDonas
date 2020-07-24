<?php
if(!isset($_SESSION["usuario"]))
{
  //Dropdown de la opción cuenta
echo "
  <ul id='dropdown1' class='dropdown-content'>
    <!--Modal trigger-->
    <li><a href='#modal1' class='modal-trigger'>Registrarse</a></li>
    <li><a href='#modal2' class='modal-trigger'>Iniciar Sesión</a></li>
    <li class='divider'></li>
  </ul>
  <!--Dropdown de la opción cuenta versión mobile-->
    <ul id='dropdown2' class='dropdown-content'>
      <li><a href='#modal1' class='modal-trigger'><i class='material-icons left'>forward</i>Registrarse</a></li>
      <li><a href='#modal2' class='modal-trigger'><i class='material-icons left'>assignment</i>Iniciar Sesión</a></li>
    </ul>
  <!--Estructura del modal-->
    <!--Formulario de registro-->

<div id='modal1' class='modal'>
  <div class='modal-content'>
    <h5 class='center'>Registrate</h5>
    <form action='../controlador/controladorUsuario.php' class='form' method='post' id='formularioRegistro' onsubmit='return enviar()'>
      <div class='row'>
        <div class='input-field col s6'>
          <i class='material-icons prefix'>account_circle</i>
          <input type='text' name='txtnombreUsuario' required>
          <label for='txtnombreUsuario'>Nombre</label>
        </div>
        <div class='input-field col s6'>
          <i class='material-icons prefix'>toc</i>
          <input type='text' name='txtapellidoUsuario' required>
          <label for='txtapellidoUsuario'>Apellido</label>
        </div>
        <div class='input-field col s6'>
          <i class='material-icons prefix'>vpn_key</i>
          <input type='text' id='txtrutUsuario' name='txtrutUsuario' placeholder='Ej: 12345678-9' required>
          <label for='txtrutUsuario'>RUN</label>
          <span class='helper-text col s12' id='msgerror' data-error='No valido'></span>
        </div>
        <div class='input-field col s6'>
          <i class='material-icons prefix'>https</i>
          <input type='password' name='txtpassUsuario' required>
          <label for='txtpassUsuario'>Contraseña</label>
        </div>
        <div class='input-field col s6'>
          <i class='material-icons prefix'>email</i>
          <input type='email' name='txtcorreoUsuario' class='validate' placeholder='ejemplo@tudonas.cl' required>
          <label for='txtcorreoUsuario'>Correo</label>
          <span class='helper-text' data-error='No valido' data-success='Valido'></span>
        </div>
        <div class='col s6'>
          <label for='correoUsuario'>Genero</label>
          <select class='browser-default' id='opcionGenero' name='opcionGenero' required>
            <option value='Hombre'>Hombre</option>
            <option value='Mujer'>Mujer</option>
          </select>
        </div>
        <div class='col s6'>
          <label>Tipo sangre</label>
          <select class='browser-default' id='opcionSangre'name='opcionSangre' required>
            <option disabled selected>Seleccione su tipo de sangre</option>
            <option value='0'>Sin información</option>
            <option value='1'>O Rh-</option>
            <option value='2'>O Rh+</option>
            <option value='3'>A Rh-</option>
            <option value='4'>A Rh+</option>
            <option value='5'>B Rh-</option>
            <option value='6'>B Rh+</option>
            <option value='7'>AB Rh-</option>
            <option value='8'>AB Rh+</option>
          </select>
        </div>
        <div class='file-field input-field col s12'>
          <div class='btn'>
            <span>IMAGEN</span>
            <input type='file' name='imagenUser' id='imagenUser' accept='image/*'>
          </div>
          <div class='file-path-wrapper'>
            <input class='file-path validate' type='text'>
          </div>
        </div>
        <div class='modal-footer'>
          <input class='btn red' type='submit' name='btnEnviarRegistro' id='btnEnviarRegistro' value='Enviar'>
        </div>
        <div id='respuestaRegistro'></div>
      </div>
    </form>
  </div>
</div>
<!--Formulario de ingreso-->
<div id='modal2' class='modal'>
  <div class='modal-content'>

      <div class='row'>
      <div class='col s3'></div>
      <img src='../img/logo.png' class='responsive-img circle col s6' width='100px' height='100px'>
      <div class='col s3'></div>
      <h5 class='center col s12'>Iniciar Sesión</h5>
        <div class='input-field col s12'>
          <i class='material-icons prefix'>account_circle</i>
          <input type='text' id='rutUsuario2' name='rutUsuario2' placeholder='Ej: 12345678-9' required>
          <label for='rutUsuario2'>RUN</label>
        </div>
        <div class='input-field col s12'>
          <i class='material-icons prefix'>https</i>
          <input type='password' id='passUsuario2' name='passUsuario2' required>
          <label for='passUsuario2'>Contraseña</label>
        </div>
        <div class='modal-footer'>
          <input class='btn red col s12' type='submit' name='btnEnviar2' id='btnEnviar2' value='Enviar'>
          <a href='#modal1' class='modal-trigger left modal-close'>Registrate ahora</a>
        </div>
        <div id='respuestaLogin'>
        </div>
      </div>
  </div>
</div>";
}
else if($_SESSION["FK_Privilegio"] != "Administrador")
{
  echo "
    <ul id='dropdown2' class='dropdown-content'>
      <li><a href='bienvenido.php'><i class='material-icons left'>account_circle</i>Mi perfil</a></li>
      <li><a href='../controlador/cerrarsesion.php'><i class='material-icons left'>forward</i>Cerrar sesión</a></li>
    </ul>";
}
else
{
  echo "
    <ul id='dropdown2' class='dropdown-content'>
      <li><a href='bienvenido.php'><i class='material-icons left'>account_circle</i>Mi perfil</a></li>
      <li><a href='vistaBuscar.php'><i class='material-icons left'>build</i>Panel administrativo</a></li>
      <li><a href='../controlador/cerrarsesion.php'><i class='material-icons left'>forward</i>Cerrar sesión</a></li>
    </ul>";
}
?>
