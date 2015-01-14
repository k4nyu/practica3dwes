<!DOCTYPE html>
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="js/main.js"></script>
        <title>VentaCasa</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="css/plugins/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        
        require 'require/comun.php';
        include "clases/anuncio/Anuncio.php";
        include "clases/foto/Foto.php";
        include "clases/anuncio/ModeloAnuncio.php";
        include "clases/foto/ModeloFoto.php";
        
        if(!$sesion->get("__usuario") instanceof Usuario){
        header("Location: viewlogin.php?sesion=-1");
         }
         
        $p = 0;
        
        $r = Leer::get("r");
        $login = Leer::get("login");
        if (Leer::get("p") != null) {
            $p = Leer::get("p");
        }
        $condicion = "";
        $parametros = array();
        $palabras = Leer::post("palabras");
        $precio = Leer::post("precio");
        $ciudad = Leer::post("ciudad");
        $servicios = Leer::post("servicios");
        $ordenar = Leer::post("ordenar");
        $superficie = Leer::post("superficie");
        if ($palabras != "") {
            $condicion .= " (titulo like :palabras or descripcion like :palabras or ciudad like :palabras or direccion like :palabras)";
            $parametros["palabras"] = "%$palabras%";
        }
        if ($precio != "" && ($ciudad != "" || $superficie != "" || $servicios != "")) {
            $condicion .= "precio = :precio and ";
            $parametros["precio"] = $precio;
        } elseif ($precio != "") {
            $condicion .= "precio = :precio";
            $parametros["precio"] = $precio;
        }
        if ($ciudad != "" && ($superficie != "" || $servicios != "")) {
            $condicion .= "ciudad = :ciudad and ";
            $parametros["ciudad"] = $ciudad;
        } elseif ($ciudad != "") {
            $condicion .= "ciudad = :ciudad";
            $parametros["ciudad"] = $ciudad;
        }
        if ($servicios != "" && $superficie != "") {
            $condicion .= "servicios = :servicios and ";
            $parametros["servicios"] = $servicios;
        } elseif ($servicios != "") {
            $condicion .= "servicios = :servicios";
            $parametros["servicios"] = $servicios;
        }
        if ($superficie != "") {
            $condicion .= "longitud = :longitud";
            $parametros["longitud"] = $superficie;
        }
        if ($ordenar == "1") {
            $orderby = "precio ASC";
        }
        if ($ordenar == "2") {
            $orderby = "precio DESC";
        }
        if ($ordenar != "1" && $ordenar != "2") {
            $orderby = "1";
        }
        if ($condicion == "") {
            $condicion = "1=1";
        }
        $paginas = Configuracion::RPP;
        $baseDatos = new BaseDatos();
        $modelo = new ModeloAnuncio($baseDatos);
        $modelousuario = new ModeloUsuario($baseDatos);
        $modelofoto = new ModeloFoto($baseDatos);
        $filas = $modelo->getAnuncios($p, $paginas, $condicion, $parametros, $orderby);
        $numeroRegistros = $modelo->count();
        $enlaces = Util::getEnlacesPaginacion($p, $paginas, $numeroRegistros);
        ?>
        <div id="wrapper">
            <?php
            if($r==1){
                $usuario = $modelousuario->getLogin($login);
                $nombreusuario= $usuario->getNombre();?>
            <div style="margin-left: 30px; margin-top: 10px; margin-bottom: -40px;">
                <h4 style="float: left;">Hola <a href="viewpanelusuario.php?login=<?php echo $login;?>"><?php echo $nombreusuario;?></a>.</h4>
                <a href="phpcerrarsesion.php?login=<?php echo $login; ?>"><button style="margin-left: 15px;" class="btn btn-danger">Cerrar sesión</button></a>
            </div>
            
            <?php }?>
            <div>
                <form role="form" action="viewindex.php" method="POST">
                    <div style="width: 210px; float: left; margin-left: -95px; margin-top: 40px;">
                        <label>Palabras clave: </label><input class="form-control" type="text" name="palabras"/>
                    </div>
                    <div style="width: 210px; float: left; margin-left: 20px; margin-top: 40px;">
                        <label>Precio: </label><input class="form-control" type="text" name="precio"/>
                        <label>Ascendente</label><input type="radio" name="ordenar" value="1"checked/>
                        <label>Descendente</label><input type="radio" name="ordenar" value="2"/><br>
                    </div>
                    <div style="width: 210px; float: left; margin-left: 20px; margin-top: 40px;">
                        <label>Ciudad: </label><input class="form-control" type="text" name="ciudad"/>
                    </div>
                    <div style="width: 210px; float: left; margin-left: 20px; margin-top: 40px;">
                        <label>Servicios: </label><input class="form-control" type="text" name="servicios"/>
                    </div>
                    <div style="width: 100px; float: left; margin-left: 20px; margin-top: 40px;">
                        <label>Superficie: </label><input class="form-control" type="text" name="superficie"/>
                    </div>
                    <input style="display: block; margin-top: 65px; margin-left: 20px; float: left; margin-bottom: 10px;" class="btn btn-warning" type="reset" value="Vaciar campos"/>
                    <input style="display: block; margin-top: 65px; margin-left: 20px; float: left;" class="btn btn-primary" type="submit" value="Filtrar"/>
                </form>
            <br>
            <br>
            </div>

            <div>
                <h1 class="page-header" style="display: block; margin-top:100px; text-align: center; margin-bottom: 50px;">Bienvenido a VentaCasa</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">         
                        <tr>
                            <td> Id</td>
                            <td> Titulo</td>
                            <td> Precio</td>
                            <td> Descripción</td>
                            <td> Ciudad</td>   
                            <td> Direccion</td>
                            <td> Habitaciones</td>
                            <td> Servicios</td>
                            <td> Longitud</td>
                            <td> Foto</td>
                        </tr>
                        <?php
                        foreach ($filas as $key => $objeto) {
                            $foto = $modelofoto->getFotoIdCasa($objeto->getIdanuncio());
                            ?>  
                            <tr>
                                <td> <?php echo $objeto->getIdanuncio(); ?></td>
                                <td> <?php echo $objeto->getTitulo(); ?></td>
                                <td> <?php echo $objeto->getPrecio(); ?></td>
                                <td> <?php echo $objeto->getDescripcion(); ?></td>
                                <td> <?php echo $objeto->getCiudad(); ?></td>
                                <td> <?php echo $objeto->getDireccion(); ?></td>
                                <td> <?php echo $objeto->getHabitaciones(); ?></td>
                                <td> <?php echo $objeto->getServicios(); ?></td>
                                <td> <?php echo $objeto->getLongitud(); ?></td>
                                <?php if ($foto) { ?>
                                    <td><img width="100px" src="<?php echo $foto[0]->getUrlfoto(); ?>"</td>  
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        <tr>
                        <style>
                            tr td li{float: left; margin-right: 10px;}
                        </style>
                            <td style="list-style: none;" colspan="10">
                            <?php echo $enlaces["inicio"]; ?>
                            <?php echo $enlaces["anterior"]; ?>
                            <?php echo $enlaces["primero"]; ?>
                            <?php echo $enlaces["segundo"]; ?>
                            <?php echo $enlaces["actual"]; ?>
                            <?php echo $enlaces["cuarto"]; ?>
                            <?php echo $enlaces["quinto"]; ?>
                            <?php echo $enlaces["siguiente"]; ?>
                            <?php echo $enlaces["ultimo"]; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>