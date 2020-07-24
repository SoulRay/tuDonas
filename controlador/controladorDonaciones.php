<?php

include_once("../modelo/modeloDonaciones.php");

$d = new Donaciones();

if(isset($_POST["txtFechaDonacion"])){

    $d->setFechaDonacion($_POST["txtFechaDonacion"]);
    $fechaDonacion = $d->getFechaDonacion();
    $d->setDireccion($_POST["txtDireccion"]);
    $direccion = $d->getDireccion();
    $d->setFKRutDonante($_POST["FK_RutDonante"]);
    $FKRutDonante = $d->getFKRutDonante();
    $d->setFKTipoLugar($_POST["FK_TipoLugar"]);
    $FKTipoLugar = $d->getFKTipoLugar();
    $fechaIngresada = date("d-m-Y", strtotime($_POST["fdonacionact"]));
    $genero = $_POST["genero"];

    if($d->ComprobarFecha($fechaIngresada,$genero,$FKRutDonante)){
        $d->IngresarDonacion($fechaDonacion,$direccion,$FKRutDonante,$FKTipoLugar);
    }else{
        ?> <script>
        alert("La fecha ingresada no es valida");
        </script>  <?php
    }
}elseif(isset($_POST["cargarDonacion"])){
    $d->setFKRutDonante($_POST["rut"]);
    $rut = $d->getFKRutDonante();
    $d->ObtenerListaDonaciones($rut);

}elseif(isset($_POST["idDon"])){

    $d->setFKRutDonante($_POST["vrut"]);
    $rut = $d->getFKRutDonante();
    $idd = $_POST["idDon"];
    $d->EliminarDonacion($idd);
    $d->ObtenerListaDonaciones($rut);
}
elseif(isset($_POST["cfrut"])){
    $rut = $_POST["cfrut"];
    $gen = $_POST["cfgen"];
    $d->Fechas($rut,$gen);
}
else{
    echo "Error Else de controladorDonaciones.php";
}



?>
