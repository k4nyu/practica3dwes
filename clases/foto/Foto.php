<?php

class Foto{
    private $idfoto, $idanuncio, $urlfoto; 
    
    function __construct($idfoto = null, $idanuncio = null, $urlfoto= null) {
        $this->idfoto = $idfoto;
        $this->idanuncio = $idanuncio;
        $this->urlfoto = $urlfoto;
    }
    
    function set($datos, $inicio = 0){
        $this->idfoto = $datos[0+ $inicio];
        $this->idanuncio = $datos[1+ $inicio];
        $this->urlfoto = $datos[2+ $inicio];
    }
    
    function getIdfoto() {
        return $this->idfoto;
    }

    function getIdanuncio() {
        return $this->idanuncio;
    }

    function getUrlfoto() {
        return $this->urlfoto;
    }

    function setIdfoto($idfoto) {
        $this->idfoto = $idfoto;
    }

    function setIdanuncio($idanuncio) {
        $this->idanuncio = $idanuncio;
    }

    function setUrlfoto($urlfoto) {
        $this->urlfoto = $urlfoto;
    }


}