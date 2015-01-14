<?php

require "require/comun.php";

$password = Leer::post("password");
$passwordcheck= Leer::post("password2");
$claveenviada = Leer::post("clave");
$login = Leer::post("login");
$parametros = array();
$orderby = 1;

$bd = new BaseDatos();
$modelo = new ModeloUsuario(($bd));

if($password == $passwordcheck && $password !="" && $passwordcheck !=""){
    $usuario = $modelo->getUsuarios("login='$login'", $parametros, $orderby);
    $rescate = $usuario[0];
    $clave = sha1($password);
    $rescate->setClave($clave);
    $r=$modelo->edit($rescate);
    if($r!=-1){
        header("Location: viewrestablecida.php?r=1");
    }
}
elseif($password != $passwordcheck){
    header("Location: viewrecuperarclave.php?r=-1&u=$login&c=$claveenviada");
}
elseif($password == "" || $passwordcheck==""){
    header("Location: viewrecuperarclave.php?r=-2&u=$login&c=$claveenviada");
}

