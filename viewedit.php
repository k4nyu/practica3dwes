<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Anuncio</title>
        <script src="js/main.js"></script>
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
            $id = Leer::request("id");
            $bd = new BaseDatos();
            $anuncio = new Anuncio($id);
            $modeloanuncio = new ModeloAnuncio($bd);
            $objeto = $modeloanuncio->get($id);
            $titulo = $objeto->getTitulo();
            $precio = $objeto->getPrecio();
            $descripcion = $objeto->getDescripcion();
            $ciudad = $objeto->getCiudad();
            $direccion = $objeto->getDireccion();
            $habitaciones = $objeto->getHabitaciones();
            $servicios = $objeto->getServicios();
            $longitud = $objeto->getLongitud();

            $condicion = 'idanuncio=' . $id;
            $modelofoto = new ModeloFoto($bd);
            $arrayfotos = $modelofoto->getFotoIdCasa($id);

            $bd->closeConexion();
            ?>
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Panel de Aministración</a>
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
                    <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Modificar Anuncio</h1>
                        <a id="volveradmin" href="viewadmin.php"><button class="btn btn-primary btn-lg">Volver al Panel de Control</button></a> 
                        <br>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" action="php/phpedit.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $id ?>"/>
                                            <div class="form-group">
                                                <label>Titulo: </label><input class="form-control" required name="titulo" type="text" name="titulo" value="<?php echo $titulo ?>"/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Precio: </label><input class="form-control" required name="precio" type="text" name="precio" value="<?php echo $precio ?>"/>€<br>
                                            </div>
                                            <div class="form-group">
                                                <label>Descripción: </label><br><textarea class="form-control" name="descripcion" name="descripcion" cols="50" rows="4" value="" required/><?php echo $descripcion ?></textarea><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Ciudad: </label><input class="form-control" type="text" name="ciudad" name="ciudad" value="<?php echo $ciudad ?>" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Dirección: </label><input class="form-control" type="text" name="direccion" name="direccion" value="<?php echo $direccion ?>" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Habitaciones: </label><input class="form-control" type="text" name="habitaciones" name="habitaciones" value="<?php echo $habitaciones ?>" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Servicios: </label><input class="form-control" type="text" name="servicios" name="servicios" value="<?php echo $servicios ?>" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Longitud: </label><input class="form-control" type="text" name="longitud" name="longitud" value="<?php echo $longitud ?>" required/>(m²)<br>
                                            </div>
                                            <?php
                                            foreach ($arrayfotos as $key => $value) {
                                                ?>
                                                <img width="150px" src="<?php echo $arrayfotos[$key]->getUrlfoto(); ?>">
                                                <a data-nombre="<?php echo $arrayfotos[$key]->getIdfoto(); ?>" class="borrar" href='php/phpdeletefoto.php?idfoto=<?php echo $arrayfotos[$key]->getIdfoto(); ?>&id=<?php echo $id; ?>'>Borrar</a>
                                                <?php
                                            }
                                            ?>
                                            <br>
                                            <br>
                                            <input class="btn btn-success" type="submit" value="Actualizar" />
                                        </form>
                                    </div>    
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <h2>Agregar fotos</h2>
                                        <form action='php/phpinsertarfoto.php' method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo $id ?>"/>
                                            <input type="file" name="archivo[]" multiple /><br>
                                            <input class="btn btn-success" type="submit" value="Agregar" />
                                        </form>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
    </body>
</html>