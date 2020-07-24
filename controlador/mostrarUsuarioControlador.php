<?php if(isset($_SESSION["usuario"]))
{
  if($_SESSION["FK_Privilegio"] != "Administrador")
  {
    echo "
    <div class='background'>
      <img src='../img/fondo2.jpg' class='responsive-img'>
    </div>
    <div class='col s4'>
      <img style='padding-left: 5px;' src='".$_SESSION['imagen']."' alt='admin' class='circle responsive-img z-depth-1'>
    </div>";
  } else
  {
    echo "
    <div class='background'>
      <img src='../img/fondo4.jpg' class='responsive-img'>
    </div>
    <div class='col s4'>
      <img style='padding-left: 5px;' src='".$_SESSION['imagen']."' alt='admin' class='circle responsive-img'>
    </div>";
  }
  echo "
  <div class='col s8 '>
    <?php echo " . "<b><b class='red-text text-darken-2'>" . $_SESSION['FK_Privilegio'] . "</b></b>" . "<br>
    <b><span class='white-text'>" . $_SESSION['nombre'] . "&nbsp;" . $_SESSION['apellido'] . "</span></b><br>
    <b><span class='white-text'>" . $_SESSION['correo'] . "</span></b>
  </div>";

}
else{
  echo "<div class='col s4'>
    <img style='padding-left: 5px;' src='../img/icono2.png' alt='admin' class='circle responsive-img'>
  </div>
  <div class='col s8 '>
    <?php echo " . "<b><b style='color: black'>" . "Usuario desconocido" . "</b></b>" . "<br>
    <b><a href='#modal2' class='modal-trigger' id='iniciarSesion'> Inicia sesión</a> o
    <a href='#modal1' class='modal-trigger' id='registrarse'> Regístrate</a></b>
  </div>";
}
?>
