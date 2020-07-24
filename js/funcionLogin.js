$(document).ready(function(){
  $("#btnEnviar2").click(function(){
    var rut = $("#rutUsuario2").val();
    var password = $("#passUsuario2").val();
    $.ajax({
      type: "POST",
      url: "../controlador/controladorUsuario.php",
      data: "rutUsuario2="+rut+"&passUsuario2="+password,
      success: function(resp){
        $("#respuestaLogin").html(resp);
      }

    });
  });
  $("#formularioRegistro").on('submit', (function(e){
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "../controlador/controladorUsuario.php",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      success: function(resp){
        $("#respuestaRegistro").html(resp);
      }
    });
  }));
});
