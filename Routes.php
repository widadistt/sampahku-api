<?php

    foreach (glob("models/*.php") as $filename) {
        include $filename;
    }

    foreach (glob("Controllers/*.php") as $filename) {
        include $filename;
    }

    foreach (glob("api/*/*.php") as $filename) {
        include $filename;
    }
 
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );

    $id = null;
    if (isset($uri[2])) {
        $id = (int) $uri[2];
    }

    $requestMethod = $_SERVER["REQUEST_METHOD"];

    Route::set('landfills', function($requestMethod, $id) {
        $controller = new Controller($requestMethod, $id, 'Landfill');
        $controller->processRequest();
        
        //LandfillsController::get();
    });

    Route::set('wastes', function() {
        WasteController::CreateView();
    });

    Route::set('posts', function() {
        PostController::CreateView();
    });

?>