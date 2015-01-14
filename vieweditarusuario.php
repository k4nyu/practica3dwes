<!DOCTYPE html>
<html lang="en">
<?php
    require 'require/comun.php';
    $n= Leer::get("n");
    $a= Leer::get("a");
    $e= Leer::get("e");
    $i= Leer::get("i");
    
    $login = Leer::get("id");
    $bd = new BaseDatos();
    $modelo = new ModeloUsuario($bd);
    $usuario = $modelo->getLogin($login);
    $nombre = Leer::get("nombre");
    $apellidos = Leer::get("apellidos");
    $email = Leer::get("email");
    $isroot = Leer::get("isroot");
    $isactivo = Leer::get("isactivo");
    $rol = Leer::get("rol");
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Panel de Usuario</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Editar perfil de usuario</h3>
                    </div>
                    <div style="margin-top: 15px; margin-left: 20px;">
                    </div>
                    <div class="panel-body">   
                        <form role="form" method="POST" action="phpeditarusuarioadmin.php">
                            <fieldset>
                                <div class="form-group">
                                    <label>Nombre de usuario:</label><input class="form-control" value="<?php echo $login;?>" placeholder="Nombre de usuario" name="login" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label>Clave:</label><input class="form-control" value placeholder="Nueva contraseña" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <label>Repite clave:</label><input class="form-control" placeholder="Repite nueva contraseña" name="password2" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <label>Nombre:</label><input class="form-control" value="<?php echo $usuario->getNombre(); ?>" placeholder="Nombre" name="nombre" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Apellidos</label><input class="form-control" value="<?php echo $usuario->getApellidos(); ?>" placeholder="Apellidos" name="apellidos" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Email:</label><input class="form-control" value="<?php echo $usuario->getEmail(); ?>" placeholder="Email" name="email" type="text">
                                </div>
                                <div class="form-group">
                                    <label>IsRoot:</label><input class="form-control" value="<?php echo $usuario->getIsRoot(); ?>" placeholder="IsRoot" name="isroot" type="text">
                                </div>
                                <div class="form-group">
                                    <label>IsActivo:</label><input class="form-control" value="<?php echo $usuario->getIsActivo(); ?>" placeholder="IsActivo" name="isactivo" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Rol:</label><input class="form-control" value="<?php echo $usuario->getRol(); ?>" placeholder="rol" name="rol" type="text">
                                </div>
                                <input type="hidden" name="login" value="<?php echo $login;?>">
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Actualizar">
                                <div style="color: red; margin-top: 15px;" class="form-group">
                                    <?php if($n == -1){?>
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
                                    <?php $r=0;} ?> 
                                </div>
                            </fieldset>
                        </form>
                        <br>
                        <br>
                        <a href='viewindex.php?r=1&login=<?php echo $login;?>'><button class='btn bg-primary'>Volver al índice</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>