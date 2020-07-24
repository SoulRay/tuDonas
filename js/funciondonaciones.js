window.onload = function () {

    var once = $("#once").val();;

    CargarDonaciones();
    CargarUsuario();
    CargarCampanasUsuario();
    //CargarFechas();

    function CargarDonaciones(){
        var rut = $("#txtrut").val();
        var cargarDonacion = "cargarDonacion";
        $.ajax({
          type: "POST",
          url: "../controlador/controladorDonaciones.php",
          data: "cargarDonacion="+cargarDonacion+"&rut="+rut,
          success: function(resp){
            $('#tabladonaciones').html(resp);
          }
        });
    }
    function CargarUsuario(){
        var rut = $("#txtrut").val();
        var pass = $("#pass").val();
        $.ajax({
          type: "POST",
          url: "../controlador/controladorUsuario.php",
          data: "cdrut="+rut+"&cdpass="+pass+"&once="+once,
          success: function(resp){
            $('#divmd').html(resp);
          }
        });
    }

    function CargarCampanasUsuario(){
        var rut = $("#txtrut").val();
        $.ajax({
            type: "POST",
            url: "../controlador/controladorCampana.php",
            data: "ccurut="+rut,
            success: function(resp){
              $('#tablaestadocampaña').html(resp);
            }
          });
    }

    /*function CargarFechas(){
        var rut = $("#txtrut").val();
        var genero = $("#txtgenero").val();
        $.ajax({
            type: "POST",
            url: "../controlador/controladorDonaciones.php",
            data: "cfrut="+rut+"&cfgen="+genero,
            success: function(resp){
              $('#divcartatiemporestante').html(resp);
            }
          });


    }*/
}

$(document).on('click', "button[name='btneliminar']", function() {
    var iddonacion = $(this).val();
    //var iddonacion = $(this).text();
    var rut = $("#txtrut").val();
        $.ajax({
            type: "POST",
            datatype: "html",
            url: "../controlador/controladorDonaciones.php",
            data: "idDon="+iddonacion+"&vrut="+rut,
            success: function(resp){
                if(resp){
                    $("#tabladonaciones").html(resp);
                    window.location.href ="bienvenido.php";
                }
            },
            error: function(){
                alert("Error en Ajax");
            }
        });

});

$(document).on('click', "button[name='btnActualizarDatos']", function(){
 
    var rut = $("#txtrut").val();
    var nombre2 = $("#txtNombre2").val();
    var apellido2 = $("#txtApellidos2").val();
    var txtCorreo2 = $("#txtCorreo2").val();
    var txtPassword2 = $("#txtPassword2").val();
    var txttiposangre2 = $("#opcionSangre2").val();
    if(nombre2 == "" || apellido2== "" || txtCorreo2== "" || txtPassword2== "" || txttiposangre2== ""){
        alert("No deje campos vacios!");
    }
    else{
        $.ajax({
            type: "POST",
            datatype: "html",
            url: "../controlador/controladorUsuario.php",
            data: "P_rut="+rut+"&P_nombre2="+nombre2+"&P_apellido2="+apellido2+"&P_correo2="+txtCorreo2+"&P_pass2="+txtPassword2+"&P_tiposangre2="+txttiposangre2,
            success: function(resp){
                if(resp){

                    $("#rjsDonaciones").html(resp);
                    //location.href("bienvenido.php");
                }
            },
            error: function(){
                alert("Error en Ajax");
            }
        });
    }
    
});



/*$("button[name='btnActualizarDatos']").click(function(){
        var rut = $("#txtrut").val();
        var nombre2 = $("#txtNombre2").val();
        var apellido2 = $("#txtApellidos2").val();
        var txtCorreo2 = $("#txtCorreo2").val();
        var txtPassword2 = $("#txtPassword2").val();
        var actdatos = "si";
        if(nombre2 == "" || apellido2== "" || txtCorreo2== "" || txtPassword2== "" ){
            alert("No deje campos vacios!");

        }
        else{

            $.ajax({
                type: "POST",
                datatype: "html",
                url: "../controlador/controladorUsuario.php",
                data: "P_rut="+rut+"&P_nombre2="+nombre2+"&P_apellido2="+apellido2+"&P_correo2="+txtCorreo2+"&P_pass2="+txtPassword2+"&actdatos="+actdatos,
                success: function(resp){
                    if(resp){
                        $("#rjsDonaciones").html(resp);
                    }
                },
                error: function(){
                    alert("Error en Ajax");
                }
            });


        }*/



$(document).ready(function(){

    $("button[name='btndonaciones']").click(function(){
        var fechaDonacion = $("#txtFechaDonacion").val();
        var direccion = $("#txtDireccion").val();
        var FK_RutDonante = $("#txtRutDonante").val();
        var FK_TipoLugar = $("#stipolugar").val();
        var donacionactual = $("#txtFechaDonacion").val();
        var genero = $("#txtgenero").val();
        if(fechaDonacion == "" || direccion== "" || FK_RutDonante== "" || FK_TipoLugar== "" ){
            alert("No deje campos vacios!");
        }
        else{
            $.ajax({
                type: "POST",
                datatype: "html",
                url: "../controlador/controladorDonaciones.php",
                data: "txtFechaDonacion="+fechaDonacion+"&txtDireccion="+direccion+"&FK_RutDonante="+FK_RutDonante+"&FK_TipoLugar="+FK_TipoLugar+"&fdonacionact="+donacionactual+"&genero="+genero,
                success: function(resp){
                    if(resp){
                        $("#rjsDonaciones").html(resp);
                    }
                },
                error: function(){
                    alert("Error en Ajax");
                }
            });
        }
    });

    $("button[name='btncancelar']").click(function(){
        $("#txtDireccion").val("");
        $("#txtFechaDonacion").val("");
        $("#modal99").modal("close");
    });


});
