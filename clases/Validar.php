<?php

class Validar{
    
    static function isAltaUsuario($login, $clave, $claveConfirmada, $nombre, $apellidos, $correo){
        return self::isLogin($login) && ($clave == $claveConfirmada) && self::isCorreo($correo) && self::isClave($clave) && strlen($nombre) > 1 && strlen($apellidos) >2; 
    }
    
    static function isCorreo($v){
        return filter_var($v, FILTER_VALIDATE_EMAIL);
    }
    
    static function isEntero($v){
        return filter_var($v, FILTER_VALIDATE_INT);
    }
    
    static function isNumero($v){
        return filter_var($v, FILTER_VALIDATE_FLOAT);
    }
    
    static function isTelefono($v){
        //deberes para casa
    }
    
    static function isURL($v){
        return filter_var($v, FILTER_VALIDATE_URL);
    }
    
    static function isIP($v){
        return filter_var($v, FILTER_VALIDATE_IP);
    }
    
    static function isFecha($v){
        //deberes para casa
    }
    
    static function isDNI($v){
        //deberes para casa
    }
    
    static function isCP($v){
        //deberes para casa
//        PP
//        01 0 cp 01-99 distrito, localidad, municipio
//        52 1-9 ncp
    }
    
    static function isLongitud($v, $lmin=0, $lmax=-1){
        //deberes para casa
    }
    
    static function isScript($v){
        //deberes para casa
    }
    
    static function isLogin($v){
        return self::isCondicion($v, '/^[A-Za-z][A-Za-z0-9](5,9)$/');
        //1º empiezan con /
        //2º acaban con /
        //3º ^x empieza con x
        //x$ acaba con x
    }
    
    static function isClave($v){
        return self::isCondicion($v, '/[A-Za-z0-9](6,10)$/');
    }
    
    static function isCondicion($v, $condicion){
        return preg_match($condicion, $v);
    }
    
}
