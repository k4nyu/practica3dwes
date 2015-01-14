<?php

class Usuario{
    
    private $login;
    private $clave;
    private $nombre;
    private $apellidos;
    private $email;
    private $fechaalta;
    private $isactivo;
    private $isroot;
    private $rol;
    private $fechalogin;
    
    function __construct($login=null, $clave=null, $nombre=null, $apellidos=null, $email=null, $fechaalta=null, $isactivo=0, $isroot=0, $rol='usuario') {
        $this->login = $login;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->fechaalta = $fechaalta;
        $this->isactivo = $isactivo;
        $this->isroot = $isroot;
        $this->rol = $rol;
    }
    
    function set($datos, $inicio=0){
        $this->login= $datos[0+$inicio];
        $this->clave= $datos[1+$inicio];
        $this->nombre= $datos[2+$inicio];
        $this->apellidos= $datos[3+$inicio];
        $this->email= $datos[4+$inicio];
        $this->fechaalta= $datos[5+$inicio];
        $this->isactivo= $datos[6+$inicio];
        $this->isaoot= $datos[7+$inicio];
        $this->rol= $datos[8+$inicio];
        $this->fechalogin= $datos[9+$inicio];
    }
    
    public function getJSON(){
        $prop = get_object_vars($this);//todas las variables de instancia de esta clase
        $resp = '{';
        foreach ($prop as $key => $value){
            $resp.='"' . $key . '":'.json_encode(htmlspecialchars_decode($value)).',';
        }
        $resp = substr($resp, 0, -1)."}";
        return $resp;
    }
    
    function getLogin() {
        return $this->login;
    }

    function getClave() {
        return $this->clave;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getFechaalta() {
        return $this->fechaalta;
    }

    function getIsActivo() {
        return $this->isactivo;
    }

    function getIsRoot() {
        return $this->isroot;
    }

    function getRol() {
        return $this->rol;
    }

    function getFechalogin() {
        return $this->fechalogin;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setFechaalta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }

    function setIsActivo($isactivo=0) {
        $this->isactivo = $isactivo;
    }

    function setIsRoot($isroot=0) {
        $this->isroot = $isroot;
    }

    function setRol($rol='usuario') {
        $this->rol = $rol;
    }

    function setFechalogin($fechalogin) {
        $this->fechalogin = $fechalogin;
    }

}
