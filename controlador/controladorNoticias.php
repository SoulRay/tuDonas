<?php
  include("../modelo/modeloNoticias.php");
  $n = new Noticia();
  if(isset($_POST["mostrarNoticias"])){
    $n->cargarNoticias();
  }
  else if(isset($_POST["txtTituloNoticia"])){
    $titulo = $_POST["txtTituloNoticia"];
    $descripcion = $_POST["txtDescripcionNoticia"];
    $foto = $_FILES["imagenNoticia"]["name"];
    $rut = $_POST["txtRutNoticia"];
    $fecha = date("Y-m-d");
    $ruta = "../imagenNoticias/".$foto;
    if(!file_exists($ruta)){
      if(move_uploaded_file($_FILES["imagenNoticia"]["tmp_name"], $ruta)){
        $n->agregarNoticia($titulo,$descripcion,$ruta,$fecha,$rut);
      }
    }
    else{
      echo "<script>alert('Este archivo ya existe, prueba cambiandole el nombre a la imagen o ingresa otra');</script>";
    }
  }
  else if(isset($_POST["verNoticia"])){
    $urlnoticia = $_POST["verNoticia"];
    $n->verNoticia($urlnoticia);
  }
  else if(isset($_POST["textoBuscar"])){
    $texto = $_POST["textoBuscar"];
    $n->buscarNoticia($texto);
  }
  else if(isset($_POST["idEliminarNoticia"])){
    $idNoticia = $_POST["idEliminarNoticia"];
    $imagen = $_POST["rutaImagen"];
    $n->eliminarNoticia($idNoticia,$imagen);
  }
  else if(isset($_POST["mostrarDatosRuta"])){
    $ruta = $_POST["mostrarDatosRuta"];
    $n->mostrarDatosNoticia($ruta);
  }
  else if(isset($_POST["txtEditarTitulo"])){
    $titulo = $_POST["txtEditarTitulo"];
    $descripcion = $_POST["txtEditarDescripcion"];
    $ruta = $_POST["ruta"];
    if($_FILES["imagenNoticia"]["name"] == ""){
      $n->actualizarNoticia($titulo,$descripcion,$ruta,$ruta);
    }
    else{
      $nombre = $_FILES["imagenNoticia"]["name"];
      $ruta2 = "../imagenNoticias/".$nombre;
      if(!file_exists($ruta2)){
        unlink($ruta);
        if(move_uploaded_file($_FILES["imagenNoticia"]["tmp_name"],$ruta2)){
          $n->actualizarNoticia($titulo,$descripcion,$ruta,$ruta2);
        }
      }
      else{
        echo "<script>alert('Este archivo ya existe, prueba cambiandole el nombre a la imagen o ingresa otra');</script>";
      }
    }
  }
?>
