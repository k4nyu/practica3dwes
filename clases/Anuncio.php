<?php

class Anuncio{
    
    private $idanuncio, $titulo, $precio, $tipo, $descripcion, $fechaalta, $ciudad, $direccion, $habitaciones, $servicios, $longitud;
    
    function __construct($idanuncio=null, $titulo=null, $precio=null, $tipo="venta", 
            $descripcion=null, $fechaalta=null, $ciudad=null, $direccion=null, $habitaciones=null,
            $servicios=null,$longitud=null){
        $this->idanuncio=$idanuncio;
        $this->titulo=$titulo;
        $this->precio=$precio;
        $this->tipo=$tipo;
        $this->descripcion=$descripcion;
        $this->fechaalta=$fechaalta;
        $this->ciudad=$ciudad;
        $this->direccion=$direccion;
        $this->habitaciones=$habitaciones;
        $this->servicios=$servicios;
        $this->longitud=$longitud;
    }
    
    function set($datos, $inicio=0){
        $this->idanuncio= $datos[0+$inicio];
        $this->titulo= $datos[1+$inicio];
        $this->precio= $datos[2+$inicio];
        $this->tipo= $datos[3+$inicio];
        $this->descripcion= $datos[4+$inicio]; 
        $this->fechaalta= $datos[5+$inicio]; 
        $this->ciudad= $datos[6+$inicio]; 
        $this->direccion= $datos[7+$inicio]; 
        $this->habitaciones= $datos[8+$inicio]; 
        $this->servicios= $datos[9+$inicio]; 
        $this->longitud= $datos[10+$inicio]; 
    }
    
    function getIdanuncio() {
        return $this->idanuncio;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFechaalta() {
        return $this->fechaalta;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getHabitaciones() {
        return $this->habitaciones;
    }

    function getServicios() {
        return $this->servicios;
    }

    function getLongitud() {
        return $this->longitud;
    }

    function setIdanuncio($idanuncio) {
        $this->idanuncio = $idanuncio;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFechaalta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setHabitaciones($habitaciones) {
        $this->habitaciones = $habitaciones;
    }

    function setServicios($servicios) {
        $this->servicios = $servicios;
    }

    function setLongitud($longitud) {
        $this->longitud = $longitud;
    }

}

