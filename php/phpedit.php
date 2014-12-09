<?php
include "../clases/BaseDatos.php";
    include "../clases/Configuracion.php";
    include "../clases/Leer.php";
    include "../clases/Subir.php";
    include "../clases/anuncio/Anuncio.php";
    include "../clases/foto/Foto.php";
    include "../clases/anuncio/ModeloAnuncio.php";
    include "../clases/anuncio/ModeloFoto.php";

$bd= new BaseDatos();
$id = Leer::post("id");
$titulo = Leer::post("titulo");
$precio = Leer::post("precio");
$descripcion = Leer::post("descripcion");
$ciudad = Leer::post("ciudad");
$direccion = Leer::post("direccion");
$habitaciones = Leer::post("habitaciones");
$servicios = Leer::post("servicios");
$longitud = Leer::post("longitud");
$anuncio = new Anuncio($id, $titulo, $precio, $descripcion, $ciudad, $direccion, $habitaciones, $servicios, $longitud);
$modelo= new ModeloAnuncio($bd);
$resultado = $modelo->edit($anuncio);
if($resultado === false){
    header("Location: ../viewadmin.php?resultado=error");
}else{
    $cantidad = $bd->getNumeroFila();
    $id = $bd->getAutonumerico();
    header("Location: ../viewadmin.php?resultado=bien&cantidad=$cantidad&id=$id");
}
$bd->closeConexion();