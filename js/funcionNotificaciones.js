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
  $(document).ready(function(){
    $("#direcSolic").click(function(){
      document.location.href = "campanas.php";
    });
  });
}else{
  document.getElementById("iconNot").style.display = "none";
  document.getElementById("labelNotificacion").style.display = "none";
  document.getElementById("labelNotificacion2").style.display = "none";
}
