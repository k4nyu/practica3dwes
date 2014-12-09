<?php
    include "../clases/BaseDatos.php";
    include "../clases/Configuracion.php";
    include "../clases/Leer.php";
    include "../clases/Subir.php";
    include "../clases/anuncio/Anuncio.php";
    include "../clases/foto/Foto.php";
    include "../clases/anuncio/ModeloAnuncio.php";
    include "../clases/foto/ModeloFoto.php";
    
    $baseDatos = new BaseDatos(); 
    $titulo = Leer::post("titulo");
    $precio = Leer::post("precio");
    $descripcion = Leer::post("descripcion");
    $ciudad = Leer::post("ciudad");
    $direccion = Leer::post("direccion");
    $habitaciones = Leer::post("habitaciones");
    $servicios = Leer::post("servicios");
    $longitud = Leer::post("longitud");
    
    $archivo = new Subir("archivo");
    $archivo->setAccion(1);
    $archivo->subir();
    $nombrearchivo = $archivo->getNombre();

    $anuncio= new Anuncio(null, $titulo, $precio, $descripcion, $ciudad, $direccion, $habitaciones, $servicios, $longitud);
    $modelo=new ModeloAnuncio($baseDatos);
    $r = $modelo->add($anuncio);
    $idanuncio = $baseDatos->getAutonumerico();
    
    foreach($nombrearchivo as $key => $value){
        $foto= new Foto(null, $idanuncio, substr($nombrearchivo[$key], 3));
        $modelofoto = new ModeloFoto($baseDatos);
        $modelofoto->add($foto);
    }
    
    if($r === false){
        header("Location: ../viewadmin.php?resultado=error");
    }else{
        $cantidad = $baseDatos->getNumeroFila();
        $id = $baseDatos->getAutonumerico();
        header("Location: ../viewadmin.php?resultado=bien&cantidad=$cantidad&id=$id");
    }
    $baseDatos->closeConexion();