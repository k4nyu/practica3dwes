<?php

class Foto{
    private $idfoto, $idanuncio, $urlfoto; 
    
    function __construct($idfoto = null, $idanuncio = null, $urlfoto= null) {
        $this->idfoto = $idfoto;
        $this->idanuncio = $idanuncio;
        $this->urlfoto = $urlfoto;
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