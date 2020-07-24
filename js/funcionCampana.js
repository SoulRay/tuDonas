
window.onload = function () {
    Cargar();
}
function Registrar()
{
  var rutu = $("#rutUsuarioC").val();
  var rutp = $("#rutPersonaC").val();
  var nom = $("#nombresPersonaC").val();
  var apell = $("#apellidosPersonaC").val();
  var tipos = $("#txtTiposangreC").val();
  var nomc = $("#nombreCentroC").val();
  var comen = $("#comentarioPersonaC").val();
  if(Fn.validaRut(rutp)){
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "../controlador/controladorCampana.php",
        data: "rutUsuarioC="+rutu+"&rutPersonaC="+rutp+"&nombresPersonaC="+nom+"&apellidosPersonaC="+apell+"&txtTiposangreC="+tipos+"&nombreCentroC="+nomc+"&comentarioPersonaC="+comen,
        success: function(resp){
            $('#respuesta').html(resp);
            Limpiar();
        }
    });
  }
  $("#respuesta").html("Rut incorrecto");
}
function RegistrarAdmin()
{
  var rutu = $("#rutUsuarioA").val();
  var rutp = $("#rutPersonaA").val();
  var nom = $("#nombresPersonaA").val();
  var apell = $("#apellidosPersonaA").val();
  var tipos = $("#txtTiposangreA").val();
  var nomc = $("#nombreCentroA").val();
  var comen = $("#comentarioPersonaA").val();
  if(Fn.validaRut(rutp)){
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "../controlador/controladorCampana.php",
        data: "rutUsuarioA="+rutu+"&rutPersonaA="+rutp+"&nombresPersonaA="+nom+"&apellidosPersonaA="+apell+"&txtTiposangreA="+tipos+"&nombreCentroA="+nomc+"&comentarioPersonaA="+comen,
        success: function(resp){
            $('#respuesta').html(resp);
            Limpiar();
            Cargar();
        }
    });
  }
  $("#respuesta").html("Rut incorrecto");
}
function Cargar()
{
    CargarCampana();
    CargarSolicitudes();
    CargarBloqueo();
    verNotificaciones();
    cargarDatosModificar();
}
function CargarCampana(){
  var cargarCampana = "cargarCampana";
  $.ajax({
    type: "POST",
    url: "../controlador/controladorCampana.php",
    data: "cargarCampana="+cargarCampana,
    success: function(resp){
      $('#divCampanas').html(resp);
    }
  });
}
function CargarBloqueo(){
  var rutVerBloqueo = $("#rutUsuarioC").val();
  $.ajax({
    type: "POST",
    url: "../controlador/controladorCampana.php",
    data: "rutVerBloqueo="+rutVerBloqueo,
    success: function(resp){
      if(resp == 0){
        $('#divSolicitar').html("<a id='txtCrearcamp' class='modal-trigger col s6 l3' href='#modal3'>Solicitar campaña</a>");
      }
      else{
        $('#divSolicitar').html("<div id='crearBloqueado'>Estás bloqueado, no puedes solicitar campañas</div>");
      }

    }
  });
}
function CargarSolicitudes(){
  var cargarSolicitudes = "cargarSolicitudes";
  $.ajax({
    type: "POST",
    url: "../controlador/controladorCampana.php",
    data: "cargarSolicitudes="+cargarSolicitudes,
    success: function(resp){
      $('#tablaSolicitudes').html(resp);
    }
  });
}
function Limpiar()
{
  $("#rutPersonaC").val("");
  $("#nombresPersonaC").val("");
  $("#apellidosPersonaC").val("");
  $("#txtTiposangreC").val("");
  $("#txtFactorrhC").val("");
  $("#direccionLugarC").val("");
  $("#nombreCentroC").val("");
  $("#comentarioPersonaC").val("");
  $("#txtEliminarCampana").val("");
  $("#txtRut").val("");
}

function Eliminar()
{
  var rutEliminar = $("#txtEliminarCampana").val();
  $("#respuestaEliminar").html("<img src='../img/cargando.gif'>");
  $.ajax({
      type: "POST",
      dataType: 'html',
      url: "../controlador/controladorCampana.php",
      data: "rutEliminarCampana="+rutEliminar,
      success: function(resp){
          $('#respuestaEliminar').html(resp);
          Limpiar();
          Cargar();
      }
  });
}

function Actualizar()
{
  var rutp = $("#txtRut2").val();
  var nom = $("#txtNombres").val();
  var apell = $("#txtApellidos").val();
  var tipos = $("#txtTiposangre").val();
  var direc = $("#txtDireccion").val();
  var nomc = $("#txtNombreRecinto").val();
  var comen = $("#txtDescripcion").val();
  $("#divrespuesta").html("<img src='../img/cargando.gif'>");
  $.ajax({
    type: "POST",
    dataType: "html",
    url: "../controlador/controladorCampana.php",
    data: "rutPaciente="+rutp+"&txtNombres="+nom+"&txtApellidos="+apell+"&txtTiposangre="+tipos+"&txtDireccion="+direc+"&txtNombreRecinto="+nomc+"&txtDescripcion="+comen,
    success: function(resp){
      $("#mostrarRespuesta").html(resp);
    }
  });
}
function aceptarSolicitud(){
  var rutSol = $("#btnAceptarSolicitud").val();
  $.ajax({
    type: "POST",
    dataType: "html",
    url: "../controlador/controladorCampana.php",
    data: "rutSolicitud="+rutSol,
    success: function(resp){
      $("#tablaSolicitudes").html(resp);
      Cargar();
    }
  });

}

function cancelarSolicitud(){
  var rutSol = $("#btnCancelarSolicitud").val();
  $.ajax({
    type: "POST",
    dataType: "html",
    url: "../controlador/controladorCampana.php",
    data: "rutCancelarSolicitud="+rutSol,
    success: function(resp){
      $("#tablaSolicitudes").html(resp);
      Cargar();
    }
  });
}

function cargarDatosModificar(){
  var rut = $("#txtRut2").val();
  $.ajax({
    type: "POST",
    url: "../controlador/controladorCampana.php",
    data: "rutObtenerDatosCampana="+rut,
    success: function(resp){
      $("#divInputsModificar").html(resp);
    }
  });
}

function verNotificaciones(){
  var sesion = $("#valorSesion2").val();
  if(sesion == "Administrador"){
    $.ajax({
      type: "POST",
      url: "../controlador/controladorNotificaciones.php",
      data: "sesion="+sesion,
      success: function(resp){
        $("#labelNotificacion").text(resp);
        if(resp == 0){
          document.getElementById("labelNotificacion").style.display = "none";
          document.getElementById("labelNotificacion2").style.display = "none";
          $("#textoMensajes").html("<span class='grey-text'>Aún no hay nada, vuelve más tarde</span>");
        }
        else{
          $("#textoMensajes").html("<span class='grey-text'>Tienes "+resp+" solicitud(es) de campaña, Revísalas <span class='blue-text' id='direcSolic'>aquí</span></span>");
          $("#txtCrearcamp").html("<i class='material-icons'>thumb_up</i>");
          $("#labelNotificacion2").html(resp);
          document.getElementById("txtCrearcamp").style.background = "rgba(0,0,0,0)";
          document.getElementById("txtCrearcamp").style.background = "rgba(0,0,0,0)";
          document.getElementById("txtCrearcamp").style.color = "black";
          document.getElementById("txtCrearcamp").style.boxShadow = "inset 0 0 0 3px #0d47a1";
        }
      }
    });
  }else{
    document.getElementById("iconNot").style.display = "none";
    document.getElementById("labelNotificacion").style.display = "none";
    document.getElementById("labelNotificacion2").style.display = "none";
  }
}

$(document).ready(function(){
  $("#direcSolic").click(function(){
    document.location.href = "campanas.php";
  });

  $("#txtModificarCampana").blur(function(){
    var rutpaciente = $("#txtModificarCampana").val();
    //alert(rutpaciente);
    $("#divrespuesta").html("<img src='../img/cargando.gif'>");
      $.ajax({
        type: "POST",
        dataType: "html",
        url: "../controlador/controladorCampana.php",
        data: "rutModificar="+rutpaciente,
        success: function(resp){
          $("#divrespuesta").html(resp);
        }
      });
  });


  $("#txtRut").keyup(function(e){
    var rut = $(this).val();
    var tipo = "tipo";
      $.ajax({
      type: "POST",
      dataType: 'html',
      url: "../controlador/controladorCampana.php",
      data: "txtRut="+rut+"&tipo="+tipo,
      success: function(resp){
        $('#divCampanas').html(resp);
      }
      });
  });


  $("#opcionSangre").change(function(){
    //var opcion = $("#opcionSangre option:selected").text();
    var opcion = $("#opcionSangre").val();
    var tipo = "tipo2";
    $.ajax({
      type: "POST",
      dataType: 'html',
      url: "../controlador/controladorCampana.php",
      data: "txtRut="+opcion+"&tipo="+tipo,
      success: function(resp){
        $('#divCampanas').html(resp);
      }
    });
  });

  $("#btnCampanasAnteriores").click(function(){
    var campanasFin = "campanasFin";
    $.ajax({
      type: "POST",
      url: "../controlador/controladorCampana.php",
      data: "campanasFin="+campanasFin,
      success: function(resp){
        $("#divCampanas").html(resp);
      }
    });
  });

  /*$("#btnAgregarCampanaAdmin").click(function(){
    alert("Agregar campañas");
  });*/

});
