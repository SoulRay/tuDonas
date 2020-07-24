<?php
  class Campana
  {
    private $rutUsuario;
    private $rutPersona;
    private $nombresPersona;
    private $apellidosPersona;
    private $comentarioPersona;
    private $tiposangre;
    private $nombreCentro;

    public function getRutUsuario()
    {
		    return $this->rutUsuario;
	  }

  	public function setRutUsuario($rutUsuario)
    {
  		$this->rutUsuario = $rutUsuario;
  	}

  	public function getRutPersona()
    {
  		return $this->rutPersona;
  	}

  	public function setRutPersona($rutPersona)
    {
  		$this->rutPersona = $rutPersona;
  	}

  	public function getNombresPersona()
    {
  		return $this->nombresPersona;
  	}

  	public function setNombresPersona($nombresPersona)
    {
  		$this->nombresPersona = $nombresPersona;
  	}

  	public function getApellidosPersona()
    {
  		return $this->apellidosPersona;
  	}

  	public function setApellidosPersona($apellidosPersona)
    {
  		$this->apellidosPersona = $apellidosPersona;
  	}

  	public function getComentarioPersona()
    {
  		return $this->comentarioPersona;
  	}

  	public function setComentarioPersona($comentarioPersona)
    {
  		$this->comentarioPersona = $comentarioPersona;
  	}

  	public function getTiposangre()
    {
  		return $this->tiposangre;
  	}

  	public function setTiposangre($tiposangre)
    {
  		$this->tiposangre = $tiposangre;
  	}

    public function getNombreCentro()
    {
  		return $this->nombreCentro;
  	}
    public function setNombreCentro($nombreCentro){
  		$this->nombreCentro = $nombreCentro;
  	}

    function ingresarCampana($rutusuario,$rutpersona,$nombrespersona,$apellidospersona,$comentariopersona,$tiposangre,$nombrecentro,$fecha){
      require("../modelo/conexion2.php");
      $consulta1 = "SELECT * FROM campana WHERE rutPersona='$rutpersona' AND FK_Estado = 1";
      $resultados1 = mysqli_query($conexion,$consulta1);
      if(mysqli_num_rows($resultados1) > 0){
        ?><script>alert("Ya hay una campaña activa con esta persona");</script><?php
      }
      else{
        $consulta = "INSERT INTO campana (rutPersona, nombresPersona, apellidosPersona, comentarioCampana,FK_Tipo_Sangre, FK_Rut_Usuario, FK_Centros, FK_Estado, fechaCampana) VALUES('$rutpersona','$nombrespersona','$apellidospersona','$comentariopersona',$tiposangre,'$rutusuario',$nombrecentro, 0, '$fecha')";
        $resultados = mysqli_query($conexion,$consulta);
        if(mysqli_affected_rows($conexion) > 0)
        {
          ?> <script>
            M.toast({
              html: 'Campaña solicitada',
              displayLength: 3000,
              inDuration: 500,
              outDuration: 500,
              classes: 'rounded'
            });
            </script> <?php
        }
        else
        {
          echo "Error al guardar";
        }
      }
    }

    function ingresarCampanaAdmin($rutusuario,$rutpersona,$nombrespersona,$apellidospersona,$comentariopersona,$tiposangre,$nombrecentro,$fecha){
      require("../modelo/conexion2.php");
      $consulta1 = "SELECT * FROM campana WHERE rutPersona='$rutpersona' AND FK_Estado = 1";
      $resultados1 = mysqli_query($conexion,$consulta1);
      if(mysqli_num_rows($resultados1) > 0){
        ?><script>alert("Ya hay una campaña activa con esta persona");</script><?php
      }
      else{
        $consulta = "INSERT INTO campana (rutPersona, nombresPersona, apellidosPersona, comentarioCampana,FK_Tipo_Sangre, FK_Rut_Usuario, FK_Centros, FK_Estado, fechaCampana) VALUES('$rutpersona','$nombrespersona','$apellidospersona','$comentariopersona',$tiposangre,'$rutusuario',$nombrecentro, 1, '$fecha')";
        $resultados = mysqli_query($conexion,$consulta);
        if(mysqli_affected_rows($conexion) > 0)
        {
          ?> <script>
            M.toast({
              html: 'Campaña creada',
              displayLength: 3000,
              inDuration: 500,
              outDuration: 500,
              classes: 'rounded'
            });
          </script> <?php
        }
        else
        {
          echo "Error al guardar";
        }
      }
    }

    function obtenerCampanas(){
      require("../modelo/conexion2.php");
      $query = "SELECT centros.nombre, centros.direccion, tiposangre.clasificacion, tiposangre.factorRH, campana.* FROM campana
      INNER JOIN tiposangre ON tiposangre.idTipoSangre = campana.FK_Tipo_Sangre
      INNER JOIN centros ON centros.id = campana.FK_Centros WHERE FK_Estado = 1 ORDER BY fechaCampana DESC";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_num_rows($resultados) > 0)
      {
        echo "<h4 class='red-text center'>Campañas activas</h4>";
        while($fila = mysqli_fetch_array($resultados, MYSQLI_BOTH)){
          $fechaActual = date("Y-m-d");
          $rutPersona = $fila["rutPersona"];
          $fechaCampana = date("Y-m-d", strtotime($fila["fechaCampana"]));
          if($fechaCampana <= $fechaActual){
            $query = "UPDATE campana SET FK_Estado = 3 WHERE rutPersona= '$rutPersona' AND FK_Estado = 1";
            $resultados = mysqli_query($conexion,$query);
            if(mysqli_affected_rows($conexion) > 0){
              echo "
              <script>
                window.location.href = 'campanas.php';
              </script>";

            }
          }
          else if($fechaCampana >= $fechaActual){
            echo "
            <div class='row' >
              <div class='col s12  grey lighten-5 z-depth-1' id='bordeCampaña'>
                <div id='campanas' class='card-horizontal white-text'>
                  <div class='card-image col s1.5 m1.5 l1.5 xl1.5 hide-on-small-only'>
                    <img src='../img/chequeosalud.jpg' height='150' width='150' class='circle'>
                    <br>
                  </div>";
              echo " <div class='col s6'>
                      <span class='black-text'><h5> " .$fila["nombresPersona"] ."&nbsp;". $fila["apellidosPersona"] . " </h5> </span>
                    </div>
                      <div class='col s5'>
                      <span class='black-text'>
                        <i class='material-icons left'>location_on</i> <span class='black-text text-lighten-2'>Dirección: </span> " . $fila["direccion"] . "
                        <br> <i class='material-icons left'>location_city</i> <span class='black-text text-lighten-2'>Centro: </span>" . $fila["nombre"] . "
                        <br> <i class='material-icons left'>opacity</i> <span class='black-text text-lighten-2'>Sangre: </span>" . $fila["clasificacion"] . "&nbsp;" . $fila["factorRH"] . "&nbsp;" . "
                        <br> <i class='material-icons left'>vpn_key</i> <span class='black-text text-lighten-2'>Rut: </span>" . $fila["rutPersona"] ."&nbsp; &nbsp;" . "

                      </span>
                      </div>
                      <div class='col s4.5'>
                        <span class='black-text'>
                          <i class='material-icons left'>help</i> <span class='black-text text-lighten-2'>Información: </span> " . $fila["comentarioCampana"] . "
                        </span>
                      </div>
                </div>
              </div>
            </div>";
          }
          else{
            echo "<div class='msgCampana center'>No hay campañas disponibles</div>";
          }
        }
        /*while($fila = mysqli_fetch_array($resultados, MYSQLI_BOTH))
        {

        }*/
      }
      else
      {
          echo "<div class='msgCampana center'>No hay campañas disponibles</div>";
      }
    }
    function obtenerSolicitudes(){
      require("../modelo/conexion2.php");
      $query = "SELECT centros.nombre, centros.direccion, tiposangre.clasificacion, tiposangre.factorRH, campana.* FROM campana
      INNER JOIN tiposangre ON tiposangre.idTipoSangre = campana.FK_Tipo_Sangre
      INNER JOIN centros ON centros.id = campana.FK_Centros WHERE FK_Estado = 0";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_num_rows($resultados) > 0)
      {
        while($fila = mysqli_fetch_array($resultados, MYSQLI_BOTH))
        {
          echo "
            <tr>
              <td> ". $fila["rutPersona"] . "</td>
              <td> ". $fila["nombresPersona"] . "</td>
              <td> ". $fila["apellidosPersona"] . "</td>
              <td> ". $fila["clasificacion"] . "&nbsp;" . $fila["factorRH"] . "</td>
              <td> ". $fila["nombre"] . "</td>
              <td> ". $fila["direccion"] . "</td>
              <td> <button type='button' onclick='aceptarSolicitud()' id='btnAceptarSolicitud' value='".$fila["rutPersona"] ."'><i class='material-icons'>check</i></button>
              <button type='button' onclick='cancelarSolicitud()' id='btnCancelarSolicitud' value='".$fila["rutPersona"] ."'><i class='material-icons'>clear</i></button> </td>
            </tr>
          ";
        }

      }
      else
      {
          echo"
            <tr>
              <td><i class='material-icons'>mood_bad</i></td>
              <td><i class='material-icons'>mood_bad</i></td>
              <td><i class='material-icons'>mood_bad</i></td>
              <td><i class='material-icons'>mood_bad</i></td>
              <td><i class='material-icons'>mood_bad</i></td>
              <td><i class='material-icons'>mood_bad</i></td>
              <td><i class='material-icons'>mood_bad</i></td>
            </tr>
          ";
      }
    }

    function eliminarCampana($id){
      require("../modelo/conexion2.php");
      $query = "DELETE FROM campana WHERE rutPersona='$id' AND FK_Estado=1";
      $resultados = mysqli_query($conexion, $query);
      if($resultados = false){
        echo "SIN RESULTADOS";
      }else{
        if(mysqli_affected_rows($conexion) != 0)
        {
          ?><script>
            M.toast({
              html: 'Campaña eliminada',
              displayLength: 3000,
              inDuration: 500,
              outDuration: 500,
              classes: 'rounded'
            });
            </script> <?php
        }
        else{
          echo "<b class='red-text'>Error al eliminar</b>";
        }
      }
    }

    function actualizarCampana($rut,$nombres,$apellidos,$descripcion,$tiposangre,$nombreRecinto){
      require("../modelo/conexion2.php");
      $query = "UPDATE campana SET nombresPersona='$nombres',apellidosPersona='$apellidos'
      ,comentarioCampana='$descripcion',FK_Tipo_Sangre='$tiposangre',FK_Centros='$nombreRecinto' WHERE rutPersona='$rut' AND FK_Estado = 1";
      $resultados = mysqli_query($conexion, $query);
      if($resultados = false){
        echo "Error en la consulta";
      }
      else{
        if (mysqli_affected_rows($conexion) > 0)
        {
        ?>
          <script>
            M.toast({
              html: 'Campaña actualizada',
              displayLength: 3000,
              inDuration: 500,
              outDuration: 500,
              classes: 'rounded'
            });
            setTimeout(function(){window.location.href= "campanas.php"}, 2000);
          </script>

        <?php
        }
        else {
          echo "Error al modificar";
        }
      }
    }
    function buscarCampanaPorRut($rut){
      require("../modelo/conexion2.php");
      $query = "select * from campana where rutPersona = '$rut'";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_num_rows($resultados) > 0){
        echo "<b style='color: green;'>Usuario encontrado</b>";
        ?><script>document.getElementById("btnEnviarModificar").disabled = false;</script><?php
      }
      else{
        echo "<b style='color: red;'>Usuario incorrecto</b>";
        ?><script>document.getElementById("btnEnviarModificar").disabled = true;</script><?php
      }
    }
    function aceptarSolicitud($rutsol){
      require("../modelo/conexion2.php");
      $query = "UPDATE campana SET FK_Estado = 1 WHERE rutPersona = '$rutsol' AND FK_Estado = 0";
      $resultados = mysqli_query($conexion, $query);
      if($resultados = false){
        echo "Error en la consulta";
      }
      else{
        if(mysqli_affected_rows($conexion) > 0){
          ?>
            <script>
            M.toast({
              html: 'Campaña aceptada',
              displayLength: 3000,
              inDuration: 500,
              outDuration: 500,
              classes: 'rounded'
            });
            </script>
          <?php
        }
        else{
          echo "Error al aceptar: " . mysqli_error($conexion);
        }
      }
    }
    function cancelarSolicitud($rutsol){
      require("../modelo/conexion2.php");
      $query = "UPDATE campana SET FK_Estado = 2 WHERE rutPersona = '$rutsol' AND FK_Estado = 0";
      $resultados = mysqli_query($conexion, $query);
      if($resultados = false){
        echo "Error en la consulta";
      }
      else{
        if(mysqli_affected_rows($conexion) > 0){
          ?>
            <script>
            M.toast({
              html: 'Solicitud rechazada',
              displayLength: 3000,
              inDuration: 500,
              outDuration: 500,
              classes: 'rounded'
            });
            setTimeout(function(){window.location.href= "campanas.php"}, 2000);
            </script>
          <?php
        }
        else{
          echo "Error al aceptar: " . mysqli_error($conexion);
        }
      }
    }
    function buscarCampana($rut, $where){
      require("../modelo/conexion2.php");
      $query = "SELECT centros.nombre, centros.direccion, tiposangre.clasificacion, tiposangre.factorRH, campana.* FROM campana
      INNER JOIN tiposangre ON tiposangre.idTipoSangre = campana.FK_Tipo_Sangre
      INNER JOIN centros ON centros.id = campana.FK_Centros $where";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_num_rows($resultados) > 0)
      {

        while($fila = mysqli_fetch_array($resultados, MYSQLI_BOTH))
        {
          echo "
          <div class='row' >
          <div class='col s12  grey lighten-5 z-depth-1' id='bordeCampaña'>
            <div id='campanas' class='card-horizontal white-text'>
              <div class='card-image col s1.5 m1.5 l1.5 xl1.5 hide-on-small-only'>
                <img src='../img/chequeosalud.jpg' height='150' width='150' class='circle'>
                <br>
          </div>";
            echo " <div class='col s6'>
            <span class='black-text'><h5> " .$fila["nombresPersona"] ."&nbsp;". $fila["apellidosPersona"] . " </h5> </span>
          </div>
            <div class='col s5'>
            <span class='black-text'>
              <i class='material-icons left'>location_on</i> <span class='black-text text-lighten-2'>Dirección: </span> " . $fila["direccion"] . "
              <br> <i class='material-icons left'>location_city</i> <span class='black-text text-lighten-2'>Centro: </span>" . $fila["nombre"] . "
              <br> <i class='material-icons left'>opacity</i> <span class='black-text text-lighten-2'>Sangre: </span>" . $fila["clasificacion"] . "&nbsp;" . $fila["factorRH"] . "&nbsp;" . "
              <br> <i class='material-icons left'>vpn_key</i> <span class='black-text text-lighten-2'>Rut: </span>" . $fila["rutPersona"] ."&nbsp; &nbsp;" . "

            </span>
            </div>
            <div class='col s4.5'>
              <span class='black-text'>
                <i class='material-icons left'>help</i> <span class='black-text text-lighten-2'>Información: </span> " . $fila["comentarioCampana"] . "
              </span>
            </div>
          </div>
        </div>
      </div>";
        }

      }
      else
      {
          echo "<div class='msgCampana center'>No hay campañas disponibles</div>";
      }
    }
    function obtenerDatosCampana($rut){
      require('../modelo/conexion2.php');
      $query = "SELECT centros.nombre, centros.direccion, tiposangre.clasificacion, tiposangre.factorRH, campana.* FROM campana
      INNER JOIN tiposangre ON tiposangre.idTipoSangre = campana.FK_Tipo_Sangre
      INNER JOIN centros ON centros.id = campana.FK_Centros WHERE rutPersona = '$rut'";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_num_rows($resultados) > 0)
      {
        $fila = mysqli_fetch_array($resultados, MYSQLI_BOTH);
        echo "
        <div class='col s12'>
          <label class='grey-text'>Nombres del Paciente</label>
          <input type='text' id='txtNombres' name='txtNombres' value='".$fila["nombresPersona"]."' required>
        </div>
        <div class='col s12'>
          <label class='grey-text'>Apellidos del Paciente</label>
          <input type='text' id='txtApellidos' name='txtApellidos' value='".$fila["apellidosPersona"]."' required>
        <div class='col s12'>
          <label class='grey-text'>Tipo sangre</label>
          <select class='browser-default' id='txtTiposangre' name='txtTiposangre' required>
            <option disabled selected>Seleccione su tipo de sangre</option>
            <option value='1'>O Rh-</option>
            <option value='2'>O Rh+</option>
            <option value='3'>A Rh-</option>
            <option value='4'>A Rh+</option>
            <option value='5'>B Rh-</option>
            <option value='6'>B Rh+</option>
            <option value='7'>AB Rh-</option>
            <option value='8'>AB Rh+</option>
          </select>
        </div>
        <div class='col s12'>
          <label class='grey-text'>Nombre del recinto</label>
          <select class='browser-default' id='txtNombreRecinto' name='txtNombreRecinto' required>
            <option disabled selected>Seleccione el centro</option>
            <option value='1'>Centro Met. de Sangre</option>
            <option value='2'>Hospital Sótero del Río</option>
            <option value='3'>Hospital Barros Luco</option>
            <option value='4'>Hospital Padre Hurtado</option>
            <option value='5'>Hospital San José</option>
            <option value='6'>Hospital La Florida</option>
            <option value='7'>Hospital El Carmen</option>
            <option value='8'>Hospital Luis Tisné</option>
            <option value='9'>Hospital Salvador</option>
          </select>
        </div>
        <div class='col s12'>
          <label class='grey-text'>Descripción de la campaña</label>
          <textarea id='txtDescripcion' name='txtDescripcion' rows='8' cols='80' required>".$fila["comentarioCampana"]."</textarea>
        </div>
        ";
      }
    }

    function Obtenerlistarut($rut)
    {
      require("../modelo/conexion2.php");
      $consulta = "SELECT campana.*, estadocampana.nomEstado
      FROM campana INNER JOIN estadocampana ON campana.FK_Estado = estadocampana.idEstadoCampana
      WHERE campana.FK_Rut_Usuario = '$rut'";
      $resultados = mysqli_query($conexion, $consulta);
      if(mysqli_num_rows($resultados) > 0){

                echo    "<table class='striped highlight responsive-table'>
                            <thead>
                                <tr>
                                    <th>Fecha Campaña</th>
                                    <th>Nombre Beneficiario</th>
                                    <th>Estado de la campaña</th>
                                </tr>
                            </thead>
                            <tbody>

                        ";

                while($fila = mysqli_fetch_array($resultados, MYSQLI_BOTH)){
                    $fechaCampana = date("d-m-Y", strtotime($fila["fechaCampana"]));
                    $nombreP = $fila["nombresPersona"];
                    $apellidoP = $fila["apellidosPersona"];
                    $nomEstado = $fila["nomEstado"];

                    echo "  <tr>
                            <td>".$fechaCampana."</td>
                            <td>".$nombreP." ".$apellidoP."</td>
                            <td>".$nomEstado."</td>

                            </tr>

                          ";
                }
                        echo "</tbody>
                              </table>";

      }else{

        echo "<h4 class='center'>No has solicitado campañas</h4>";

      }
    }
    function obtenerCampanasFinalizadas(){
      require("../modelo/conexion2.php");
      $query = "SELECT centros.nombre, centros.direccion, tiposangre.clasificacion, tiposangre.factorRH, campana.* FROM campana
        INNER JOIN tiposangre ON tiposangre.idTipoSangre = campana.FK_Tipo_Sangre
        INNER JOIN centros ON centros.id = campana.FK_Centros WHERE FK_Estado = 3";
      $resultados = mysqli_query($conexion,$query);
      if(mysqli_num_rows($resultados) > 0){
        echo "<h4 class='red-text center'>Campañas finalizadas</h4><p>";
        while($fila = mysqli_fetch_array($resultados, MYSQLI_BOTH)){
          echo "
          <div class='row' >
            <div class='col s12  grey lighten-5 z-depth-1' id='bordeCampaña'>
              <div id='campanas' class='card-horizontal white-text'>
                <div class='card-image col s1.5 m1.5 l1.5 xl1.5 hide-on-small-only'>
                  <img src='../img/chequeosalud.jpg' height='150' width='150' class='circle'>
                  <br>
                </div>";
    echo " <div class='col s6'>
            <span class='black-text'><h5> " .$fila["nombresPersona"] ."&nbsp;". $fila["apellidosPersona"] . " </h5> </span>
            </div>
              <div class='col s5'>
            <span class='black-text'>
              <i class='material-icons left'>location_on</i> <span class='black-text text-lighten-2'>Dirección: </span> " . $fila["direccion"] . "
              <br> <i class='material-icons left'>location_city</i> <span class='black-text text-lighten-2'>Centro: </span>" . $fila["nombre"] . "
              <br> <i class='material-icons left'>opacity</i> <span class='black-text text-lighten-2'>Sangre: </span>" . $fila["clasificacion"] . "&nbsp;" . $fila["factorRH"] . "&nbsp;" . "
              <br> <i class='material-icons left'>vpn_key</i> <span class='black-text text-lighten-2'>Rut: </span>" . $fila["rutPersona"] ."&nbsp; &nbsp;" . "

            </span>
          </div>
                <div class='col s4.5'>
                  <span class='black-text'>
                    <i class='material-icons left'>help</i> <span class='black-text text-lighten-2'>Información: </span> " . $fila["comentarioCampana"] . "
                  </span>
                </div>
              </div>
            </div>
          </div>";
        }

      }
      else{
        echo "<div class='msgCampana center'>Aún no hay campañas</div>";
      }
    }

  }
