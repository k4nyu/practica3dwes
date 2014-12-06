<?php

class ModeloPersona{
    private $bd;
    private $tabla="persona";
    
    function __construct(BaseDatos $bd){
        $this->bd=$bd;
    }
    
    function add(Persona $objeto){
        $sql="insert into $this->tabla values(null, :nombre, :apellido);";
        $parametros["nombre"]=$objeto->getNombre();
        $parametros["apellido"]=$objeto->getApellido();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function delete (Persona $objeto){
        $sql="delete from $this->tabla where id=:id";
        $parametros["id"]=$objeto->getId();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function deletePorId($id){
        return $this->delete(new Persona($id));
    }
    
    function edit(Persona $objeto){
        $sql="update $this->tabla set nombre=:nombre, apellido=:apellido where id=:id;";
        $parametros["nombre"]=$objeto->getNombre();
        $parametros["apellido"]=$objeto->getApellido();
        $parametros["id"]=$objeto->getId();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function editPK(Persona $objetoOriginal, Persona $obejtoNuevo){
        $sql="update $this->tabla set nombre=:nombre, apellido=:apellid where id=:id;";
        $parametros["nombre"]=$objetoNuevo->getNombre();
        $parametros["apellido"]=$objetoNuevo->getApellido();
        $parametros["id"]=$objetoNuevo->getId();
        $parametros["ipdk"]=$objetoOriginal->getId();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function get($id){
        $consultaSql = "select * from $this->tabla where id=:id";
        $arrayConsulta["id"]=$id;
        $resultado= $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if(!$resultado){
            $persona= new Persona();
            $persona->set($this->bd->getFila());
            return $persona;
        }
        //return new Persona();
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
    
    function getPersonas($pagina=0, $rpp=10, $condicion="1=1", $parametros=array(), $orderby="apellidos, nombre"){
        $list=array();
        $principio = $pagina*$rpp;
        $sql="select * from $this->tabla where $condicion order buy $orderby limit $principio, $rpp";
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            while($fila=$this->bd->getFila()){
                $persona= new Persona();
                $persona->set($fila);
                $list[]=$persona;
            }
        } else{
            return null;
        }    
        return $list;
    }
    
    function selectHtml($id, $name, $condicion, $parametros, $valorSeleccionado="", $blanco=true, $textoBlanco="&nbsp;"){
        $select="<select name='$name' id='$id'>";
        if($blanco){
            $select.="<option value=''>$textoBlanco</option>";
        }
        $select.="</select>";
        return $select;
    }
    
}
