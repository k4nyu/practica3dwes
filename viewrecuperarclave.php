<!DOCTYPE html>
<html lang="en">
<?php
    require 'require/comun.php';
    $login= Leer::get("u");
    $clave= Leer::get("c");
    $nombre= Leer::get("nombre");
    $r = Leer::get("r");
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Restablecer clave de usuario</title>

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
                        <h3 class="panel-title">Recuperación de clave de acceso</h3>
                    </div>
                    <div style="margin-top: 15px; margin-left: 17px;">
                        Escribe tu nueva contraseña:
                    </div>
                    <div class="panel-body">   
                        <form role="form" method="POST" action="phprestablecerclave.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" value="" placeholder="Nueva contraseña" name="password" type="password" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" value="" placeholder="Repite contraseña" name="password2" type="password">
                                </div>
                                    <input class="form-control" value="<?php echo $login; ?>" name="login" type="hidden">
                                    <input class="form-control" value="<?php echo $clave; ?>" name="clave" type="hidden">
                                <div style="color: red; margin-top: 15px;" class="form-group">
                                    <?php if($r == -1){ ?>
                                    Las contraseñas no coinciden. Prueba de nuevo.<br>
                                    <?php $r=0; }
                                    if($r==-2){?>
                                    Las contraseña no puede estar vacía. Rellena los campos.<br>
                                    <?php $r=0; }?>
                                </div>
                                <div class="form-group">
                                    ¿Ya sabes tu contraseña? Inicia sesión <a href="viewlogin.php">aquí</a>.
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Restablecer clave">
                                
                            </fieldset>
                        </form>
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