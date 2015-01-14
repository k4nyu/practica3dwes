<?php
    require '../require/comun.php';
    $bd= new BaseDatos();
    $modelo= new ModeloUsuario($bd);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <div>
            <h1>Nuevo Usuario</h1>
            <form action="phpalta.php" method="POST">
                <input type="text" placeholder="Login" name="login" value="" required/><br>
                <input type="password" placeholder="Contraseña" name="password" value="" required/><br>
                <input type="password" placeholder="Repite contraseña" name="repitepassword" value="" required/><br>
                <input type="text" placeholder="Nombre" name="nombre" value="" required/><br>
                <input type="text" placeholder="Apellidos" name="apellidos" value="" required/><br>
                <input type="text" placeholder="Email" name="email" value="" required/><br>
                <input type="submit" value="Insertar"/>
            </form>
            <form action="" method="POST" id="formulario">
                <input id="idformulario" type="hidden" name="id" value=""/>
            </form>
        </div>
    </body>
</html>
