window.onload = function () {
  mostrarNoticias();
}

function mostrarNoticias(){
  var mostrarNoticia = "mostrarNoticia";
  $.ajax({
    type: "POST",
    url: "../controlador/controladorNoticias.php",
    data: "mostrarNoticias="+mostrarNoticia,
    success: function(resp){
      $("#divNoticias").html(resp);
    }
  });
}

function mostrarModalAgregar(){
  $("#modalAgregarNoticia").modal("open");
}
function mostrarModalModificar(){
  var idModificarNoticia = $("#btnActualizarNoticia").attr('value');
  if(idModificarNoticia === ""){
    alert("Seleccione una noticia antes de modificar");
  }
  else{
    var ruta = $("#imgNoticia").attr('src');
    $.ajax({
      type: "POST",
      url: "../controlador/controladorNoticias.php",
      data: "mostrarDatosRuta="+ruta,
      success: function(resp){
        $("#formModificarNoticia").html(resp);
        $("#modalModificarNoticia").modal("open");
      }
    });
  }
}

function eliminarNoticia(){
  var idNoticia = $("#btnEliminarNoticia").attr('value');
  if(idNoticia === ""){
    alert("Seleccione una noticia antes de eliminar");
  }
  else{
    var ruta = $("#imgNoticia").attr('src');
    var titulo = $("#noticia1").text();
    if(confirm("¿Desea borrar la noticia: "+titulo+"?")){
      $.ajax({
        type: "POST",
        url: "../controlador/controladorNoticias.php",
        data: "idEliminarNoticia="+idNoticia+"&rutaImagen="+ruta,
        success: function(resp){
          $("#divMensajeNoticia").html(resp);
          mostrarNoticias();
        }
      });
    }
  }
}
function checkearImagen(){
  if(document.getElementById("checkImagen").checked == true){
    document.getElementById("divFileInput").style.display = "block";
    $("#imagenNoticia").prop("required", true);
  }
  else{
    document.getElementById("divFileInput").style.display = "none";
    $("#imagenNoticia").prop("required", false);
    $('#imagenNoticia2').val("");
    $('#imagenNoticia').val("");
  }
}

$(document).ready(function(){
  $("#formAgregarNoticia").on('submit', (function(e){
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "../controlador/controladorNoticias.php",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      success: function(resp){
        $("#respuestaAgregar").html(resp);
        $("#modalAgregarNoticia").modal("close");
        mostrarNoticias();
      }
    });
  }));

  $("#formModificarNoticia").on('submit', (function(e){
    e.preventDefault();
    var ruta = $("#imgNoticia").attr('src');
    var formData = new FormData((this));
    formData.append('ruta', ruta);
    $.ajax({
      type: "POST",
      url: "../controlador/controladorNoticias.php",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
      success: function(resp){
        $("#respuestaModificar").html(resp);
        mostrarNoticias();
        /*$("#modalModificarNoticia").modal("close");
        mostrarNoticias();*/
      }
    });
  }));
  //Mostrar noticia completa
  $('body').on('click',"img[id='imgNoticia']",function(){
    var imagen = $(this).attr('src');
    $.ajax({
      type: "POST",
      url: "../controlador/controladorNoticias.php",
      data: "verNoticia="+imagen,
      success: function(resp){
        $("#divNoticias").html(resp);
      }
    });
  });
  $("#txtBuscarNoticia").keyup(function(){
    var textoBuscar = $("#txtBuscarNoticia").val();
    $.ajax({
      type: "POST",
      url: "../controlador/controladorNoticias.php",
      data: "textoBuscar="+textoBuscar,
      success: function(resp){
        $("#divNoticias").html(resp);
      }
    });
  });
  $("#checkImagen").change(function(){
    alert("aa");
  });

});
