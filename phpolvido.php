<?php
require "require/comun.php";

$login = Leer::post("login");
$email = Leer::post("email");

$bd = new BaseDatos();
$parametros = array();
$orderby = 1;

$modelologin = new ModeloUsuario(($bd));

if($login!="" && $email==""){
    $usuario = $modelologin->getUsuarios("login='$login'", $parametros, $orderby);
    $contraseniarecuperada=$usuario[0]->getClave();
    $correousuario = $usuario[0]->getEmail();
    Correo::enviar("miguelangel@miguelangel.esy.es", $correousuario, "Recuperación de clave de usuario", "Se ha reestablecido tu contraseña, por favor, haz clic en el siguiente link para introducir una nueva: http://localhost:8008/tema2/Practica2/viewrecuperarclave.php?u=$login&c=$contraseniarecuperada");
    header("Location: viewrecuperando.html?r=1");
}
elseif($login=="" && $email!=""){
    $correo = $modelologin->getUsuarios("email='$email'", $parametros, $orderby);
    $loginrecuperado = $correo[0]->getLogin();
    Correo::enviarGmail("miguelangel@miguelangel.esy.es", $email , "Recuperación de clave de usuario", "<meta charset='UTF-8'>Aquí tienes tu login: ".$loginrecuperado." . Haz clic <a href='http://localhost:8008/tema2/php2/usuario/viewolvido.php'>aquí</a> para volver a la pantalla de login.");
    header("Location: viewrecuperando.html?r=1");
}
else{
    header("Location: viewolvido.php?r=-1");
}
$bd->closeConexion();