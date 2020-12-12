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
 
    Route::set('landfills', function() {
        LandfillsController::get();
    });

    Route::set('waste', function() {
        WasteController::CreateView();
    });

?>