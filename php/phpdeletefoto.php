<?php
    require '../require/comun.php'; 
    include "../clases/BaseDatos.php";
    include "../clases/Configuracion.php";
    include "../clases/Leer.php";
    include "../clases/Subir.php";
    include "../clases/anuncio/Anuncio.php";
    include "../clases/foto/Foto.php";
    include "../clases/anuncio/ModeloAnuncio.php";
    include "../clases/foto/ModeloFoto.php"; 
    
    $baseDatos = new BaseDatos(); 
    $id= Leer::get("id");
    $idanuncio = $id;
    $idfoto = Leer::get("idfoto");
    $foto = new Foto($idfoto);
    $modelo =  new ModeloFoto($baseDatos);
    $resultado = $modelo->delete($foto);
    
    if($resultado == -1){
        header("Location: ../viewedit.php?resultado=error");
    }else{
        $cantidad = $baseDatos->getNumeroFila();
        $id = $baseDatos->getAutonumerico();
        header("Location: ../viewedit.php?id=$idanuncio");
    }
    $baseDatos->closeConexion();


