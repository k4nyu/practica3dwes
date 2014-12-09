<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Panel de administración</title>
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
        <div id="wrapper">
            <?php
            require 'require/comun.php';
            include "clases/anuncio/Anuncio.php";
            include "clases/foto/Foto.php";
            include "clases/anuncio/ModeloAnuncio.php";
            include "clases/foto/ModeloFoto.php";
            $p = 0;
            if (Leer::get("p") != null) {
                $p = Leer::get("p");
            }

            $paginas = Configuracion::RPP;
            $baseDatos = new BaseDatos();
            $modelo = new ModeloAnuncio($baseDatos);
            $modelofoto = new ModeloFoto($baseDatos);
            $filas = $modelo->getAnuncios();
            $numeroRegistros = $modelo->count();
            $enlaces = Util::getEnlacesPaginacion($p, $paginas, $numeroRegistros);
            ?>
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">

                    <a class="navbar-brand" href="viewadmin.php">Panel de Aministración</a>

                </div>
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">

                            <li>
                                <a href="viewadmin.php"><i class="fa fa-dashboard fa-fw"></i> Panel principal</a>
                            </li>
                            <li>
                                <a href="viewindex.php">Volver a VentaCasa</a>
                            </li>
                    </div>
            </nav>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Panel de control</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php
                                        $resultado = Leer::get("resultado");
                                        if ($resultado == "bien") {
                                            $cantidad = Leer::get("cantidad");
                                            $id = Leer::get("id");
                                            echo "Se ha realizado con exito. Cantidad: $cantidad, ID: $id";
                                        }
                                        if ($resultado == "error") {
                                            echo "Error en la operacion";
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-12">
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
                                                foreach ($filas as $indice => $objeto) {
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
                                                        <td><a class='editar' data-id='<?php echo $objeto->getIdanuncio(); ?>' href='viewedit.php?id=<?php echo $objeto->getIdanuncio(); ?>'>Editar</a></td>
                                                        <td><a data-nombre='<?php echo $objeto->getIdanuncio(); ?>' class='borrar' href='php/phpdelete.php?id=<?php echo $objeto->getIdanuncio(); ?>'>Borrar</a></td>
                                                    </tr>
                                                <?php } ?>
                            <!--<tr>
                            <td colspan="5">
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
                            </tr>-->
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h2>Crear Anuncio</h2>
                                        <form role="form" action="php/phpinsert.php" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Titulo: </label><br>
                                                <textarea class="form-control" rows="4" cols="30" name="titulo" value="" required/></textarea><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Precio: </label><input class="form-control" type="text" name="precio" value="" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Descripción: </label><br><textarea class="form-control" name="descripcion" cols="30" rows="4" value="" required/></textarea><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Ciudad: </label><input class="form-control" type="text" name="ciudad" value="" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Dirección: </label><input class="form-control" type="text" name="direccion" value="" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Habitaciones: </label><input class="form-control" type="text" name="habitaciones" value="" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Servicios: </label><input class="form-control" type="text" name="servicios" value="" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Longitud: </label><input class="form-control" type="text" name="longitud" value="" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Agregar fotos: </label><input type="file" name="archivo[]" multiple /><br>
                                            </div>
                                            <input type="submit" class="btn btn-success" value="Crear"/>
                                        </form>
                                    </div>
                                </div>
                                <form action="" method="POST" id="formulario">
                                    <input id="idformulario" type="hidden" name="id" value=""/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
