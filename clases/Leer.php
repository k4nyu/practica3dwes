<?php

/**
 * Class Leer
 * 
 * @version 0.9
 * @author Andrés Fuentes
 * @license 
 * @copyright 
 * 
 * Esta clase dispone de métodos éstaticos que s eutilizan para la lectura
 * de parametros de entrada a traves de get y post.
 */

class Leer {
    
    /**
     * Trata de leer el parámetro de entrada que se pasa como argumento.
     * @access public
     * @param string $param cadena con el nombre dle parámetro
     * @return string|array|null Devuelve una cadena con el valor del parámetro , null si
     * el parámetro no se ha pasado y un array si el parámetro es múltiple
     */
    public static function get($param, $filtrar=true){
        if(isset($_GET[$param])){
            $v = $_GET[$param];
            if(is_array($v)){
                return Leer::leerArray($v);
            }else{
                if($filtrar){
                    return Leer::limpiar(Leer::limpiar($_GET[$param]));
                }else{
                    return $v;
                }
            }
        }else{
            return null;
        }
    }
    
    public static function isArray($param){
        if(isset($_GET[$param])){
            return is_array($_GET[$param]);
        }elseif (isset($_POST[$param])){
            return is_array($_POST[$param]);
        }
        return null;
    }

    public static function isArrayV2($param){
        return is_array(Leer::request($param));
    }
    
    private static function leerArray($param, $filtrar=true){
        $array = array();
        foreach($param as $key => $value){
            if($filtrar){
                $array[] = Leer::limpiar($value);
            }else{
                $array[]=$value;
            }
        }
        return $array;
    }
    
    public static function post($param, $filtrar=true){
        if(isset($_POST[$param])){
            $v = $_POST[$param];
            if(is_array($v)){
                return Leer::leerArray($v);
            }else{
                if($filtrar){
                    return Leer::limpiar($_POST[$param]);
                }else{
                    return $v;
                }
            }
        }else{
            return null;
        }
    }
    
    public static function request($param, $filtrar=true){
        $v = Leer::get($param, $filtrar);
        if($v ==null){
            $v = Leer::post($param, $filtrar);
        }else{
            $v = Leer::get($param);
        }
        if(isset($_GET[$param])){
            if($filtrar){
                return Leer::limpiar($_GET[$param]);
            }
            return $v;
        }else{
            return null;
        }
    }
    private static function limpiar($param){
        return htmlspecialchars($param);
    }
}