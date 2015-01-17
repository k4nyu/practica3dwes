<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require "require/comun.php";
    $r= Leer::get("r");
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Recuperar contraseña</title>

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
                        <h3 class="panel-title">Recuperación de contraseña</h3>
                    </div>
                    <div style="margin-top: 15px; margin-left: 20px;">
                        Por favor, introduce tu nombre de usuario para recuperar tu clave:
                    </div>
                    <div class="panel-body">   
                        <form role="form" method="POST" action="phpolvido.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Nombre de usuario" name="login" type="text" autofocus>
                                </div>
                                <div style="margin-top: 15px; margin-bottom: 15px; margin-left: 3px;">
                                    O tu email para obtener tu nombre de usuario:
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="email" type="email" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Enviar">
                                <div style="color: red; margin-top: 15px;" class="form-group">
                                    <?php if($r == -2){ ?>
                                    El login o la clave están vacíos.<br>
                                    <?php $r=0; } 
                                    if($r == -1){?>
                                    El login o la clave son incorrectos o el usuario no existe.<br>
                                    <?php $r=0;} 
                                    if($r == 1){?>
                                    Bienvenid@ <?php echo $nombre; ?>!
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </form>
                        <br>
                        <br>
                        <div class="form-group">
                                    ¿Ya tienes tu clave o nombre de usuario? Inicia sesión <a href="viewlogin.php">aquí</a>.
                                </div>
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
