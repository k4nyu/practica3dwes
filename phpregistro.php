<?php

require "require/comun.php";

$login = Leer::post("login");
$clave = Leer::post("password");
$repite = Leer::post("password2");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
$l=0;$c=0;$cr=0;$n=0;$a=0;$e=0;$i=0;

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
    header("Location: viewregistro.php?".$error);
}
else{
   $usuario= new Usuario($login, $clave, $nombre, $apellidos, $email);
   $modelo->add($usuario);
   $id=sha1($email.Configuracion::PEZARANA.$login);
   Correo::enviarGmail("kanyu.mike@gmail.com", "kanyu.mike@gmail.com", "magictg20_google",
           "Activación de cuenta en FotoCasa", "¡Hola .".$nombre."! Haz click en el siguiente enlace para terminar de activar tu nueva cuenta: "
           .Entorno::getEnlaceCarpeta("phpactivacion.php?id=$id&login=$login"));
   header("Location: viewregistrado.php?r=1");
   $bd->closeConexion();
}





    