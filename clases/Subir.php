<?php

class Subir {

    private $files, $input, $destino, $nombre, $accion, $maximo, $tipos, $extensiones, $crearCarpeta;
    private $errorPHP, $error, $resultado=0, $mensaje="";

    const IGNORAR = 0, RENOMBRAR = 1, REEMPLAZAR = 2;
    const ERROR_INPUT = -1;
/*
 * Constructor de la clase. Inicializa las variables necesarias con sus valores y
 * se le pasa un $input que será el input file del formulario
 * 
 * @param string $input
 */
    function __construct($input) {
        $this->input = $input;
        $this->destino = "subidos/";
        $this->nombre = "";
        $this->accion = Subir::IGNORAR;
        $this->maximo = 2 * 1014 * 1024;
        $this->crearCarpeta = false;
        $this->tipos = array();
        $this->extensiones = array();
        $this->errorPHP = UPLOAD_ERR_OK;
        $this->error = 0;
    }
    
    //Funcion que va almacenando los mensajes del programa
    
    function getMensaje(){
        return $this->mensaje;
    }
    
    //Recupera la variable errorPHP

    function getErrorPHP() {
        return $this->errorPHP;
    }

//Recupera la variable error

    function getError() {
        return $this->error;
    }
    
    //Crea la carpeta de destino
    
    function setCrearCarpeta($crearCarpeta) {
        $this->crearCarpeta = $crearCarpeta;
    }

    /*Establece el destino pasándole un $destino
     * 
     * @param string $destino
     * 
     */
    
    
    function setDestino($destino) {
        $caracter = substr($destino, -1);
        if ($caracter != "/")
            $destino.="/";
        $this->destino = $destino;
    }

//Establece un nombre nuevo para el input file

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

/*Establece la accion que se desea hacer pasándole una $accion
 * 
 * 
 * @param string $destino
 * 
 */

    function setAccion($accion) {
        $this->accion = $accion;
    }

/*
 * Establece el tamaño máximo de archivo con $maximo
 * 
 * 
 * @param string $maximo
 */

    function setMaximo($maximo) {
        $this->maximo = $maximo;
    }

/*
 * Establece el tipo mime que se quiera desde $tipo
 * 
 * 
 * @param string $tipo
 */

    function addTipo($tipo) {
        if (is_array($tipo)) {
            $this->tipos = array_merge($this->tipos, $tipo);
        } else {
            $this->tipos[] = $tipo;
        }
    }

/*
 * Establece la extension del fichero con $extension
 * 
 * 
 * @param string $extension
 */

    function setExtension($extension) {
        if (is_array($extension)) {
            $this->extensiones = $extension;
        } else {
            unset($this->extensiones);
            $this->extensiones[] = $extension;
        }
    }

/*
 * Añade la extension deseada con $extension
 * 
 * 
 * @param string $extension
 */

    function addExtension($extension) {
        if (is_array($extension)) {
            $this->extensiones = array_merge($this->extensiones, $extension);
        } else {
            $this->extensiones[] = $extension;
        }
    }

//Comprueba si se ha introducido un input file correctamente

    function isInput() {
        if (!isset($_FILES[$this->input])) {
            $this->error = -1;
            return false;
        }
        return true;
    }

//Comprueba si hay error en el input

    private function isError() {
        if ($this->errorPHP != UPLOAD_ERR_OK) {
            return true;
        }
        return false;
    }

//Comprueba si el tamaño máximo se ha excedido o no

    private function isTamano() {
        if ($this->files["size"] > $this->maximo) {
            $this->error = -2;
            return false;
        }
        return true;
    }

//Comprueba si la extension es correcta

    private function isExtension($extension) {
        if (sizeof($this->extensiones) > 0 && !in_array($extension, $this->extensiones)) {
            $this->error = -3;
            return false;
        }
        return true;
    }

//Comprueba si la carpeta existe

    private function isCarpeta() {
        if (!file_exists($this->destino) && !is_dir($this->destino)) {
            $this->error = -4;
            return false;
        }
        return true;
    }

//Crea una carpeta de destino

    private function crearCarpeta() {
        return mkdir($this->destino, Configuracion::PERMISOS, true);
    }
    
/*Comprueba el tamaño maximo en un array de archivos
 *
 * 
 * @param string $key
 * 
 */

    private function isTamanoArray($key) {
        if ($this->files["size"][$key] > $this->maximo) {
            $this->error = -2;
            return false;
        }
        return true;
    }

    /*Comprueba si hay errores, mostrándolos en pantalla, y sube lo que esté correctamente:
     * tamaño del archivo, extension, nombre, errores PHP, etc.
     */
    
    private function subirArray() {
        $numeroArchivo=1;
        foreach ($this->files["name"] as $key => $value) {

            $this->errorPHP = $this->files["error"][$key];
            if (!$this->isError()) {
                if ($this->isTamanoArray($key)) {
                    $partes = pathinfo($this->files["name"][$key]);
                    $extension = $partes['extension'];
                    $nombreOriginal = $partes['filename'];
                    if ($this->isExtension($extension) && $nombreOriginal != "") {
                        $origen = $this->files["tmp_name"][$key];
                        $destino = $this->destino . $this->nombre . "." . $extension;
                        if ($this->accion == Subir::REEMPLAZAR) {
                            if ($this->nombre === "") {
                                $destino = $this->destino . $nombreOriginal . "." . $extension;
                            } else {
                                $destino = $this->destino . $this->nombre . "." . $extension;
                            }
                            move_uploaded_file($origen, $destino);
                            $this->resultado++;
                        } elseif ($this->accion == Subir::IGNORAR) {
                            if ($this->nombre === "") {
                                $destino = $this->destino . $nombreOriginal . "." . $extension;
                            } else {
                                $destino = $this->destino . $this->nombre . "." . $extension;
                            }
                            if (file_exists($destino)) {
                                $this->error = -5;
                            }move_uploaded_file($origen, $destino);
                            $this->resultado++;
                        } elseif ($this->accion == Subir::RENOMBRAR) {
                            if ($this->nombre === "") {
                                $this->nombre = "archivo";
                            }
                            $i = 1;
                            $destino = $this->destino . $this->nombre . "." . $extension;
                            while (file_exists($destino)) {
                                $destino = $destino = $this->destino . $this->nombre . "_$i." . $extension;
                                $i++;
                            }
                            move_uploaded_file($origen, $destino);
                            $this->resultado++;
                        }
                        $this->error = -6;
                    }
                } else {
                    $this->mensaje = $this->mensaje . "<p>El archivo " . $numeroArchivo . " supera el tamaño de archivo permitido.</p>";
                }
            } 
            $numeroArchivo++;
        }
    }
    
    //Devuelve el contenido de la variable $resultado
    
    function getResultado(){
        return $this->resultado;
    }

    //Igual que subirArray pero para archivos sueltos
    
    private function subirSolo() {
        $partes = pathinfo($this->files["name"]);
        $extension = $partes['extension'];
        $nombreOriginal = $partes['filename'];
        if (!$this->isExtension($extension)) {
            return false;
        }
        if ($this->nombre === "") {
            $this->nombre = $nombreOriginal;
        }
        $origen = $this->files["tmp_name"];
        $destino = $this->destino . $this->nombre . "." . $extension;
        if ($this->accion == Subir::REEMPLAZAR) {
            return move_uploaded_file($origen, $destino);
        } elseif ($this->accion == Subir::IGNORAR) {
            if (file_exists($destino)) {
                $this->error = -5;
                return false;
            }
            return move_uploaded_file($origen, $destino);
        } elseif ($this->accion == Subir::RENOMBRAR) {
            $i = 1;
            while (file_exists($destino)) {
                $destino = $destino = $this->destino . $this->nombre . "_$i." . $extension;
                $i++;
            }
            return move_uploaded_file($origen, $destino);
        }
        $this->error = -6;
        return false;
        $this->resultado++;
    }
    
    /*Función maestra, eje de la clase. Ejecuta la funcion de subir un archivo o varios.
     * Primero comprueba si el input es correcto y si la carpeta existe, si no, la crea.
     * Después ejecuta subirArray o subirSolo, dependiendo de si es array o no.
     * Finalmente obtiene los resultados de las operaciones y las muestra en pantalla.
     */

    function subir() {
        $this->error = 0;
        if (!$this->isInput()) {
            return false;
        }
        $this->files = $_FILES[$this->input];
        if (!$this->isCarpeta()) {
            if ($this->crearCarpeta) {
                $this->error = 0; //
                if (!$this->crearCarpeta()) {
                    $this->error = -7;
                    return false;
                }
            } else {
                return false;
            }
        }
        if (is_array($this->files)) {
            $this->subirArray();
        } elseif (!is_array($this->files)) {
            $this->subirSolo();
        }
        if($this->getResultado()==0){
            $this->mensaje = $this->mensaje . "<p>No se ha seleccionado ningún archivo</p>";
        }
        else{
            $this->mensaje = $this->mensaje . "<p>" . $this->getResultado() . " archivo/s subido/s con éxito.</p>";
        }
    }

}
