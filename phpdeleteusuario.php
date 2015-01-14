<?php

require "require/comun.php";

$bd = new BaseDatos();
$login = Leer::get("id");
$usuario = new Usuario($login);
$modelo =  new ModeloUsuario($bd);
$r = $modelo->delete($usuario);

if($r == -1){
        header("Location: vieweditarusuarios.php?r=-1");
    }else{
        header("Location: vieweditarusuarios.php?r=1");
    }
    $baseDatos->closeConexion();