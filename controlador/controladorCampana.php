<?php
include_once("../modelo/modeloCampana.php");
$c = new Campana();
  if(isset($_POST["rutUsuarioC"])){
    $c->setRutUsuario($_POST["rutUsuarioC"]);
    $rutusuario = $c->getRutUsuario();
    $c->setRutPersona($_POST["rutPersonaC"]);
    $rutpersona = $c->getRutPersona();
    $c->setNombresPersona($_POST["nombresPersonaC"]);
    $nombrespersona = $c->getNombresPersona();
    $c->setApellidosPersona($_POST["apellidosPersonaC"]);
    $apellidospersona = $c->getApellidosPersona();
    $c->setComentarioPersona($_POST["comentarioPersonaC"]);
    $comentariopersona = $c->getComentarioPersona();
    $c->setTiposangre($_POST["txtTiposangreC"]);
    $tiposangre = $c->getTiposangre();
    $c->setNombreCentro($_POST["nombreCentroC"]);
    $nombrecentro = $c->getNombreCentro();
    $fecha = date("Y-m-d", strtotime(date("Y-m-d").'+ 1 week'));
    $c->ingresarCampana($rutusuario,$rutpersona,$nombrespersona,$apellidospersona,$comentariopersona,$tiposangre,$nombrecentro,$fecha);
  }
  elseif(isset($_POST["rutEliminarCampana"])){
    $id = $_POST["rutEliminarCampana"];
    $c->eliminarCampana($id);
  }
  elseif(isset($_POST["rutPaciente"])){
    $rut = $_POST["rutPaciente"];
    $nombres = $_POST["txtNombres"];
    $apellidos = $_POST["txtApellidos"];
    $tiposangre = $_POST["txtTiposangre"];
    $nombreRecinto = $_POST["txtNombreRecinto"];
    $descripcion= $_POST["txtDescripcion"];
    if($rut=="" || $nombres=="" || $apellidos=="" || $tiposangre=="" || $nombreRecinto=="" || $descripcion==""){
      ?> <script>alert("No deje campos vacíos");</script> <?php
    }else{
      $c->actualizarCampana($rut,$nombres,$apellidos,$descripcion,$tiposangre,$nombreRecinto);
    }
  }
  elseif(isset($_POST["rutModificar"])){
    $rut = $_POST["rutModificar"];
    if($rut == ""){
      ?><script>$("#divrespuesta").html("<b>No deje campos vacíos</b>")</script><?php
    }
    $c->buscarCampanaPorRut($rut);
  }
  elseif(isset($_POST["rutSolicitud"])){
    $rutsol = $_POST["rutSolicitud"];
    $c->aceptarSolicitud($rutsol);
  }
  else if(isset($_POST["rutCancelarSolicitud"])){
    $rutsol = $_POST["rutCancelarSolicitud"];
    $c->cancelarSolicitud($rutsol);
  }
  elseif(isset($_POST["tipo"])){
    $buscarRut = $_POST["txtRut"];
    $tipo = $_POST["tipo"];
    $where = "";
    if(!empty($buscarRut) && $tipo == "tipo"){
      $where = "where rutPersona like '". $buscarRut . "%' and FK_ESTADO = 1";
      $c->buscarCampana($buscarRut, $where);
    }
    elseif(!empty($buscarRut) && $tipo == "tipo2"){
      $where = "where FK_Tipo_Sangre='". $buscarRut ."' and FK_ESTADO = 1";
      $c->buscarCampana($buscarRut, $where);
    }
  }
  elseif(isset($_POST["cargarCampana"])){
    $c->obtenerCampanas();
  }
  elseif(isset($_POST["cargarSolicitudes"])){
    $c->obtenerSolicitudes();
  }
  elseif(isset($_POST["rutObtenerDatosCampana"])){
    $rut = $_POST["rutObtenerDatosCampana"];
    $c->obtenerDatosCampana($rut);
  }
  elseif(isset($_POST["rutVerBloqueo"])){
    include("../modelo/modeloUsuario.php");
    $usuario = new Usuario();
    $rut = $_POST["rutVerBloqueo"];
    $usuario->verificarBloqueo($rut);
  }
  elseif(isset($_POST["ccurut"])){
    $rut = $_POST["ccurut"];
    $c->Obtenerlistarut($rut);
  }
  elseif(isset($_POST["campanasFin"])){
    $c->obtenerCampanasFinalizadas();
  }
  elseif(isset($_POST["rutUsuarioA"])){
    $c->setRutUsuario($_POST["rutUsuarioA"]);
    $rutusuario = $c->getRutUsuario();
    $c->setRutPersona($_POST["rutPersonaA"]);
    $rutpersona = $c->getRutPersona();
    $c->setNombresPersona($_POST["nombresPersonaA"]);
    $nombrespersona = $c->getNombresPersona();
    $c->setApellidosPersona($_POST["apellidosPersonaA"]);
    $apellidospersona = $c->getApellidosPersona();
    $c->setComentarioPersona($_POST["comentarioPersonaA"]);
    $comentariopersona = $c->getComentarioPersona();
    $c->setTiposangre($_POST["txtTiposangreA"]);
    $tiposangre = $c->getTiposangre();
    $c->setNombreCentro($_POST["nombreCentroA"]);
    $nombrecentro = $c->getNombreCentro();
    $fecha = date("Y-m-d", strtotime(date("Y-m-d").'+ 1 week'));
    $c->ingresarCampanaAdmin($rutusuario,$rutpersona,$nombrespersona,$apellidospersona,$comentariopersona,$tiposangre,$nombrecentro,$fecha);
  }

?>
