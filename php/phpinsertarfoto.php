<?php
require "../require/comun.php";
include "../clases/BaseDatos.php";
include "../clases/Configuracion.php";
include "../clases/Leer.php";
include "../clases/Subir.php";
include "../clases/anuncio/Anuncio.php";
include "../clases/foto/Foto.php";
include "../clases/anuncio/ModeloAnuncio.php";
include "../clases/foto/ModeloFoto.php"; 
 $baseDatos = new BaseDatos();
 $id= Leer::post("id");
 $idanuncio = $id;
 $archivo = new Subir("archivo");
 $archivo->setAccion(1);
 $archivo->subir();
 $nombrearchivo = $archivo->getNombre();
 foreach($nombrearchivo as $key => $value){
        $foto= new Foto(null, $idanuncio, substr($nombrearchivo[$key], 3));
        $modelofoto = new ModeloFoto($baseDatos);
        $modelofoto->add($foto);
 }
 if($r === false){
        header("Location: ../viewedit.php?resultado=error");
    }else{
        $cantidad = $baseDatos->getNumeroFila();
        $id = $baseDatos->getAutonumerico();
        header("Location: ../viewedit.php?resultado=bien&cantidad=$cantidad&id=$idanuncio");
    }
    $baseDatos->closeConexion();