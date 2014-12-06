<?php

class Persona{
    
    private $id;
    private $nombre;
    private $apellido;
    
    function __construct($id=null, $nombre=null, $apellido=null){
        $this->id=$id;
        $this->nombre=$nombre;
        $this->apellido=$apellido;
    }
    
    function set($datos, $inicio=0){
        $this->id= $datos[0+$inicio];
        $this->nombre= $datos[1+$inicio];
        $this->apellido= $datos[2+$inicio]; 
    }
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }


}

