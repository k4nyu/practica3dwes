<?php
require "require/comun.php";

$bd= new BaseDatos();
$login = Leer::post("login");
$clave = Leer::post("password");
$claveConfirmada = Leer::post("password2");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
$isactivo = Leer::post("isactivo");
$isroot = Leer::post("isroot");
$rol = Leer::post("rol");
$fechaalta = null;
$usuario = new Usuario($login, $clave, $nombre, $apellidos, $email, $fechaalta, $isactivo, $isroot, $rol);
$modelo= new ModeloUsuario($bd);
$resultado = $modelo->edit($usuario);
if($resultado === false){
    header("Location: viewactualizadoadmin.php?r=-1");
}else{
    $cantidad = $bd->getNumeroFila();
    $id = $bd->getAutonumerico();
    header("Location: viewactualizadoadmin.php?r=1");
}
$bd->closeConexion();
