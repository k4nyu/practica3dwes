<?php

class ModeloUsuario{
    private $bd;
    private $tabla="usuario";
    
    function __construct(BaseDatos $bd){
        $this->bd=$bd;
    }
    
    function add(Usuario $objeto){
        $sql="insert into $this->tabla values(:login, :clave, :nombre, :apellido, :email, curdate(), :isactivo, :isroot, :rol,  null);";
        $parametros["login"]=$objeto->getLogin();
        $parametros["clave"]=sha1($objeto->getClave());
        $parametros["nombre"]=$objeto->getNombre();
        $parametros["apellido"]=$objeto->getApellidos();
        $parametros["email"]=$objeto->getEmail();
        $parametros["isactivo"]=$objeto->getIsActivo();
        $parametros["isroot"]=$objeto->getIsRoot();
        $parametros["rol"]=$objeto->getRol();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $r;
    }
    
    function delete (Usuario $objeto){
        $sql="delete from $this->tabla where login=:login";
        $parametros["login"]=$objeto->getLogin();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function deletePorLogin($login){
        return $this->delete(new Usuario($login));
    }
    
    function edit(Usuario $objeto){
        $sql="update $this->tabla set clave=:clave, nombre=:nombre, apellido=:apellido, email=:email, isactivo=:isactivo, isroot=:isroot"
                . ", rol=:rol where login=:login";
        $parametros["login"]=$objeto->getLogin();
        $parametros["clave"]=$objeto->getClave();
        $parametros["nombre"]=$objeto->getNombre();
        $parametros["apellido"]=$objeto->getApellidos();
        $parametros["email"]=$objeto->getEmail();
        $parametros["isactivo"]=$objeto->getIsActivo();
        $parametros["isroot"]=$objeto->getIsRoot();
        $parametros["rol"]=$objeto->getRol();
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
//    function editPK(Persona $objetoOriginal, Persona $obejtoNuevo){
//        $sql="update $this->tabla set nombre=:nombre, apellido=:apellid where id=:id;";
//        $parametros["nombre"]=$objetoNuevo->getNombre();
//        $parametros["apellido"]=$objetoNuevo->getApellido();
//        $parametros["id"]=$objetoNuevo->getId();
//        $parametros["ipdk"]=$objetoOriginal->getId();
//        $r=$this->bd->setConsulta($sql, $parametros);
//        if(!$r){
//            return -1;
//        }
//        return $this->bd->getNumeroFila();//0
//    }
    
    function editConClave(Usuario $objeto, $login, $claveold){
        $asignacion = "login = :login, clave = :clave,"
                   . "nombre=:nombre, apellidos=:apellidos, "
                   . "email= :email";
        $condicion = "login = :loginpk and clave = :claveold";
        $parametros["login"]= $objeto->getLogin();
        $parametros["clave"]= sha1($objeto->getClave());
        $parametros["nombre"]= $objeto->getNombre();
        $parametros["apellidos"]= $objeto->getApellidos();
        $parametros["email"]= $objeto->getEmail();
        $parametros["loginpk"]= $login;
        $parametros["claveold"]= sha1($claveold);
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }
    
        function editSinClave(Usuario $objeto, $login, $claveold){
        $asignacion = "login = :login, nombre=:nombre, apellidos=:apellidos, email=:email";
        $condicion = "login=:login and clave=:claveold";
        $parametros["login"]= $objeto->getLogin();
        $parametros["nombre"]= $objeto->getNombre();
        $parametros["apellidos"]= $objeto->getApellidos();
        $parametros["email"]= $objeto->getEmail();
        $parametros["loginpk"]= $login;
        $parametros["claveold"]= sha1($claveold);
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }
    
    function editConsulta($asignacion, $condicion= "1=1", $parametros = array()){
        $sql = "update $this->tabla set $asignacion where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();
    }
    
    function get($login, $clave=""){
        $consultaSql = "select * from $this->tabla where login=:login and clave=:clave";
        $arrayConsulta["login"]=$login;
        $arrayConsulta["clave"]=sha1($clave);
        $resultado= $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if($resultado){
            $temporal = $this->bd->getFila();
            if($temporal==null){
                return null;
            }else{
            $usuario= new Usuario();
            $usuario->set($temporal);
            return $usuario;
            }
        }
        //return new Persona();
        return null;
    }
    function getLogin($login){
        $consultaSql = "select * from $this->tabla where login=:login";
        $arrayConsulta["login"]=$login;
        $resultado= $this->bd->setConsulta($consultaSql, $arrayConsulta);
        if($resultado){
            $temporal = $this->bd->getFila();
            if($temporal==null){
                return null;
            }else{
            $usuario= new Usuario();
            $usuario->set($temporal);
            return $usuario;
            }
        }
        //return new Persona();
        return null;
    }
    
    function count($condicion="1=1", $parametros=array()){
        $sql="select count(*) from $this->tabla where $condicion";
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return $this->bd->getFila();
        }
        return -1;
    }
    
    function getUsuarios($condicion="1=1", $parametros=array(), $orderby="1"){
        $list=array();
        $sql="select * from $this->tabla where $condicion order by $orderby";
        $r=$this->bd->setConsulta($sql, $parametros);
        if($r){
            while($fila=$this->bd->getFila()){
                $usuario= new Usuario();
                $usuario->set($fila);
                $list[]=$usuario;
            }
        } else{
            return null;
        }    
        return $list;
    }
    
//    function selectHtml($id, $name, $condicion, $parametros, $valorSeleccionado="", $blanco=true, $textoBlanco="&nbsp;"){
//        $select="<select name='$name' id='$id'>";
//        if($blanco){
//            $select.="<option value=''>$textoBlanco</option>";
//        }
//        $select.="</select>";
//        return $select;
//    }
    
    function activa($id){
        $sql="update $this->tabla set isactivo=1 where md5(concat(email, '".Configuracion::PEZARANA."', login))=:id;";
        $parametros["id"]=$id;
        $r=$this->bd->setConsulta($sql, $parametros);
        if(!$r){
            return -1;
        }
        return $this->bd->getNumeroFila();//0
    }
    
    function actualizaFechalogin(Usuario $usuario){
        $asignacion = "fechalogin = now()";
        $condicion = "login = :login";
        $parametros["login"]= $usuario->getLogin();
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }
    
    function getListJSON($pagina = 0, $rpp = 3, $condicion = "1=1", $parametros = array(), $orderby = "1"){
        $pos = $pagina * $rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $pos, $rpp";
        $this->bd->setConsulta($sql, $parametros);
        $r = "[ ";
        while($datos = $this->bd->getFila()){
            $usuario = new Usuario();
            $usuario->set($datos);
            $r .= $usuario->getJSON() . ",";
        }
        $r = substr($r, 0, -1)."]";
        return $r;
    }
}
