<!DOCTYPE html>
<html lang="en">
<?php
    require 'require/comun.php';
    $r= Leer::get("r");
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contraseña restablecida</title>

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
                    <?php if($r==1){?>
                    <div class="panel-heading">
                        <h3 class="panel-title">¡Contraseña restablecida con éxito!</h3>
                    </div>
                    <div style="margin-top: 15px; margin-left: 20px; margin-bottom: 15px;">
                        Para iniciar sesión pulsa <a href="viewlogin.php">aquí</a>.
                    </div>
                    <?php }
                    if($r!=1){?>
                    <div class="panel-heading">
                        <h3 class="panel-title">¡Ha ocurrido un error!</h3>
                    </div>
                    <div style="margin-top: 15px; margin-left: 20px; margin-bottom: 15px;">
                        ¡Vaya! Parece que algo no ha salido bien...
                    </div>
                    <?php }?>
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
