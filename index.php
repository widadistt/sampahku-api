<?php

    require_once("Routes.php");

    function autoloader($class_name) {
        
        if (file_exist('.models/'.$class_name.'.php')) {
            require_once '.models/'.$class_name.'.php';
        } else if (file_exists(require_once '.Controllers/'.$class_name.'Controller.php')) {
            require_once '.Controllers/Controller.php';
        }
        
    }

    spl_autoload_register('autoloader');

?>