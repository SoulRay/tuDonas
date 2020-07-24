<?php
  class Usuario
  {
    private $rut;
    private $nombre;
    private $apellido;
    private $password;
    private $correo;
    private $tiposangre;
    private $privilegio;
    private $genero;

    public function getRut()
    {
		    return $this->rut;
	  }

  	public function setRut($rut)
    {
  		$this->rut = $rut;
  	}

  	public function getNombre()
    {
  		return $this->nombre;
  	}

  	public function setNombre($nombre)
    {
  		$this->nombre = $nombre;
  	}

  	public function getApellido()
    {
  		return $this->apellido;
  	}

  	public function setApellido($apellido)
    {
  		$this->apellido = $apellido;
  	}

  	public function getPassword()
    {
  		return $this->password;
  	}

  	public function setPassword($password)
    {
  		$this->password = $password;
  	}

  	public function getCorreo()
    {
  		return $this->correo;
  	}

  	public function setCorreo($correo)
    {
  		$this->correo = $correo;
  	}

    public function getGenero()
    {
  		return $this->genero;
  	}

  	public function setGenero($genero)
    {
  		$this->genero = $genero;
  	}

  	public function getTiposangre()
    {
  		return $this->tiposangre;
  	}

  	public function setTiposangre($tiposangre)
    {
  		$this->tiposangre = $tiposangre;
  	}

    public function getPrivilegio()
    {
  		return $this->privilegio;
  	}

  	public function setPrivilegio($privilegio){
  		$this->privilegio = $privilegio;
    }

    public function actualizarDatos($rut, $nombre, $apellido, $correo, $pass, $tiposangre){
      require("conexion2.php");
      $consulta = "UPDATE usuario SET nombreUsuario='$nombre',apellidoUsuario='$apellido',correoUsuario='$correo',passUsuario='$pass', FK_TipoSangre='$tiposangre' WHERE rutUsuario='$rut'";
      $resultados = mysqli_query($conexion, $consulta);
      if($resultados = false){
        echo "Error en la consulta";
      }
      else{
        if (mysqli_affected_rows($conexion) > 0)
        {
          session_start();
          $_SESSION["usuario"] = $rut;
          $_SESSION['nombre'] = $nombre;
          $_SESSION['apellido'] = $apellido;
          $_SESSION['correo'] = $correo;
          $_SESSION['sangre'] = $tiposangre;
        ?>
          <script>
            M.toast({
              html: 'Usuario actualizado!!',
              displayLength: 3000,
              inDuration: 500,
              outDuration: 500,
              classes: 'rounded'
            });
            setTimeout(function(){window.location.href= "bienvenido.php"}, 2000);
          </script>

        <?php
        }
        else {
          echo "Error al modificar";
        }
      }
    }

    public function ingresarUsuario($rutU,$nombreU, $apellidoU, $passU, $correoU, $generoU, $sangreU, $rutaU)
    {
      require("conexion2.php");
      $consulta2 = "SELECT * FROM usuario WHERE rutUsuario = '$rutU'";
      $resultados2 = mysqli_query($conexion,$consulta2);
      if(mysqli_num_rows($resultados2) > 0){
        ?><script> alert("Usuario ya registrado"); </script><?php
      }
      else {
        $consulta = "INSERT INTO usuario VALUES ('$rutU','$nombreU','$apellidoU','$passU','$correoU', '$generoU', 2, $sangreU, '$rutaU')";
        $resultados = mysqli_query($conexion,$consulta);
        if($resultados = true)
        {
          session_start();
          $_SESSION["usuario"] = $rutU;
          $_SESSION['nombre'] = $nombreU;
          $_SESSION['apellido'] = $apellidoU;
          $_SESSION['correo'] = $correoU;
          $_SESSION["FK_Privilegio"] = "Usuario";
          $_SESSION['imagen'] = $rutaU;
          ?>
          <script>
            M.toast({
                html: 'Usuario registrado',
                displayLength: 3000,
                inDuration: 500,
                outDuration: 500,
                classes: 'rounded'
            });
            setTimeout(function(){window.location.href = "index.php";}, 2000);

          </script>
          <?php
        }
        else
        {
          echo "Error al registrarse";
        }
        mysqli_close($conexion);
      }
    }

    public function obtenerDatos($rutU, $passU)
    {
      require("../modelo/conexion2.php");
      //$consulta = "SELECT * FROM usuario WHERE rutUsuario='$rutU' and passUsuario='$passU'";
      $consulta = "SELECT usuario.*, tiposangre.clasificacion, tiposangre.factorRH, privilegio.nombrepriv
      FROM usuario
      INNER JOIN tiposangre ON tiposangre.idTipoSangre = usuario.FK_TipoSangre
      INNER JOIN privilegio ON privilegio.idprivilegio = usuario.FK_Privilegio
      WHERE rutUsuario='$rutU' and passUsuario='$passU'";
      $resultados = mysqli_query($conexion,$consulta);
      //if(mysqli_fetch_row($resultados))
      if($row = mysqli_fetch_array($resultados))
      {
        $rut = $row["rutUsuario"];
        $query = "SELECT * FROM estadoBloqueo WHERE FK_RutUsuario = '$rut'";
        $resultados = mysqli_query($conexion,$query);
        if(mysqli_num_rows($resultados) > 0){
          $fila = mysqli_fetch_array($resultados);
          $rut = $fila["idEstado"];
          $fechaactual = date("Y-m-d");
          $fechabloqueo = date("Y-m-d", strtotime($fila["duracion"]));
          if($fechaactual >= $fechabloqueo){
            $query = "DELETE FROM estadobloqueo WHERE idEstado = '$rut'";
            $resultados = mysqli_query($conexion,$query);
            if(mysqli_affected_rows($conexion) > 0){
              ?><script>alert("Su bloqueo ha terminado");</script><?php
            }
            else{
              ?><script>alert("Error");</script><?php
            }
          }else{
            ?><script>alert("Usted sigue bloqueado");</script><?php
          }
        }
        session_start();
        //$apellido = "123";
        $_SESSION['usuario'] = $rutU;
        $_SESSION['nombre'] = $row['nombreUsuario'];
        $_SESSION['apellido'] = $row['apellidoUsuario'];
        $_SESSION['correo'] = $row['correoUsuario'];
        $_SESSION['FK_Privilegio'] = $row['nombrepriv'];
        $_SESSION['sangre'] = $row['FK_TipoSangre'];
        $_SESSION['factor'] = $row['factorRH'];
        $_SESSION['genero'] = $row['genero'];
        $_SESSION['imagen'] = $row['imagenUser'];

        ?> <script>
            alert("Bienvenido");
            location.href = "index.php";
          </script> <?php

      } else{ echo "<h5 style='text-align:center; color:red;'>Usuario incorrecto</h5>"; }

      mysqli_close($conexion);
    }

    public function buscarUser($rut){
      require("../modelo/conexion2.php");
      $query = "SELECT usuario.*, donaciones.*, tiposangre.clasificacion, tiposangre.factorRH FROM usuario
      INNER JOIN donaciones ON usuario.rutUsuario = donaciones.FK_RutDonante
      INNER JOIN tiposangre ON usuario.FK_TipoSangre = tiposangre.idTipoSangre
      WHERE rutUsuario = '$rut'
      ORDER BY donaciones.fechaDonacion DESC LIMIT 1";

      $resultados = mysqli_query($conexion, $query);

      if(mysqli_num_rows($resultados) > 0){
        while($fila = mysqli_fetch_array($resultados, MYSQLI_BOTH)){

            $fechaultimadonacion = date("d-m-Y", strtotime($fila["fechaDonacion"]));
            $fechaactual = date("d-m-Y");

          echo "
                <div class='card' id='cabezera-perfil'>
                    <div class='card-image waves-effect waves-block waves-light'>
                      <img class='activator' src='../img/banner.png' alt='user background' width='100%' height='200px' >
                    </div>
                    <div class='card-content'>
                        <div class='row'>
                          <div class='col s3 offset-s2 l3'>
                            <figure class='card-profile-image'>
                              <img src='".$fila["imagenUser"]."' alt='profile image' class='circle activator' height='150px' style='position:relative; right:50px; z-index:1;'>
                            </figure>
                          </div>
                          <div class='col s3 offset-s2 l2' >
                            <h4 class='card-title grey-text text-darken-4 activator'>".$fila["nombreUsuario"]."<br>" .$fila['apellidoUsuario'] ."</h4>
                            <p class='medium-small grey-text'>Nombre </p>
                          </div>
                          <div class='col s3 offset-s2 l3'>
                            <h4 class='card-title grey-text text-darken-4 activator'>".$fechaultimadonacion."</h4>
                            <p class='medium-small grey-text'>Ultima donacion</p>
                          </div>
                          <div class='col s3 offset-s2 l2'>
                            <h4 class='card-title grey-text text-darken-4 activator'>".$fila["clasificacion"]."&nbsp;".$fila["factorRH"]."</h4>
                            <p class='medium-small grey-text'>Tipo Sangre</p>
                          </div>";

                          if( $fila["genero"]=="Hombre"){
                            $fechacuandopuededonar = date("d-m-Y", strtotime($fila["fechaDonacion"]."+ 3 month"));
                          }
                          else{
                            $fechacuandopuededonar = date("d-m-Y", strtotime($fila["fechaDonacion"]."+ 4 month"));
                          }
                              $dato1 = new DateTime("$fechacuandopuededonar");
                              $dato2 = new DateTime("$fechaactual");
                              $interval = $dato1->diff($dato2);

                          if($dato1>$dato2){
                              $contador = $interval->format('%a días');
                          }else{
                              $contador = "Ya puedes donar</b></td>";
                          }

          echo   "  <div class='col s3 offset-s2 l2'>
                      <h4 class='card-title grey-text text-darken-4 activator'>".$contador."</h4>
                      <p class='medium-small grey-text'>Podras donar en</p>
                    </div>
                  </div>
                    <span class='card-title activator black-text text-darken-4' > Ver Perfil <i class='material-icons right'>more_vert</i></span>
                </div>

                    <div class='card-reveal'>
                    <p>
                        <span class='card-title grey-text text-darken-4'>Mi Perfil<i class='material-icons right'>close</i></span>
                          </p>
                        <p>
                            <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>account_circle</i> &nbsp; ".$fila["rutUsuario"]."
                        </p>
                        <p id='pnombre'>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>perm_identity</i> &nbsp; ".$fila['nombreUsuario'] ."
                      </p>
                        <p id='papellido'>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>perm_identity</i> &nbsp; ".$fila['apellidoUsuario'] ."
                      </p>
                        <p>
                            <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>wc</i> &nbsp; ".$fila["genero"]."
                        </p>
                        <p>
                            <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>mail</i> &nbsp; ".$fila["correoUsuario"]."
                        </p>
                        <p>
                            <input class='btn red modal-trigger right-align' href='#modal1' type='button' onclick='verFicha()' name='btnVerFicha' value='Ver ficha'>
                        </p>
                        <p>
                          <input class='btn red modal-trigger href='#modal2' type='button' onclick='' id='btnBloquear' name='btnBloqUser' value='Bloquear'>
                        </p>
                    </div>
                </div>

                ";
                $query = "SELECT donaciones.idDonaciones, donaciones.fechaDonacion, donaciones.direccion, tipolugar.clasLugar FROM donaciones
                INNER JOIN tipolugar ON tipolugar.idTipoLugar = donaciones.FK_TipoLugar INNER JOIN usuario ON usuario.rutUsuario = donaciones.FK_RutDonante
                WHERE FK_RutDonante = '$rut' ORDER BY donaciones.fechaDonacion ASC";
                $resultado = mysqli_query($conexion,$query);
                if(mysqli_num_rows($resultado)>0){
                  echo "
                  <div id='contenedorMostraBloqueo'>
                    <div class='' id='contenedorBloqueo'>
                      <div class='' id='iconoBloqueo'>
                        <i class='material-icons'>format_color_reset</i>
                      </div>
                      <span id='textoBloqueo'></span>
                    </div>
                  </div>".
                   "<div style='padding-top: 50px;'><h5 class='center blue-text text-darken-4'>Donaciones previas</h5>" .
                     "<table class='highlight responsive-table'>
                                <thead>
                                    <tr>
                                        <th>Fecha Donacion</th>
                                        <th>Direccion</th>
                                        <th>Tipo Lugar</th>
                                    </tr>
                                </thead>
                                <tbody>

                            ";

                    while($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH)){
                        $fechaDonacion = date("d-m-Y", strtotime($fila["fechaDonacion"]));
                        $direccion = $fila["direccion"];
                        $tipoLugar = $fila["clasLugar"];
                        $idDonacion = $fila["idDonaciones"];

                        echo "  <tr>
                                <td>".$fechaDonacion."</td>
                                <td>".$direccion."</td>
                                <td>".$tipoLugar."</td>
                                </tr>

                        ";
                    }
                            echo "</tbody>
                                  </table>
                                </div>";
                }
                else{
                    echo "
                    <div id='contenedorMostraBloqueo'>
                      <div class='' id='contenedorBloqueo'>
                        <div class='' id='iconoBloqueo'>
                          <i class='material-icons'>format_color_reset</i>
                        </div>
                      <span id='textoBloqueo'></span>
                    </div>
                    <h4 class='center'>No has agregado donaciones</h4>";
                }
          }
        }
        //No contiene donaciones
        else{
          $query = "SELECT usuario.*, tiposangre.clasificacion, tiposangre.factorRH FROM usuario
          INNER JOIN tiposangre ON usuario.FK_TipoSangre = tiposangre.idTipoSangre
          WHERE rutUsuario = '$rut'";

            $resultados = mysqli_query($conexion, $query);
            if(mysqli_num_rows($resultados) > 0){
              while($fila = mysqli_fetch_array($resultados, MYSQLI_BOTH)){
                echo "
                <div class='card' id='cabezera-perfil'>
                    <div class='card-image waves-effect waves-block waves-light'>
                      <img class='activator' src='../img/banner.png' alt='user background' width='100%' height='200px' >
                    </div>
                    <div class='card-content'>
                        <div class='row'>
                          <div class='col s3 offset-s2 l3'>
                            <figure class='card-profile-image'>
                               <img src='".$fila["imagenUser"]."' alt='profile image' class='circle activator' height='150px' style='position:relative; right:50px; z-index:1;'>
                            </figure>
                          </div>
                          <div class='col s3 offset-s2 l2' >
                            <h4 class='card-title grey-text text-darken-4 activator'>".$fila["nombreUsuario"]."<br>" .$fila['apellidoUsuario'] ."</h4>
                            <p class='medium-small grey-text'>Nombre </p>
                          </div>
                          <div class='col s3 offset-s2 l3'>
                            <h4 class='card-title grey-text text-darken-4 activator'>No has ingresado una donacion</h4>
                            <p class='medium-small grey-text'>Ultima donacion</p>
                          </div>
                          <div class='col s3 offset-s2 l2'>
                            <h4 class='card-title grey-text text-darken-4 activator'>".$fila["clasificacion"]."&nbsp;".$fila["factorRH"]."</h4>
                            <p class='medium-small grey-text'>Tipo Sangre</p>
                          </div>
                          <div class='col s3 offset-s2 l2'>
                            <h4 class='card-title grey-text text-darken-4 activator'>-</h4>
                            <p class='medium-small grey-text'>Podras donar en</p>
                          </div>
                        </div>
                        <span class='card-title activator black-text text-darken-4' > Mas informacion <i class='material-icons right'>more_vert</i></span>
                    </div>

                    <div class='card-reveal'>
                      <p>
                        <span class='card-title grey-text text-darken-4'>Mi Perfil<i class='material-icons right'>close</i></span>
                      </p>
                      <p id='prut'>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>account_circle</i> &nbsp; ".$fila["rutUsuario"]."
                      </p>
                      <p id='pnombre'>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>perm_identity</i> &nbsp; ".$fila['nombreUsuario'] ."
                      </p>
                      <p id='papellido'>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>perm_identity</i> &nbsp; ".$fila['apellidoUsuario'] ."
                      </p>
                      <p>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>wc</i> &nbsp; ".$fila["genero"]."
                      </p>
                      <p id='pcorreo'>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>mail</i> &nbsp; ".$fila["correoUsuario"]."
                      </p>
                      <p>
                        <input class='btn red modal-trigger' href='#modal1' type='button' onclick='verFicha()' name='btnVerFicha' value='Ver ficha'>
                      </p>
                      <p>
                        <input class='btn red modal-trigger href='#modal2' type='button' onclick='' id='btnBloquear' name='btnBloqUser' value='Bloquear'>
                      </p>
                    </div>
                </div>
                ";
                $query = "SELECT donaciones.idDonaciones, donaciones.fechaDonacion, donaciones.direccion, tipolugar.clasLugar FROM donaciones
                INNER JOIN tipolugar ON tipolugar.idTipoLugar = donaciones.FK_TipoLugar INNER JOIN usuario ON usuario.rutUsuario = donaciones.FK_RutDonante
                WHERE FK_RutDonante = '$rut' ORDER BY donaciones.fechaDonacion ASC";
                $resultado = mysqli_query($conexion,$query);
                if(mysqli_num_rows($resultado)>0){
                    echo "
                    <div id='contenedorMostraBloqueo'>
                      <div class='' id='contenedorBloqueo'>
                        <div class='' id='iconoBloqueo'>
                          <i class='material-icons'>format_color_reset</i>
                        </div>
                      <span id='textoBloqueo'></span>
                    </div>
                    <div style='padding-top: 50px;'><h5 class='center blue-text text-darken-4'>Donaciones previas</h5>" .
                       "<table class='highlight responsive-table'>
                                <thead>
                                    <tr>
                                        <th>Fecha Donacion</th>
                                        <th>Direccion</th>
                                        <th>Tipo Lugar</th>
                                    </tr>
                                </thead>
                                <tbody>

                            ";

                    while($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH)){
                        $fechaDonacion = date("d-m-Y", strtotime($fila["fechaDonacion"]));
                        $direccion = $fila["direccion"];
                        $tipoLugar = $fila["clasLugar"];
                        $idDonacion = $fila["idDonaciones"];

                        echo "  <tr>
                                <td>".$fechaDonacion."</td>
                                <td>".$direccion."</td>
                                <td>".$tipoLugar."</td>
                                </tr>

                        ";
                    }
                            echo "</tbody>
                                  </table>
                                </div>";
                }
                else{
                    echo "
                    <div id='contenedorMostraBloqueo'>
                      <div class='' id='contenedorBloqueo'>
                        <div class='' id='iconoBloqueo'>
                          <i class='material-icons'>format_color_reset</i>
                        </div>
                        <span id='textoBloqueo'></span>
                      </div>
                    </div>
                    <h4 class='center'>Usuario sin donaciones</h4>";
                }
              }
            }
            else{
              echo "
              <div style='background-color: #b71c1c; color: white; width: 100%; text-align: center; border-radius: 2px;'>
                No se encontraron resultados
              </div>";
            }
          }
    }

    function verPerfilUser2($rut){
      require("../modelo/conexion2.php");
      $query = "SELECT usuario.*, donaciones.fechaDonacion, tiposangre.clasificacion, tiposangre.factorRH FROM usuario
      INNER JOIN donaciones ON usuario.rutUsuario = donaciones.FK_RutDonante
      INNER JOIN tiposangre ON usuario.FK_TipoSangre = tiposangre.idTipoSangre
      WHERE rutUsuario = '$rut'
      ORDER BY donaciones.fechaDonacion DESC LIMIT 1";

      $resultados = mysqli_query($conexion, $query);

      if(mysqli_num_rows($resultados) > 0){
        while($fila = mysqli_fetch_array($resultados, MYSQLI_BOTH)){

            $fechaultimadonacion = date("d-m-Y", strtotime($fila["fechaDonacion"]));
            $fechaactual = date("d-m-Y");

          echo "
                <div class='card' id='cabezera-perfil'>
                    <div class='card-image waves-effect waves-block waves-light'>
                      <img class='activator' src='../img/user-profile-bg.jpg' alt='user background' width='100%' height='200px' >
                    </div>
                    <div class='card-content'>
                        <div class='row'>
                          <div class='col s3 offset-s2 l3'>
                            <figure class='card-profile-image'>
                               <img src='".$fila["imagenUser"]."' alt='profile image' class='circle responsive-img activator' style='position:relative; bottom:100px; z-index:1;'>
                            </figure>
                          </div>
                          <div class='col s3 offset-s2 l2' >
                            <h4 class='card-title grey-text text-darken-4 activator'>".$fila["nombreUsuario"]."<br>" .$fila['apellidoUsuario'] ."</h4>
                            <p class='medium-small grey-text'>Nombre </p>
                          </div>
                          <div class='col s3 offset-s2 l3'>
                            <h4 class='card-title grey-text text-darken-4 activator'>".$fechaultimadonacion."</h4>
                            <p class='medium-small grey-text'>Ultima donacion</p>
                          </div>
                          <div class='col s3 offset-s2 l2'>
                            <h4 class='card-title grey-text text-darken-4 activator'>".$fila["clasificacion"]."&nbsp;".$fila["factorRH"]."</h4>
                            <p class='medium-small grey-text'>Tipo Sangre</p>
                          </div>";

                          if( $fila["genero"]=="Hombre"){
                            $fechacuandopuededonar = date("d-m-Y", strtotime($fila["fechaDonacion"]."+ 3 month"));
                          }
                          else{
                            $fechacuandopuededonar = date("d-m-Y", strtotime($fila["fechaDonacion"]."+ 4 month"));
                          }
                              $dato1 = new DateTime("$fechacuandopuededonar");
                              $dato2 = new DateTime("$fechaactual");
                              $interval = $dato1->diff($dato2);

                          if($dato1>$dato2){
                              $contador = $interval->format('%a días');
                          }else{
                              $contador = "Ya puedes donar</b></td>";
                          }

          echo                "<div class='col s3 offset-s2 l2'>
                            <h4 class='card-title grey-text text-darken-4 activator'>".$contador."</h4>
                            <p class='medium-small grey-text'>Podras donar en</p>
                          </div>
                        </div>
                        <span class='card-title activator black-text text-darken-4' > Ver Perfil <i class='material-icons right'>more_vert</i></span>
                    </div>

                    <div class='card-reveal'>
                    <p>
                        <span class='card-title grey-text text-darken-4'>Mi Perfil<i class='material-icons right'>close</i></span>
                          </p>
                        <p>
                            <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>account_circle</i> &nbsp; ".$fila["rutUsuario"]."
                        </p>
                        <p id='pnombre'>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>perm_identity</i> &nbsp; ".$fila['nombreUsuario'] ."
                      </p>
                        <p id='papellido'>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>perm_identity</i> &nbsp; ".$fila['apellidoUsuario'] ."
                      </p>
                        <p>
                            <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>wc</i> &nbsp; ".$fila["genero"]."
                        </p>
                        <p>
                            <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>mail</i> &nbsp; ".$fila["correoUsuario"]."
                        </p>
                        <p class='right-align'>
                          <input class='btn red modal-trigger right-align' href='#modal1' type='button' name='btnModicidarPerfil' value='Modificar perfil'>
                        </p>
                    </div>
                </div>

                ";
          }
        }
        else{
          $query = "SELECT usuario.*, tiposangre.clasificacion, tiposangre.factorRH FROM usuario
          INNER JOIN tiposangre ON usuario.FK_TipoSangre = tiposangre.idTipoSangre
          WHERE rutUsuario = '$rut'";

            $resultados = mysqli_query($conexion, $query);
            if(mysqli_num_rows($resultados) > 0){
              while($fila = mysqli_fetch_array($resultados, MYSQLI_BOTH)){
                echo "
                <div class='card' id='cabezera-perfil'>
                    <div class='card-image waves-effect waves-block waves-light'>
                      <img class='activator' src='../img/user-profile-bg.jpg' alt='user background' width='100%' height='200px' >
                    </div>
                    <div class='card-content'>
                        <div class='row'>
                          <div class='col s3 offset-s2 l3'>
                            <figure class='card-profile-image'>
                               <img src='".$fila["imagenUser"]."' alt='profile image' class='circle responsive-img activator' style='position:relative; bottom:100px; z-index:1;'>
                            </figure>
                          </div>
                          <div class='col s3 offset-s2 l2' >
                            <h4 class='card-title grey-text text-darken-4 activator'>".$fila["nombreUsuario"]."<br>" .$fila['apellidoUsuario'] ."</h4>
                            <p class='medium-small grey-text'>Nombre </p>
                          </div>
                          <div class='col s3 offset-s2 l3'>
                            <h4 class='card-title grey-text text-darken-4 activator'>No has ingresado una donacion</h4>
                            <p class='medium-small grey-text'>Ultima donacion</p>
                          </div>
                          <div class='col s3 offset-s2 l2'>
                            <h4 class='card-title grey-text text-darken-4 activator'>".$fila["clasificacion"]."&nbsp;".$fila["factorRH"]."</h4>
                            <p class='medium-small grey-text'>Tipo Sangre</p>
                          </div>
                          <div class='col s3 offset-s2 l2'>
                            <h4 class='card-title grey-text text-darken-4 activator'>-</h4>
                            <p class='medium-small grey-text'>Podras donar en</p>
                          </div>
                        </div>
                        <span class='card-title activator black-text text-darken-4' > Mas informacion <i class='material-icons right'>more_vert</i></span>
                    </div>

                    <div class='card-reveal'>
                      <p>
                        <span class='card-title grey-text text-darken-4'>Mi Perfil<i class='material-icons right'>close</i></span>
                      </p>
                      <p id='prut'>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>account_circle</i> &nbsp; ".$fila["rutUsuario"]."
                      </p>
                      <p id='pnombre'>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>perm_identity</i> &nbsp; ".$fila['nombreUsuario'] ."
                      </p>
                      <p id='papellido'>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>perm_identity</i> &nbsp; ".$fila['apellidoUsuario'] ."
                      </p>
                      <p>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>wc</i> &nbsp; ".$fila["genero"]."
                      </p>
                      <p id='pcorreo'>
                        <i class='mdi-action-perm-identity cyan-text text-darken-2 material-icons'>mail</i> &nbsp; ".$fila["correoUsuario"]."
                      </p>
                      <p class='right-align'>
                        <input class='btn red modal-trigger right-align' href='#modal1' type='button' name='btnActualizarDatos' value='Modificar perfil'>
                      </p>
                    </div>
                </div>
                ";
              }
            }
            else{
            echo "Error";
            }
          }

    }

      function verBloqueo($rut){
        require("../modelo/conexion2.php");
        $query = "SELECT * FROM estadoBloqueo WHERE FK_RutUsuario = '$rut' ORDER BY duracion DESC LIMIT 1";
        $resultados = mysqli_query($conexion,$query);
        if(mysqli_num_rows($resultados) > 0){
          while($fila = mysqli_fetch_array($resultados, MYSQLI_BOTH)){
            $fechaactual = date("Y-m-d");
            $fechabloqueo = date("Y-m-d", strtotime($fila["duracion"]));
            $dato1 = new DateTime("$fechaactual");
            $dato2 = new DateTime("$fechabloqueo");
            if($dato1 >= $dato2){
              echo "Bloqueo terminado";
            }
            else{
              $intervalo = $dato2->diff($dato1);
                echo "Usuario bloqueado, quedan: " . $intervalo->d . " día(s)";
            }
          }
        }
        else{
          echo "0";
        }
      }
      function bloquearUsuario($tipobloq,$fecha,$comentario,$rut){
        require("../modelo/conexion2.php");
        $query = "INSERT INTO estadobloqueo(idEstado,nombreEstado,duracion,comentarioBloqueo,FK_RutUsuario) VALUES('$rut','$tipobloq','$fecha','$comentario','$rut')";
        $resultados = mysqli_query($conexion,$query);
        if(mysqli_affected_rows($conexion) > 0){
          ?>
          <script>
            M.toast({
                html: 'Usuario bloqueado',
                displayLength: 3000,
                inDuration: 500,
                outDuration: 500,
                classes: 'rounded'
            });
            setTimeout(function(){window.location.href = "vistaBuscar.php";}, 2000);

          </script>
          <?php
        }
        else{
          ?>
          <script>alert("Error al bloquear, verifique si está bloqueado");</script>
          <?php
        }
      }
      function verificarBloqueo($rut){
        require("../modelo/conexion2.php");
        $query = "SELECT * FROM estadobloqueo WHERE idEstado = '$rut'";
        $resultados = mysqli_query($conexion,$query);
        if(mysqli_num_rows($resultados) > 0){
          echo "1";
        }
        else{
          echo "0";
        }
      }
      function verUserCorreos(){
        require("../modelo/conexion2.php");
        $query = "SELECT donaciones.*, usuario.* FROM `donaciones`
          INNER JOIN usuario ON usuario.rutUsuario = donaciones.FK_RutDonante
          WHERE DATE_ADD(fechaDonacion, INTERVAL 4 MONTH) = CURDATE()
          UNION ALL
          SELECT donaciones.*, usuario.* FROM `donaciones`
          INNER JOIN usuario ON usuario.rutUsuario = donaciones.FK_RutDonante
          WHERE DATE_ADD(fechaDonacion, INTERVAL 3 MONTH) = CURDATE()";
        $resultados = mysqli_query($conexion,$query);
        if(mysqli_num_rows($resultados) > 0){
          while($fila = mysqli_fetch_array($resultados)){
            echo"
            <div class='col s12 m4'>
              <div class='card'>
                <div class='card-image'>
                  <img src='".$fila['imagenUser']."'></img>
                  <span class='card-title'>".$fila['nombreUsuario']."</span>
                </div>
                <div class='card-content'>
                  <b>Rut: </b>".$fila['rutUsuario']."<br>
                  <b>Nombre: </b>".$fila['nombreUsuario']." ".$fila['apellidoUsuario']."<br>
                  <b>Correo: </b>".$fila['correoUsuario']."<br>
                  <b>Genero: </b>".$fila['genero']."<br>
                </div>
              </div>
            </div>
            ";
            /*echo "
            <tr>
              <td>$fila[rutUsuario]</td>
              <td>$fila[nombreUsuario]</td>
              <td>$fila[apellidoUsuario]</td>
              <td>$fila[correoUsuario]</td>
              <td>$fila[genero]</td>
              <td>".date('d-m-Y', strtotime($fila['fechaDonacion']))."</td>
            </tr>
            ";*/
          }
        }
        else{
          ?>
          <script>
            document.getElementById("divEnviarCorreos").disabled = true;
            document.getElementById("divEnviarCorreos").style.background = "rgba(0,0,0,0)";
            document.getElementById("divEnviarCorreos").style.color = "#4e3372";
            document.getElementById("divEnviarCorreos").style.boxShadow = "inset 0 0 0 3px #4e3372";
          </script>

          <?php
          echo "
          <div id='msjErrorCorreos'>No hay usuarios disponibles en esta fecha</div>
          ";
        }
      }
      function enviarCorreos(){
        require("../modelo/conexion2.php");
        $query = "SELECT donaciones.*, usuario.* FROM `donaciones`
          INNER JOIN usuario ON usuario.rutUsuario = donaciones.FK_RutDonante
          WHERE DATE_ADD(fechaDonacion, INTERVAL 4 MONTH) = CURDATE()
          UNION ALL
          SELECT donaciones.*, usuario.* FROM `donaciones`
          INNER JOIN usuario ON usuario.rutUsuario = donaciones.FK_RutDonante
          WHERE DATE_ADD(fechaDonacion, INTERVAL 3 MONTH) = CURDATE()";
        $resultados = mysqli_query($conexion,$query);
        if(mysqli_num_rows($resultados) > 0){
          while($fila = mysqli_fetch_array($resultados)){
            $destinatario = "$fila[correoUsuario]";
            $asunto = "Fecha para donar sangre";
            $headers = 'From: atencion.tudonas@gmail.com'. "\r\n".
            'Content-Type: text/html; charset=UTF-8';
            $mensaje= "Junto con saludarte, te queremos informar que ya estás apto para donar sangre nuevamente." . "<br/>";
            $mensaje.= "Revisa las colectas de esta semana <a href='http://localhost/tudonas/vista/calendario.php'>aquí</a>";
            $mensaje.= "<p>Esperamos que tengas un buen día.</p>" . "<br/>";
            $mensaje.= "<p><b>atte. El equipo de TúDonas :)</b></p>" . "<br/>";
            $mensaje.= "<br><img src='http://localhost/tudonas/img/logo.png' width='200' height='200'>";
            if(mail($destinatario,$asunto,$mensaje,$headers)){
              echo "<script>alert('Correos enviados');</script>";
            }
          }
        }
      }
      function verFicha($rutFicha){
        require("../modelo/conexion2.php");
        $query = "SELECT * FROM fichadonante WHERE FK_FichaUsuario = '$rutFicha'";
        $resultados = mysqli_query($conexion,$query);
        if(mysqli_num_rows($resultados) > 0){
          $fila = mysqli_fetch_array($resultados, MYSQLI_BOTH);
          echo "<center><iframe src='../archivos/" .$rutFicha. "/" .$fila["ruta"]."'frameborder='0'
          width='655' height='550' marginheight='0' marginwidth='0'></iframe></center>";
        }else{
          echo "
            <script>
              if(confirm('Este usuario no contiene ficha ¿Desea agregar una?')){
                window.location.href = 'vistaAgregarFicha.php?id=$rutFicha';
              }else{
                $('#modalMostrarFicha').modal('close');
              }
            </script>
          ";
        }
      }
      function agregarFicha($nombre,$tipo,$tamaño,$rut){
        require("../modelo/conexion2.php");
        $query = "INSERT INTO fichadonante (ruta, tipo, size, FK_FichaUsuario)
        VALUES ('$nombre','$tipo','$tamaño','$rut')";
        mysqli_query($conexion, $query);
        if(mysqli_affected_rows($conexion) > 0)
        {
          ?>
          <script>
            M.toast({
              html: 'Ficha agregada',
              displayLength: 3000,
              inDuration: 500,
              outDuration: 500,
              classes: 'rounded'
            });
            setTimeout(function(){window.location.href = "vistaBuscar.php";}, 2000);

          </script>
          <?php

        }else{
          echo "";
        }
      }
    }
?>
