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
    $id = Leer::get("id");
    $anuncio = new Anuncio($id);
    $modelo =  new ModeloAnuncio($baseDatos);
    $resultado = $modelo->delete($anuncio);
    
    if($resultado == -1){
        header("Location: ../viewadmin.php?resultado=error");
    }else{
        $cantidad = $baseDatos->getNumeroFila();
        $id = $baseDatos->getAutonumerico();
        header("Location: ../viewadmin.php?op=delete&resultado=bien&cantidad=$cantidad&id=$id");
    }
    $baseDatos->closeConexion();
