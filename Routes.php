<?php

    foreach (glob("models/*.php") as $filename) {
        include $filename;
    }

    foreach (glob("Controllers/*.php") as $filename) {
        include $filename;
    }

    Route::set('landfills', function() {
        $controller = new Controller('landfills');
        $controller->processRequest();
    });

    Route::set('wastes', function() {
        $controller = new Controller('wastes');
        $controller->processRequest();
    });

    Route::set('posts', function() {
        $controller = new Controller('posts');
        $controller->processRequest();
    });

?>