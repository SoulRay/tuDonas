window.onload = function () {
  cargarPerfil();
  cargarUserCorreos();
}

function cargarPerfil(){
  var rutVerPerfil = $("#rutusuarioB").text();
  $.ajax({
    type: "POST",
    url: "../controlador/controladorUsuario.php",
    data: "rutPerfil="+rutVerPerfil,
    success: function(resp){
      $("#datosUsuario").html(resp);
    }
  });
}

function cargarUserCorreos(){
  var verUserCorreos = "verUserCorreos";
  $.ajax({
    type: "POST",
    url: "../controlador/controladorUsuario.php",
    data: "verUserCorreos="+verUserCorreos,
    success: function(resp){
      $("#tablaCorreos").html(resp);
    }
  });
}
function obtenerBloqueo(){
  var rut = $("#txtRutBuscar").val();
  $.ajax({
    type: "POST",
    url: "../controlador/controladorUsuario.php",
    data: "rutVerBloqueo="+rut,
    success: function(resp){
      if(resp == 0){
        document.getElementById("contenedorMostraBloqueo").style.display = "none";
      }
      else if(resp === "Bloqueo terminado"){
        alert(resp);
      }
      else{
        $("#textoBloqueo").text(resp);
        document.getElementById("contenedorMostraBloqueo").style.display = "block";
      }
    }
  });
}
function verFicha(){
  var rutFicha = $("#txtRutBuscar").val();
  $.ajax({
    type: "POST",
    url: "../controlador/controladorUsuario.php",
    data: "rutFicha2="+rutFicha,
    success: function(resp){
      $("#modalMostrarFicha").modal("open");
      $("#modalMostrarFicha").html(resp);
    }
  });
}
function ingresarFicha(){
  var rut = $("#txtRutBuscar").val();
  if(confirm("El usuario no tiene ficha, ¿Desea agregar una?"))
  {
    window.location.href = "vistaAgregarFicha.php?id="+rut+"";
  }else{
    return false;
  }
}
function ingresarBloqueo(){
  if(confirm("¿Está seguro que desea bloquear a este usuario?")){
    var rut = $("#txtRutBuscar").val();
    $("#txtIdBloqueo").val(rut);
    $("#modalBloqueo").modal("open");
  }
}
$(document).on('click', '#btnBloquear', function(){
  var rut = $("#txtRutBuscar").val();
  $("#txtIdBloqueo").val(rut);
  $("#modalBloqueo").modal("open");
});

$(document).ready(function(){

  $("#divEnviarCorreos").click(function(){
    var enviarCorreos = "enviarCorreos";
    $.ajax({
      type: "POST",
      url: "../controlador/controladorUsuario.php",
      data: "enviarCorreos="+enviarCorreos,
      success: function(resp){
        $("#respuestaEnviarCorreo").html(resp);
      }
    });
  });
    /*$("#rutFicha").val($("#idBuscarUser").text());
    $("#modalFicha").modal("open");*/

  $("#formBloqueo").on('submit', (function(e){
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "../controlador/controladorUsuario.php",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      success: function(resp){
        $("#respuestaBloqueo").html(resp);
      }
    });
  }));

  $("#btnBuscarUser").click(function(){
    var rut = $("#txtRutBuscar").val();
    if(rut == ""){
      alert("No deje el campo vacío");
    }
    else{
      $.ajax({
        type: "POST",
        url: "../controlador/controladorUsuario.php",
        data: "rutBuscar="+rut,
        success: function(resp){
          obtenerBloqueo();
          $("#tablaBuscarUser").html(resp);
        }
      });
    }
  });

  $("#formFicha2").on('submit', (function(e){
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "../controlador/controladorUsuario.php",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      success: function(resp){
        $("#respuestaFicha").html(resp);
      }
    });
  }));

});
