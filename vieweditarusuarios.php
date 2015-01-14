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
        <script src="js/main2.js"></script>
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
            
            if(!$sesion->get("__usuario") instanceof Usuario){
            header("Location: viewlogin.php?sesion=-1");
            }
            
            $l= Leer::get("l");
            $c= Leer::get("c");
            $cr= Leer::get("cr");
            $n= Leer::get("n");
            $a= Leer::get("a");
            $d= Leer::get("d");
            $e= Leer::get("e");
            $i= Leer::get("i");
            $ia= Leer::get("ia");
            $ir= Leer::get("ir");
            $ro= Leer::get("ro");

            $login = Leer::get("login");
            $nombre = Leer::get("nombre");
            $apellidos = Leer::get("apellidos");
            $email = Leer::get("email");
            $isactivo = Leer::get("isactivo");
            $isroot= Leer::get("isroot");
            $rol = Leer::get("rol");
            
            $r = Leer::get("r");
            $login = Leer::get("login");
            $p = 0;
            if (Leer::get("p") != null) {
                $p = Leer::get("p");
            }

            $paginas = Configuracion::RPP;
            $baseDatos = new BaseDatos();
            $modelo = new ModeloUsuario($baseDatos);
            $filas = $modelo->getUsuarios("1=1", array(), "fechalogin DESC");
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
                                
                            </li>
                            <li>
                                <a href="phpcerrarsesion.php?login=<?php echo $login; ?>">Cerrar sesión</a>
                            </li>
                    </div>
            </nav>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Editar usuarios</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <?php
                                    if ($r == 1) {?>
                                        <div class="alert alert-success">
                                          ¡Se ha realizado con exito!
                                        </div>
                                    <?php }?>
                                    
                                    
                                        <?php if ($r == -1) {?>
                                        <div class="alert alert-danger">
                                            Error en la operacion
                                        <?php } ?>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">         
                                                <tr>
                                                    <td> Login</td>
                                                    <td> Nombre</td>
                                                    <td> Apellidos</td>   
                                                    <td> Email</td>
                                                    <td> IsActivo</td>
                                                    <td> IsRoot</td>
                                                    <td> Fecha de Alta</td>
                                                    <td> Rol</td>
                                                    <td> Último login</td>
                                                </tr>
                                                <?php
                                                foreach ($filas as $indice => $objeto) {
                                                    ?>  
                                                    <tr>
                                                        <td> <?php echo $objeto->getLogin(); ?></td>
                                                        <td> <?php echo $objeto->getNombre(); ?></td>
                                                        <td> <?php echo $objeto->getApellidos(); ?></td>
                                                        <td> <?php echo $objeto->getEmail(); ?></td>
                                                        <td> <?php echo $objeto->getIsActivo(); ?></td>
                                                        <td> <?php echo $objeto->getIsRoot(); ?></td>
                                                        <td> <?php echo $objeto->getFechaalta(); ?></td>
                                                        <td> <?php echo $objeto->getRol(); ?></td>
                                                        <td> <?php echo $objeto->getFechalogin(); ?></td>
                                                        <td><a class='editar' data-id='<?php echo $objeto->getLogin(); ?>' href='vieweditarusuario.php?id=<?php echo $objeto->getLogin(); ?>'>Editar</a></td>
                                                        <td><a data-nombre='<?php echo $objeto->getLogin(); ?>' class='borrar' href='phpdeleteusuario.php?id=<?php echo $objeto->getLogin(); ?>'>Borrar</a></td>
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
                                        <h2>Crear Usuario</h2>
                                        <form role="form" action="phpinsertarusuario.php" method="POST" enctype="multipart/form-data">
                                            <div style="color: red">
                                                <?php if($l == -1){ ?>
                                                Rellena el usuario.<br>
                                                <?php $r=0; } 
                                                if($c == -1){?>
                                                Rellena la clave.<br>
                                                <?php $r=0;}
                                                if($cr == -1){?>
                                                Repite la contraseña.<br>
                                                <?php $r=0;} 
                                                if($n == -1){?>
                                                Rellena el nombre.<br>
                                                <?php $r=0;} 
                                                if($a == -1){?>
                                                Rellena los apellidos.<br>
                                                <?php $r=0;} 
                                                if($e == -1){?>
                                                Rellena el email.<br>
                                                <?php $r=0;}
                                                if($i == -1){?>
                                                Las contraseñas deben coincidir.<br>
                                                <?php $r=0;}
                                                if($ia == -1){?>
                                                Rellena IsActivo.<br>
                                                <?php $r=0;}
                                                if($ir == -1){?>
                                                Rellena IsRoot.<br>
                                                <?php $r=0;}
                                                if($ro == -1){?>
                                                Rellena el rol.<br>
                                                <?php $r=0;}?>
                                            </div>
                                            <div class="form-group">
                                                <label>Nombre de usuario: </label><input type="text" class="form-control" name="login" value="<?php echo $login;?>" required/></textarea><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Clave: </label><input class="form-control" type="password" name="password" value="" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Repetir clave: </label><br><input type="password" class="form-control" name="password2" value="" required/></textarea><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Nombre: </label><input class="form-control" type="text" name="nombre" value="<?php echo $nombre;?>" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Apellidos: </label><input class="form-control" type="text" name="apellidos" value="<?php echo $apellidos;?>" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Email: </label><input class="form-control" type="text" name="email" value="<?php echo $email;?>" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>IsActivo: </label><input class="form-control" type="text" name="isactivo" value="<?php echo $isactivo;?>" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>IsRoot: </label><input class="form-control" type="text" name="isroot" value="<?php echo $isroot;?>" required/><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Rol: </label><input class="form-control" type="text" name="rol" value="<?php echo $rol;?>" required/><br>
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
