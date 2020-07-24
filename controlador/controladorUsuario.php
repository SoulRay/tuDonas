
<?php
include_once("../modelo/modeloUsuario.php");
include_once("../modelo/modeloDonaciones.php");
$usuario = new Usuario();
$d = new Donaciones();
  if(isset($_POST["txtrutUsuario"]))
  {
    $usuario->setRut($_POST["txtrutUsuario"]);
    $rut = $usuario->getRut();
    $usuario->setNombre($_POST["txtnombreUsuario"]);
    $nombre = $usuario->getNombre();
    $usuario->setApellido($_POST["txtapellidoUsuario"]);
    $apellido = $usuario->getApellido();
    $usuario->setPassword($_POST["txtpassUsuario"]);
    $password = $usuario->getPassword();
    $usuario->setCorreo($_POST["txtcorreoUsuario"]);
    $correo = $usuario->getCorreo();
    $usuario->setGenero($_POST["opcionGenero"]);
    $genero = $usuario->getGenero();
    $usuario->setTiposangre($_POST["opcionSangre"]);
    $tiposangre = $usuario->getTiposangre();
    if( $rut=="" || $nombre=="" || $apellido=="" || $password=="" || $correo=="" || $genero=="" || $tiposangre==""){
      echo "No deje campos vacíos";
    }
    elseif($_FILES["imagenUser"]["size"] < 1){
      echo "<script>alert('Ingrese una imagen de perfil');</script>";
    }
    else{
      $ruta = "../imagenUser/";
      $ruta2 = $rut."/";
      $nombrefinal = trim($_FILES["imagenUser"]["name"]);
      $subir = $ruta . $ruta2 . $nombrefinal;
      $archivo = $_FILES["imagenUser"]["tmp_name"];
      if(is_dir($ruta . $ruta2)){
        echo "El usuario ya existe";
      }
      else{
        mkdir("$ruta/$rut", 0777);
        if(move_uploaded_file($_FILES["imagenUser"]["tmp_name"], $subir)){
          $usuario->ingresarUsuario($rut,$nombre,$apellido,$password,$correo,$genero,$tiposangre,$subir);
        }
      }
    }
  }
  else if(isset($_POST["rutUsuario2"]))
  {
    $rut = $_POST["rutUsuario2"]; //mysqli_real_escape_string (agregar)
    $password = $_POST["passUsuario2"]; //mysqli_real_escape_string (agregar)
    $usuario->obtenerDatos($rut,$password);
    /*$usuario1 = new Usuario();
    $usuario1->Usuario2($rut,$password);
    $usuario1->getRut();
    $usuario1->getPass();
    /*$usuario1->setRut("$rut");
    $usuario1->setPass("$password");
    echo $usuario1->rut;*/
  }
  else if(isset($_POST["rutBuscar"])){
    $rut = $_POST["rutBuscar"];
    $usuario->buscarUser($rut);
  }
  else if(isset($_POST["rutPerfil"])){
    $rut = $_POST["rutPerfil"];
    $usuario->verPerfilUser($rut);
  }
  else if(isset($_POST["rutVerBloqueo"])){
    $rut = $_POST["rutVerBloqueo"];
    $usuario->verBloqueo($rut);
  }
  else if(isset($_POST["verUserCorreos"])){
    $usuario->verUserCorreos();
  }
  else if(isset($_POST["enviarCorreos"])){
    $usuario->enviarCorreos();
  }
  else if(isset($_POST["rutFicha3"])){
    $usuario->verFicha($_POST["rutFicha3"]);
  }
  else if(isset($_POST["rutFicha2"])){
    $usuario->verFicha($_POST["rutFicha2"]);
  }
  else if(isset($_POST["rutFicha"])){
    $rut = $_POST["rutFicha"];
    $ruta = "../archivos/";
    $ruta2 = $rut."/";
    $nombrefinal = trim($_FILES["archivo"]["name"]);
    $nombre = $_FILES["archivo"]["name"];
    $tipo = $_FILES["archivo"]["type"];
    $tamaño = $_FILES["archivo"]["size"];
    if($_FILES["archivo"]["size"] < 1){
      echo "<script>alert('Ingrese una imagen de perfil');</script>";
    }
    else{
      if(!is_dir($ruta . $ruta2)){
        mkdir("../archivos/$rut", 0777);
        $subir = $ruta . $ruta2 . $nombrefinal;
        if(move_uploaded_file($_FILES["archivo"]["tmp_name"], $subir)){
          $usuario->agregarFicha($nombre,$tipo,$tamaño,$rut);
        }
      }
      else{
        echo "El directorio ya existe";
      }
    }
  }
  else if(isset($_POST["txtIdBloqueo"])){
    $rut = $_POST["txtIdBloqueo"];
    $tipobloq = $_POST["selectBloqueo"];
    $comentario = $_POST["comentarioBloqueo"];
    $fecha = "";
    if($tipobloq == "Bloqueo diario"){
      $fecha = date("Y-m-d", strtotime(date("Y-m-d")."+ 1 day"));
    }
    elseif($tipobloq == "Bloqueo semanal"){
      $fecha = date("Y-m-d", strtotime(date("Y-m-d")."+ 1 week"));
    }
    elseif($tipobloq == "Bloqueo mensual"){
      $fecha = date("Y-m-d", strtotime(date("Y-m-d")."+ 1 month"));
    }
    elseif($tipobloq == "Bloqueo permanente"){
      $fecha = date("Y-m-d", strtotime(date("Y-m-d")."+ 15 years"));
    }
    else{
      $fecha = date("Y-m-d", strtotime(date("Y-m-d")));
    }

    if($tipobloq=="" || $fecha=="" || $comentario=="" || $rut==""){
      ?>
        <script>alert("No deje campos vacíos");</script>
      <?php
    }
    else{
      $usuario->bloquearUsuario($tipobloq,$fecha,$comentario,$rut);
    }
  }
  else if(isset($_POST["P_rut"])){

    $usuario->setNombre($_POST["P_nombre2"]);
    $nombre2 = $usuario->getNombre();
    $usuario->setApellido($_POST["P_apellido2"]);
    $apellido2 = $usuario->getApellido();
    $usuario->setCorreo($_POST["P_correo2"]);
    $correo2 = $usuario->getCorreo();
    $usuario->setPassword($_POST["P_pass2"]);
    $pass2 = $usuario->getPassword();
    $usuario->setTiposangre($_POST["P_tiposangre2"]);
    $tiposangre2 = $usuario->getTiposangre();
    $rut = $_POST["P_rut"];

    if($rut != ""){

      $usuario->actualizarDatos($rut,$nombre2,$apellido2,$correo2,$pass2,$tiposangre2);


    }else{
        ?> <script>
        alert("Error en ajax");
        </script>  <?php
    }

  }

  else if(isset($_POST["once"])){

    $rut = $_POST["cdrut"]; //mysqli_real_escape_string (agregar)
    $password = $_POST["cdpass"]; //mysqli_real_escape_string (agregar)
    $usuario->verPerfilUser2($rut);
  }
  else
  {
    header("Location: ../vista/index.php") ;
  }



?>
