<?php
class BaseDatos {
    private $con;
    private $sentencia;
    function __construct() {
        try{
        $this->con = new PDO('mysql:host=' . Configuracion::SERVIDOR . ';dbname=' . Configuracion::BASEDATOS,
            Configuracion::USUARIO,
            Configuracion::CLAVE,
            array(PDO::ATTR_PERSISTENT => true,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
        );
        } catch(PDOException $e){
            $this->con = null;
        }
    }
    
    function closeConexion() {
        $this->closeConsulta();
        $this->con = null;
    }
    
    function closeConsulta(){
        if($this->sentencia != null){
           $this->sentencia->closeCursor();
            $this->sentencia = null; 
        }
    }
    
    function getAutonumerico(){
        $id = $this->con->lastInsertId();
        return $id;
    }
    
    function getError(){
        return $this->sentencia->errorInfo();
    }
    
    function getFila(){
        if($this->sentencia!=null){
            return $this->sentencia->fetch();
        }else{
            return false;
        }
    }

    function getNumeroFila(){
        if($this->sentencia!=null){
            return $this->sentencia->rowCount();
        }else{
            return -1;
        }
    }
    
    function isConectado(){
        if($this->con != null){
            return true;
        }else{
            return false;
        }
    }
    
    function setBaseDatos($bd){
        return $this->con->query("use $bd")!=false;
    }
    function setConsulta($consulta, $parametros = array()){
        $this->sentencia = $this->con->prepare($consulta);
        foreach ($parametros as $key => $value) {
            $this->sentencia->bindValue($key, $value);
        }
        return $this->sentencia->execute();
    }
    function setConsultaPreparada($consulta, $parametros = array()){
        $this->sentencia = $this->con->prepare($consulta);
        $i = 1;
        foreach ($parametros as $value) {
            $this->sentencia->bindValue($i, $value);
            $i++;
        }
        return $this->sentencia->execute();
    }
    function setConsultaSql($consulta){
        $this->sentencia = $this->con->query($consulta);
        if($this->sentencia === false){
            $this->sentencia = null;
            return false;
        }else{
            return true;
        }
    }
    function setTransaccion(){
        $this->conexion->beginTransaction();
    }
    function anulaTransaccion(){
        $this->conexion->rollBack();
    }
    function validaTransaccion(){
        $this->conexion->commit();
    }
    
    function ejecutaTransaccion($consultas, $parametros){
        $this->setTransaccion();
        $error = false;
        foreach ($consultas as $i => $consulta) {
            $resultado = $this->setConsulta($consulta, $parametros[$i]);
            if($resultado===false || $this->getNumeroFila()<1){
                $error = true;
                break;
            }
        }
        if($error){
            $this->anulaTransaccion();
            return false;
        }else{
            $this->validaTransaccion();
            return true;
        }
    }
}

?>
