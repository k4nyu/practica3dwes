<?php

class ModeloFoto{
    
    private $bd;
    private $tabla="foto";
    
    function __construct(BaseDatos $bd){
        $this->bd=$bd;
    }
    
    function add(Foto $objeto){
        $sql="insert into $this->tabla values(null, :idanuncio, :urlfoto);";
        $parametros["idanuncio"]=$objeto->getIdanuncio();
        $parametros["urlfoto"]=$objeto->getUrlfoto();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function delete (Foto $objeto){
        $sql="delete from $this->tabla where idfoto=:idfoto";
        $parametros["idfoto"]=$objeto->getIdfoto();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function deletePorIdfoto($idfoto){
        return $this->delete(new Foto($idfoto));
    }
    
    function edit(Foto $objeto){
        $sql="update $this->tabla set urlfoto=:urlfoto, idanuncio=:idanuncio where idfoto=:idfoto;";
        $parametros["urlfoto"]=$objeto->getUrlfoto();
        $parametros["idanuncio"]=$objeto->getIdanuncio();
        $parametros["idfoto"]=$objeto->getIdfoto();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    function editPK(Foto $objetoOriginal, Foto $objetoNuevo){
        $sql="update $this->tabla set idanuncio=:idanuncio, urlfoto=:urlfoto where idfoto=:idfotopk;";
        $parametros["idanuncio"]=$objetoNuevo->getIdanuncio();
        $parametros["urlfoto"]=$objetoNuevo->getUrlfoto();
        $parametros["idfoto"]=$objetoNuevo->getIdfoto();
        $parametros["idfotopk"]=$objetoOriginal->getIdfoto();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function get($idfoto){
        $consultaSql = "select * from $this->tabla where idfoto=:idfoto";
        $arrayConsulta["idfoto"]=$idfoto;
        $resultado= $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if($resultado){
            $foto= new Foto();
            $foto->set($this->bd->getFila());
            return $foto;
        }
        return null;
    }
    
    function getFotoIdCasa($idanuncio) {
        $sql = "select * from $this->tabla where idanuncio= :idanuncio";
        $parametros["idanuncio"] = $idanuncio;
        $r = $this->bd->setConsulta($sql, $parametros);
        $arrayFotos = array();
        if ($r) 
        {
            while ($fila = $this->bd->getFila()) 
            {
                $foto = new Foto();
                $foto->set($fila);
                $arrayFotos[] = $foto;
            }            
            return $arrayFotos;
        }
        return null;
    }
    
    function count($condicion="1=1", $parametros=array()){
        $sql="select count(*) from $this->tabla where $condicion";
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            $variable = $this->bd->getFila();
            return $variable[0];
        }
        return -1;
    }
    
    function getFotos($pagina=0, $rpp=10, $condicion="1=1", $parametros=array(), $orderby=1){
        $list=array();
        $principio = $pagina*$rpp;
        $sql="select * from $this->tabla where $condicion order by $orderby limit $principio, $rpp";
        $r=$this->bd->setConsulta($sql, $parametros);
        if($r){
            while($fila=$this->bd->getFila()){
                $foto= new Foto();
                $foto->set($fila);
                $list[]=$foto;
            }
        } else{
            return null;
        }    
        return $list;
    }
    
    function selectHtml($idfoto, $name, $condicion, $parametros, $valorSeleccionado="", $blanco=true, $textoBlanco="&nbsp;"){
        $select="<select name='$name' id='$id'>";
        if($blanco){
            $select.="<option value=''>$textoBlanco</option>";
        }
        $select.="</select>";
        return $select;
    }
    
}