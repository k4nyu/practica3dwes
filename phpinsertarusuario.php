<?php

require "require/comun.php";

$login = Leer::post("login");
$clave = Leer::post("password");
$repite = Leer::post("password2");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
$isactivo = Leer::post("isactivo");
$isroot = Leer::post("isroot");
$rol = Leer::post("rol");

$l=0;$c=0;$cr=0;$n=0;$a=0;$e=0;$i=0;$ia=0;$ir=0;$ro=0;

$bd = new BaseDatos();
$modelo=new ModeloUsuario($bd);

$error="";
$r=0;
if($login == ""){
     $error.="l=-1";
     $r=-1;
}else{
    $error.="login=$login";
}

if($clave == ""){
    $error.="&c=-1";
    $r=-1;
}

if($repite == ""){
    $error.="&cr=-1";
    $r=-1;
}

if($nombre == ""){
    $error.="&n=-1";
    $r=-1;
}else{
    $error.="&nombre=$nombre";
}

if($apellidos == ""){
    $error.="&a=-1";
    $r=-1;
}else{
    $error.="&apellidos=$apellidos";
}

if($email == ""){
    $error.="&e=-1";
    $r=-1;
}else{
    $error.="&email=$email";
}

if($isactivo == ""){
    $error.="&ia=-1";
    $r=-1;
}else{
    $error.="&isactivo=$isactivo";
}

if($isroot == ""){
    $error.="&ir=-1";
    $r=-1;
}else{
    $error.="&isroot=$isroot";
}

if($rol == ""){
    $error.="&ro=-1";
    $r=-1;
}else{
    $error.="&rol=$rol";
}

if($clave != $repite){
    $error.="&i=-1";
    $r=-1;
} 
if($r==-1){
    header("Location: vieweditarusuarios.php?".$error);
}
else{
   $usuario= new Usuario($login, $clave, $nombre, $apellidos, $email, null, $isactivo, $isroot, $rol);
   $modelo->add($usuario);
   header("Location: vieweditarusuarios.php?r=1");
   $bd->closeConexion();
}
