<?php

require "require/comun.php";

$login = Leer::post("login");
$clave = Leer::post("password");
$repite = Leer::post("password2");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
$l=0;$c=0;$cr=0;$n=0;$a=0;$e=0;$i=0;

echo $login;

$bd = new BaseDatos();
$modelo=new ModeloUsuario($bd);

$error="";
$r=0;

if($nombre == ""){
    $error.="&n=-1";
    $r=-1;
}else{
    $error.="=&nombre=$nombre";
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

if($clave != $repite){
    $error.="&i=-1";
    $r=-1;
} 
if($r==-1){
    
    header("Location: viewpanelusuario.php?".$error."&login=".$login);
}
elseif($clave=="" && $repite==""){
   $usuario= new Usuario($login, $clave, $nombre, $apellidos, $email);
   $usuariorescatado = $modelo->getLogin($login);
   $claverescatada=$usuariorescatado->getClave();
   $usuario->setClave($claverescatada);
   $modelo->edit($usuario);
   header("Location: viewactualizado.php?r=1&login=$login");
   $bd->closeConexion();
}
else{
   $usuario= new Usuario($login, $clave, $nombre, $apellidos, $email);
   $modelo->edit($usuario);
   header("Location: viewactualizado.php?r=1&login=$login");
   $bd->closeConexion();
}