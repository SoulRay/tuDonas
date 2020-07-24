
$(document).ready(function(){
  $("button[name=boton]").click(function(){
    switch ($(this).attr("value")) {
      case 'agregar':
        var title = $("#txtTitulo2").val();
        var description = $("#txtDescripcion2").val();
        var start = $("#txtFecha2").val()+ " " +$("#txtHora2").val();
        var color = $("#txtColor2").val();
        var textColor = "white";
        var end = $("#txtFechaTermino2").val()+ " " +$("#txtHoraTermino2").val();
        var lugar = $("#txtLugar2").val();
        var rut = $("#rutHidd").val();
        if($("#txtHora2").val() < "09:00"){
          alert("El inicio del evento debe comenzar mínimo a las 09:00");
        }
        else if($("#txtHoraTermino2").val() > "19:00:00"){
          alert("El termino del evento debe culminar como máximo a las 19:00");
        }
        else
        {
          if(start > end){
            alert("Error en la fecha o en la hora");
          }
          else{
            $.ajax({
            type: "POST",
            dataType: "html",
            url: "../controlador/controladorEvento.php",
            data: "title="+title+"&description="+description+"&start="+start+"&color="+color+"&textColor="+textColor+"&end="+end+"&lugarEvento="+lugar+"&rutHidd="+rut,
            success: function(resp){
              if(resp){
                $("#respuestaEvento").html(resp);
                $("#modal8").modal("close");
                $("#calendario").fullCalendar('refetchEvents');
              }
            },
            error: function(){
              alert("Error");
              }
            });
          }
        }
        break;
      case 'modificar':
        var id =  $("#txtIdEvento").val();
        var title = $("#txtTitulo").val();
        var description = $("#txtDescripcion").val();
        var start = $("#txtFecha").val()+ " " +$("#txtHora").val();
        var color = $("#txtColor").val();
        var textColor = "white";
        var end = $("#txtFechaTermino").val()+ " " +$("#txtHoraTermino").val()
        var lugarEvento = $("#txtLugar").val();
        if($("#txtHora").val() < "09:00"){
          alert("El inicio del evento debe comenzar mínimo a las 09:00")
        }
        else if($("#txtHoraTermino").val() > "19:00:00"){
          alert("El termino del evento debe culminar como máximo a las 19:00");
        }
        else{
          if(start > end){
            alert("Error, la fecha o la hora de inicio es mayor que la de termino del evento");
          }
          else if(start == end){
            alert("No puede terminar un evento a la misma hora");
          }
          else{
            $.ajax({
              type: "POST",
              dataType: "html",
              url: "../controlador/controladorEvento.php",
              data: "id="+id+"&title="+title+"&description="+description+"&start="+start+"&color="+color+"&textColor="+textColor+"&end="+end+"&lugar="+lugarEvento,
              success: function(resp){
                if(resp){
                  $("#respuestaEvento").html(resp);
                  $("#modal9").modal("close");
                  $("#calendario").fullCalendar('refetchEvents');
                }
              },
              error: function(){
                alert("Error");
              }
            });
          }
        }
        break;
      case 'borrar':
        var title = $("#txtTitulo").val();
        var id =  $("#txtIdEvento").val();
        if(confirm("Desea eliminar el evento '"+title+"'?")){
          $.ajax({
            type: "POST",
            dataType: "html",
            url: "../controlador/controladorEvento.php",
            data: "idEvento="+id,
            success: function(resp){
              if(resp){
                $("#respuestaEvento").html(resp);
                $("#modal9").modal("close");
                $("#calendario").fullCalendar('refetchEvents');
              }
            },
            error: function(){
              alert("Error");
              }
            });
        }
        else{
          alert("Cancelado");
        }

        break;
      case 'cancelar':
        $("#txtTitulo2").val("");
        $("#txtDescripcion2").val("");
        $("#txtFechaTermino2").val("");
        $("#txtColor2").val("");
        $("#txtLugar2").val("");
        $("#modal8").modal("close");
        break;
      default:
        break;

      }
  });
});
