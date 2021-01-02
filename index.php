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

    // if (isset($_GET['code'])) {
    //     $client->authenticate($_GET['code']);
    //     $_SESSION['access_token'] = $client->getAccessToken();
    //     header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    // }
    //Set Access Token to make Request
    // if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    //     $client->setAccessToken($_SESSION['access_token']);
    // }
?>