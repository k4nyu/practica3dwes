<?php
require 'require/comun.php'; 

$login = Leer::post("login");
$clave = Leer::post("password");

$r= 0;
if($login == null || $clave==null){
    $r=-2;
    header("Location: viewlogin.php?r=$r&nombre=$nombre");
}
else{
    $bd = new BaseDatos();
    $modelo=new ModeloUsuario($bd);
    $usuario= $modelo->get($login, $clave);
    if($usuario == null){
        $r=-1;
        header("Location: viewlogin.php?r=$r");
    }
    else{
        $rol = $usuario->getRol();
        if($rol == "usuario"){
            $r=1;
            $nombre = $usuario->getNombre();
            $sesion->set("__usuario", $usuario);
            $modelo->actualizaFechalogin($usuario);
            header("Location: viewindex.php?r=$r&login=$login");
        }
        if($rol == "administrador"){
            $r=1;
            $nombre = $usuario->getNombre();
            $sesion->set("__usuario", $usuario);
            $modelo->actualizaFechalogin($usuario);
            header("Location: viewadmin.php?r=$r&login=$login");
        }
    }
   $bd->closeConexion();
}

