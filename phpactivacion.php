<?php

require "require/comun.php";

$id= Leer::get("id");
$login = Leer::get("login");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$usuario = $modelo->getLogin($login);
$email = $usuario->getEmail();
$comparacion = sha1($email.Configuracion::PEZARANA.$login);

if($id === $comparacion){
    $usuario->setIsActivo(1);
    $modelo->edit($usuario);
    header("Location: viewactivado.php?r=1");
}
else{
    header("Location: viewactivado.php?r=-1");
}
