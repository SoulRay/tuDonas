$(document).ready(function(){
  $('.sidenav').sidenav();
  $('.collapsible').collapsible();
  $('select').formSelect();
  $('.tooltipped').tooltip(
    {
      margin: 5,
      outDuration: 0,
      transitionMovement: 0
    }
  );
  $('.carousel.carousel-slider').carousel({
    fullWidth: true,
    duration: 200,
    indicators: true,
  });
  $('.slider').slider(
    {
      interval: 5000,
      height: 700,
      fullWidth: true

    }
  );
  $(".dropdown-trigger").dropdown(
    {
      hover: false,
      coverTrigger: false,
      constrainWidth: false
    }
  );
  $('.modal').modal();
  $('input#input_text, textarea#textarea2').characterCounter();
  $('select').formSelect();
  $('.fixed-action-btn').floatingActionButton({
    direction: "right",
    hoverEnabled: false
  });
  $('.fixed-action-btn').floatingActionButton('open');
  $('.datapicker').appendTo('body');
  $('.datepicker').datepicker(
    {
      format: "yyyy-m-dd"
    }
  );
  $('#calendario').fullCalendar({

      header:
      {
        left: 'today prev,next',
        center: 'title',
        right: 'month, agendaWeek, agendaDay'
      },

      /*customButtons:{
        btnAgregar:{
          text: 'Agregar colecta',
          click:function(){
            alert("Agregue colecta");
          }
        }
      },*/

      dayClick:function(date,jsEvent,view){
        var sesion = document.getElementById("valorSesion").value;
        if(sesion == "Administrador"){
          if(confirm("¿Desea ingresar un evento para la fecha: "+date.format("DD MMMM Y"))){
            $("#txtFecha2").val(date.format());
            $("#modal8").modal('open');
            }
          else{}
          }
        else{}

      },

      events: 'http://localhost/tudonas/controlador/controladorObtenerEventos.php',
      slotLabelFormat: [
        "HH:mm"
      ],
      minTime: "09:00:00",
      maxTime: "19:00:00" ,

      eventClick:function(calEvent, jsEvent, view){
        $("#txtIdEvento").val(calEvent.id);
        $("#tituloModal").html(calEvent.title);
        $("#txtDescripcion").val(calEvent.description);
        $("#txtTitulo").val(calEvent.title);
        $("#txtColor").val(calEvent.color);
        $("#txtLugar").val(calEvent.lugarEvento);

        FechaHora = calEvent.start._i.split(" ");
        $("#txtFecha").val(FechaHora[0]);
        $("#txtHora").val(FechaHora[1]);

        FechaHora2 = calEvent.end._i.split(" ");
        $("#txtFechaTermino").val(FechaHora2[0]);
        $("#txtHoraTermino").val(FechaHora2[1]);

        $("#modal9").modal("open");
        var sesion = document.getElementById("valorSesion").value;
        if(sesion != "Administrador"){
          $("#txtDescripcion").prop('readonly', true);
          $("#txtTitulo").prop('readonly', true);
          $("#txtColor").prop('disabled', true);
          $("#txtLugar").prop('readonly', true);
          $("#txtFecha").prop('readonly', true);
          $("#txtHora").prop('readonly', true);
          $("#txtFechaTermino").prop('readonly', true);
          $("#txtHoraTermino").prop('readonly', true);
          document.getElementById('btnEliminarEvento').style.display="none";
          document.getElementById('btnModificarEvento').style.display="none";
        }
      }
    });
    $('.input-field label').addClass('active');
    $('.scrollspy').scrollSpy();

});
