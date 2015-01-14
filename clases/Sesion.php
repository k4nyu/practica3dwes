<?php
class Sesion {
    function __construct($name="") {
        if($name!="" && $name!=null){
            session_name($name);            
        }
        session_start();
    }
    
    public function set($nombre, $valor){        
            if(isset($_SESSION[$nombre])){
                $_SESSION[$nombre] = $valor;
                return true;
            }else{
                $_SESSION[$nombre] = $valor;
            }

    }
    
    public function add($nombre, $valor){
        if(!isset($_SESSION[$nombre])){
            $_SESSION[$nombre] = $valor;
            return true;
        }else{
            return false;
        }
    }
    
    public function get($nombre){
        if(isset($_SESSION[$nombre])){
            return $_SESSION[$nombre];
        }else{
            return null;
        }
    }
    
    public function getNombres(){
        $array = Array();
        foreach ($_SESSION as $key => $value) {
            $array[] = $key;
        }
        return $array;
    }
    
    public function delete($nombre){
        if($nombre=""){
            unset($_SESSION);
        }else{
            if($_SESSION[$nombre]!=null){
                unset($_SESSION[$nombre]);
                return true;
            }else{
                return false;
            }
        
        }
    }
    
    public function deleteAll(){
        unset($_SESSION);
        return true;
    }
    
    public function destroy(){
        session_destroy(); 
   }


    public function isSesion(){
        if (!empty($_SESSION)){
            return true;
        }else{
            return false;
        }
    }
    
    public function isAutentificado(){
        $a = 0;
        foreach ($_SESSION as $key => $value) {
            if($value!=null&&$value!=""){
                $a++;
            }            
        }
        if($a==0){
            return false;
        }else{
            return true;
        }
    }
    public function setUsuario($valor){
        if($valor!=""){
            $_SESSION["usuario"] = $valor;
        }else{
            return false;
        }
    }
    public function getUsuario(){
        if($_SESSION["usuario"]!=null && $_SESSION["usuario"]!=""){
            return $_SESSION["usuario"];
        }else{
            return false;
        }
        
    }
}

?>
