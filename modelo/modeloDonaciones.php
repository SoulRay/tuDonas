<?php
    class Donaciones{
        private $fechaDonacion;
        private $direccion;
        private $FKRutdonante;
        private $FKTipoLugar;

        public function getFechaDonacion()
        {
            return $this->fechaDonacion;
        }

        public function setFechaDonacion($fechaDonacion)
        {
            $this->fechaDonacion = $fechaDonacion;
        }

        public function getDireccion()
        {
            return $this ->direccion;
        }

        public function setDireccion($direccion)
        {
            $this->direccion = $direccion;
        }

        public function getFKRutDonante()
        {
            return $this->FKRutdonante;
        }

        public function setFKRutDonante($FKRutdonante)
        {
            $this->FKRutdonante = $FKRutdonante;
        }

        public function getFKTipoLugar()
        {
            return $this->FKTipoLugar;
        }

        public function setFKTipoLugar($FKTipoLugar)
        {
            $this->FKTipoLugar = $FKTipoLugar;
        }

        function ingresarDonacion($fechaDonacion, $direccion, $FKRutDonante, $FKTipoLugar){
            require("../modelo/conexion2.php");
            $consulta = "INSERT INTO donaciones (fechaDonacion, direccion, FK_RutDonante, FK_TipoLugar) VALUES('$fechaDonacion','$direccion','$FKRutDonante','$FKTipoLugar')";
            $resultado = mysqli_query($conexion,$consulta);
            if(mysqli_affected_rows($conexion) > 0)
            {
              ?> <script>
                M.toast({
                  html: 'Donacion agregada!',
                  displayLength: 3000,
                  inDuration: 500,
                  outDuration: 500,
                  classes: 'rounded'
                });
                setTimeout(function(){window.location.href= "bienvenido.php"}, 2000);
              </script> <?php
            }
            else
            {
              echo "Error al ingresar donacion";
            }
          }

          function EliminarDonacion($idDonacion){
            require("../modelo/conexion2.php");
            $consulta = "DELETE FROM donaciones WHERE idDonaciones = '$idDonacion'";
            $resultado = mysqli_query($conexion,$consulta);
            if(mysqli_affected_rows($conexion)>0){
                ?>  <script>
                M.toast({
                  html: 'Donacion Eliminada!',
                  displayLength: 3000,
                  inDuration: 500,
                  outDuration: 500,
                  classes: 'rounded'
                });
              </script> <?php
            }
            else{
                echo "No se elimino la donacion error (Else modeloDonaciones.php)";
            }
          }


        function ObtenerListaDonaciones($rut){

            require("../modelo/conexion2.php");
            $query = "SELECT donaciones.idDonaciones, donaciones.fechaDonacion, donaciones.direccion, tipolugar.clasLugar FROM donaciones
            INNER JOIN tipolugar ON tipolugar.idTipoLugar = donaciones.FK_TipoLugar INNER JOIN usuario ON usuario.rutUsuario = donaciones.FK_RutDonante
            WHERE FK_RutDonante = '$rut' ORDER BY donaciones.fechaDonacion ASC";
            $resultado = mysqli_query($conexion,$query);
            if(mysqli_num_rows($resultado)>0){

                echo    "<table class='striped highlight responsive-table'>
                            <thead>
                                <tr>
                                    <th>Fecha Donacion</th>
                                    <th>Direccion</th>
                                    <th>Tipo Lugar</th>
                                    <th>Eliminar</th>
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
                            <td> <button id='eliminardonacion' name='btneliminar' value='".$idDonacion."' class='btn red boton'>-</button></td>

                            </tr>

                    ";
                }
                        echo "</tbody>
                              </table>";
            }
            else{
                echo "<h4 class='center'>No has agregado donaciones</h4>";
            }

        }


        function ComprobarFecha($FechaIngresada, $genero, $FK_RutDonante)
        {
            require("../modelo/conexion2.php");
            $ultimadonacion = mysqli_query($conexion,"SELECT fechaDonacion FROM donaciones WHERE FK_RutDonante = '$FK_RutDonante' ORDER BY fechaDonacion DESC LIMIT 1 ");
            $rultimadonacion = mysqli_fetch_array($ultimadonacion, MYSQLI_BOTH);
            $fechaingresada = date("Y-m-d", strtotime($FechaIngresada));

            $fechaactual = date("Y-m-d");

            if(!empty($rultimadonacion)){

                if($genero == "Hombre"){

                    $ultdon = date("Y-m-d", strtotime($rultimadonacion["fechaDonacion"]."+ 3 month"));
                }
                else{
                    $ultdon = date("Y-m-d", strtotime($rultimadonacion["fechaDonacion"]."+ 4 month"));
                }

                if($ultdon>$fechaingresada || $fechaingresada>$fechaactual){
                    return false;
                }else{
                    return true;
                }
            }else{
                if(empty($rultimadonacion) && $fechaingresada>$fechaactual){
                    return false;
                }
                else{
                    return true;
                }
            }
        }

        function Fechas($rut, $genero){
            require("../modelo/conexion2.php");
            $ultimadonacion = mysqli_query($conexion,"SELECT fechaDonacion FROM donaciones WHERE FK_RutDonante = '$rut' ORDER BY fechaDonacion DESC LIMIT 1 ");
            $fudnc = mysqli_fetch_array($ultimadonacion, MYSQLI_BOTH);
            $fechaultimadonacion = date("d-m-Y", strtotime($fudnc["fechaDonacion"]));
            $fechaactual = date("d-m-Y");
            if(!empty($fudnc)){

                if($genero == "Hombre"){
                    $fechacuandopuededonar= date("d-m-Y", strtotime($fudnc["fechaDonacion"]."+ 3 month"));
                }
                else{
                    $fechacuandopuededonar = date("d-m-Y", strtotime($fudnc["fechaDonacion"]."+ 4 month"));
                }
                echo "  
                            <table class='striped highlight responsive-table'>
                               <tr>
                                    <th><b>Ultima donacion</b> </th>
                                    <td><b>".$fechaultimadonacion."</b></td>
                                </tr>
                                <tr>
                                    <th><b>Podras donar el : </b> </th>
                                    <td><b>".$fechacuandopuededonar."</b></td>
                                </tr>
                                <tr>
                                    <th><b>Podras donar en : </b> </th>
                                    <td><b>
                    ";
                    $dato1 = new DateTime("$fechacuandopuededonar");
                    $dato2 = new DateTime("$fechaactual");
                    $interval = $dato1->diff($dato2);

                if($dato1>$dato2){
                    echo $interval->format('%a días'); " </b></td>
                    </tr>";
                }else{
                    echo "Ya puedes donar</b></td>
                    </tr>";
                }

            }else{
                echo " <div><h4>No hay fecha </h4></div>";
            }
        }

        /*function Obtenerlistarut($rut)
        {
            require("../modelo/conexion.php");
            $consulta = "SELECT campana.*, estadocampana.nomEstado
            FROM campana INNER JOIN estadocampana ON campana.FK_Estado = estadocampana.idEstadoCampana
            WHERE campana.FK_Rut_Usuario = '$rut'"
            $resultados = mysqli_query($conexion, $consulta);
            if(mysqli_num_rows($resultados) > 0){

                echo    "<table class='striped highlight responsive-table'>
                            <thead>
                                <tr>
                                    <th>Fecha Camapaña</th>
                                    <th>Nombre Beneficiario</th>
                                    <th>Estado de la campaña</th>
                                </tr>
                            </thead>
                            <tbody>

                        ";

                while($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH)){
                    $fechaCampana = date("d-m-Y", strtotime($fila["fechaCampana"]));
                    $nombreP = $file["nombresPersona"];
                    $apellidoP = $fila["apellidosPersona"];
                    $nomEstado = $file["nomEstado"];

                    echo "  <tr>
                            <td>".$fechaCampana."</td>
                            <td>".$nombreP." ".$apellidoP."</td>
                            <td>".$nomEstado."</td>

                            </tr>

                    ";
                }
                        echo "</tbody>
                              </table>";

            }
        }*/

    }

?>
