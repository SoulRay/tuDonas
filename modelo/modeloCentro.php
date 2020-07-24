<?php
    class Centros
    {
        private $nombre;
        private $direccion;
        private $latitud;
        private $longitud;
        private $tipo;
        private $telefono;
        private $pagina;

        /**
         * Get the value of nombre
         */
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of direccion
         */
        public function getDireccion()
        {
                return $this->direccion;
        }

        /**
         * Set the value of direccion
         *
         * @return  self
         */
        public function setDireccion($direccion)
        {
                $this->direccion = $direccion;

                return $this;
        }

        /**
         * Get the value of latitud
         */
        public function getLatitud()
        {
                return $this->latitud;
        }

        /**
         * Set the value of latitud
         *
         * @return  self
         */
        public function setLatitud($latitud)
        {
                $this->latitud = $latitud;

                return $this;
        }

        /**
         * Get the value of longitud
         */
        public function getLongitud()
        {
                return $this->longitud;
        }

        /**
         * Set the value of longitud
         *
         * @return  self
         */
        public function setLongitud($longitud)
        {
                $this->longitud = $longitud;

                return $this;
        }

        /**
         * Get the value of tipo
         */
        public function getTipo()
        {
                return $this->tipo;
        }

        /**
         * Set the value of tipo
         *
         * @return  self
         */
        public function setTipo($tipo)
        {
                $this->tipo = $tipo;

                return $this;
        }

        /**
         * Get the value of telefono
         */
        public function getTelefono()
        {
                return $this->telefono;
        }

        /**
         * Set the value of telefono
         *
         * @return  self
         */
        public function setTelefono($telefono)
        {
                $this->telefono = $telefono;

                return $this;
        }

        /**
         * Get the value of pagina
         */
        public function getPagina()
        {
                return $this->pagina;
        }

        /**
         * Set the value of pagina
         *
         * @return  self
         */
        public function setPagina($pagina)
        {
                $this->pagina = $pagina;

                return $this;
        }

        function ingresarCentro($nombre,$direccion,$latitud,$longitud,$tipo,$telefono,$pagina)
        {
            require("../modelo/conexion2.php");
            $consulta = "INSERT INTO centros (id, nombre, direccion, lat, lng, tipo, tel, web) VALUES (0,'$nombre','$direccion','$latitud','$longitud','$tipo','$telefono','$pagina')";
            $resultados = mysqli_query($conexion,$consulta);
            if(mysqli_affected_rows($conexion) > 0)
            {
              ?> <script>
                M.toast({
                  html: 'Centro guardado',
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
            mysqli_close($conexion);
        }

        function eliminarCentro($nombre)
        {
                require('../modelo/conexion2.php');
                $consulta = "DELETE FROM centros WHERE nombre='$nombre'";
                $resultados = mysqli_query($conexion,$consulta);
                if($resultados = false){
                        echo "SIN RESULTADOS";
                }
                else
                {
                if(mysqli_affected_rows($conexion) != 0)
                {
                        ?><script>
                        M.toast({
                        html: 'Centro eliminado',
                        displayLength: 3000,
                        inDuration: 500,
                        outDuration: 500,
                        classes: 'rounded'
                        });
                        </script> <?php
                }
                else
                {
                        echo "<b class='red-text'>Error al eliminar</b>";
                }
                }
                mysqli_close($conexion);
        }

        function listarEliminarCentro(){
          require("../modelo/conexion2.php");
          $query = 'SELECT * FROM centros';
          $result = mysqli_query($conexion, $query) or die (mysqli_error());
          echo "<option disabled selected>Seleccione el Centro</option>";
          while ($row=mysqli_fetch_array($result)) { ?>
            <option value="<?php echo $row['nombre']?>"> <?php echo $row['nombre']?> </option>
          <?php }
        }

        function verCentrosTabla(){
          require("../modelo/conexion2.php");
          $query = 'SELECT * FROM centros WHERE tipo = "Banco de sangre"';
          $result = mysqli_query($conexion, $query) or die (mysqli_error());
          if (mysqli_num_rows($result) > 0){
            echo "
            <table border='1' width='100%' class='striped responsive-table'>
              <thead>
                <tr class='blue darken-4'>
                  <td><span style='color: #ffffff; padding: 2px; font-size: 8pt;'>Lugar de atención</span></td>
                  <td><span style='color: #ffffff; padding: 2px; font-size: 8pt;'>Dirección</span></td>
                  <td><span style='color: #ffffff; padding: 2px; font-size: 8pt;'>Telefono</span></td>
                  <td><span style='color: #ffffff; padding: 2px; font-size: 8pt;'>Pagina Web</span></td>
                </tr>
              </thead>
            ";
            ?>

            <?php while ($row=mysqli_fetch_array($result)) { ?>
            <tr class="hoverable">
                <td><?php echo $row['nombre'] ?></td>
                <td><a href="http://maps.google.com?q=<?php echo $row ['lat']?>,<?php echo $row ['lng']?>"> <?php echo $row['direccion'] ?> </a></td>
                <td><?php echo $row['tel'] ?></td>
                <td> <a href="<?php echo $row['web'] ?>"> <?php echo $row['web'] ?> </a></td>
            </tr>

            <?php }
            echo "</table>";
          }
          else{
            echo "No hay centros registrados";
          }
        }
}
?>
