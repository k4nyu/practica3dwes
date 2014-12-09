<?php
//Esta clase implementa las clases que sean necesarias. Se usa haciendo un rquire de esta clase.
    function autoload($clase){
        include 'clases/'.$clase.'.php';
    }
spl_autoload_register('autoload');
