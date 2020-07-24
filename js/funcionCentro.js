window.onload = function () {
    Cargar();
}

function Cargar(){
  cargarListaEliminarCentros();
  cargarTablaCentros();
}

function Registrar()
{
  var nomC = $("#txtNombre").val();
  var dirC = $("#txtDireccion").val();
  var lat = $("#txtLatitud").val();
  var lng = $("#txtLongitud").val();
  var tipoC = $("#opcionTipo").val();
  var tel = $("#txtTelefono").val();
  var pag = $("#txtPagina").val();
    $("#respuesta").html("<img src='../img/cargando.gif'>");
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "../controlador/controladorCentros.php",
        data: "txtNombre="+nomC+"&txtDireccion="+dirC+"&txtLatitud="+lat+"&txtLongitud="+lng+"&opcionTipo="+tipoC+"&txtTelefono="+tel+"&txtPagina="+pag,
        success: function(resp){
            $('#respuesta').html(resp);
            Limpiar();
        }
    });
}

function Eliminar()
{
    var nomC =$("#opcionCentro").val();
    $("#respuesta2").html("<img src='../img/cargando.gif'>");
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "../controlador/controladorCentros.php",
        data: "opcionCentro="+nomC,
        success: function(resp){
            $('#respuesta2').html(resp);
            Limpiar();
            Cargar();
        }
    });
}

function Limpiar()
{
    $("#txtNombre").val("");
    $("#txtDireccion").val("");
    $("#txtLatitud").val("");
    $("#txtLongitud").val("");
    $("#opcionTipo").val("");
    $("#txtTelefono").val("");
    $("#txtPagina").val("");
}

function cargarListaEliminarCentros(){
  var listarEliminar = "listarEliminar";
  $.ajax({
      type: "POST",
      dataType: 'html',
      url: "../controlador/controladorCentros.php",
      data: "listarEliminar="+listarEliminar,
      success: function(resp){
        $("#opcionCentro").html(resp);
      }
  });
}

function cargarTablaCentros(){
  var cargarCentros = "cargarCentros";
  $.ajax({
      type: "POST",
      dataType: 'html',
      url: "../controlador/controladorCentros.php",
      data: "cargarCentros="+cargarCentros,
      success: function(resp){
        $("#tablaCentros").html(resp);
      }
  });
}

  function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: new google.maps.LatLng(-33.4488897, -70.6692655),
    zoom: 11
  });
  var infoWindow = new google.maps.InfoWindow;

    downloadUrl('../controlador/controladorMostrarCentros.php', function(data) {
      var xml = data.responseXML;
      var centros = xml.documentElement.getElementsByTagName('centro');
      Array.prototype.forEach.call(centros, function(centroElem) {
        var tipo = centroElem.getAttribute('tipo');
        var id = centroElem.getAttribute('id');
        var nombre = centroElem.getAttribute('nombre');
        var direccion = centroElem.getAttribute('direccion');
        var point = new google.maps.LatLng(
            parseFloat(centroElem.getAttribute('lat')),
            parseFloat(centroElem.getAttribute('lng')));

        var infowincontent = document.createElement('div');
        var strong = document.createElement('strong');
        strong.textContent = nombre
        infowincontent.appendChild(strong);
        infowincontent.appendChild(document.createElement('br'));

        var text = document.createElement('text');
        text.textContent = direccion
        infowincontent.appendChild(text);
        var centro = new google.maps.Marker({
          map: map,
          position: point
        });
        centro.addListener('click', function() {
          infoWindow.setContent(infowincontent);
          infoWindow.open(map, centro);
        });
      });
    });
  }



  function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      request.onreadystatechange = doNothing;
      callback(request, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
  }

  function doNothing() {}
