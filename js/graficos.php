<?php
require("../modelo/conexion2.php");
//Query Count Usuario por genero
$query1 = "SELECT (SELECT COUNT(rutUsuario)  FROM usuario WHERE genero = 'Mujer') as `countMujer`,
(SELECT COUNT(rutUsuario) FROM usuario WHERE genero='Hombre') as `countHombre`";
$resultado1 = mysqli_query($conexion,$query1);
$fila1 = mysqli_fetch_array($resultado1, MYSQLI_BOTH);

//Query count Tipo de sangre por Usuarios
$query2 = "SELECT (SELECT COUNT(rutUsuario) FROM usuario WHERE FK_TipoSangre = 1) as `countANegativo`,
(SELECT COUNT(rutUsuario) FROM usuario WHERE FK_TipoSangre = 2) as `countAPositivo`,
(SELECT COUNT(rutUsuario) FROM usuario WHERE FK_TipoSangre = 3) as `countBNegativo`,
(SELECT COUNT(rutUsuario) FROM usuario WHERE FK_TipoSangre = 4) as `countBPositivo`,
(SELECT COUNT(rutUsuario) FROM usuario WHERE FK_TipoSangre = 5) as `countABNegativo`,
(SELECT COUNT(rutUsuario) FROM usuario WHERE FK_TipoSangre = 6) as `countABPositivo`,
(SELECT COUNT(rutUsuario) FROM usuario WHERE FK_TipoSangre = 7) as `countONegativo`,
(SELECT COUNT(rutUsuario) FROM usuario WHERE FK_TipoSangre = 8) as `countOPositivo`";
$resultado2 = mysqli_query($conexion,$query2);
$fila2 = mysqli_fetch_array($resultado2, MYSQLI_BOTH);

//Query campañas por estado
$query3 = "SELECT (SELECT COUNT(idCampana) FROM campana WHERE FK_Estado = 0) as `campPendiente`,
(SELECT COUNT(idCampana) FROM campana WHERE FK_Estado = 1) as `campAprobada`,
(SELECT COUNT(idCampana) FROM campana WHERE FK_Estado = 2) as `campRechazada`,
(SELECT COUNT(idCampana) FROM campana WHERE FK_Estado = 3) as `campFinalizada`";
$resultado3 = mysqli_query($conexion,$query3);
$fila3 = mysqli_fetch_array($resultado3, MYSQLI_BOTH);

echo "
<script>
Highcharts.chart('container', {
  chart: {
      type: 'column'
  },
  title: {
      text: 'Usuarios por tipo de sangre'
  },
  xAxis: {
      categories: ['<b>Tipo de sangre</b>']
  },
  yAxis: {
      title: {
          text: '<b>Cantidad de usuarios</b>'
      }
  },
  series: [{
      name: 'Tipo A Rh-',
      data: [$fila2[countANegativo]],
      color: 'grey'
  }, {
      name: 'Tipo A Rh+',
      data: [$fila2[countAPositivo]],
      color: '#f4c007'
  }, {
      name: 'Tipo B Rh-',
      data: [$fila2[countBNegativo]],
      color: '#2435dd'
  }, {
    name: 'Tipo B Rh+',
    data: [$fila2[countBPositivo]],
    color: '#f72020'
  },{
      name: 'Tipo AB Rh-',
      data: [$fila2[countABNegativo]],
      color: '#0e8f1e'
  }, {
      name: 'Tipo A Rh+',
      data: [$fila2[countABPositivo]],
      color: '#682ccb'
  }, {
      name: 'Tipo O Rh-',
      data: [$fila2[countONegativo]],
      color: '#ff5208'
  }, {
    name: 'Tipo O Rh+',
    data: [$fila2[countOPositivo]],
    color: '#0a83b0'
  }]
});

Highcharts.chart('container2', {
  chart: {
      type: 'pie'
  },
  title: {
      text: 'Usuarios por genero'
  },
  plotOptions: {
    pie: {
      allowPointSelect: false,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
      data: [{
        name: 'Mujer',
        y: $fila1[countMujer],
        color: 'grey'
      },
      {
        name:'Hombre',
        y: $fila1[countHombre],
        color: '#D8DB8C'
      },]
  }]
});

Highcharts.chart('container3', {
  chart: {
      type: 'column'
  },
  title: {
      text: 'Campañas de donación'
  },
  xAxis: {
      categories: ['<b>Tipos de campañas</b>']
  },
  yAxis: {
      title: {
          text: '<b>Cantidad de campañas</b>'
      }
  },
  series: [{
      name: 'Campañas pendientes',
      data: [$fila3[campPendiente]],
      color: '#282925'
  }, {
      name: 'Campañas aprobadas',
      data: [$fila3[campAprobada]],
      color: '#167339'
  }, {
      name: 'Campañas rechazadas',
      data: [$fila3[campRechazada]],
      color: '#f72020'
  }, {
    name: 'Campañas finalizadas',
    data: [$fila3[campFinalizada]],
    color: '#1d2ad5'
  }]
});
</script>";
?>
