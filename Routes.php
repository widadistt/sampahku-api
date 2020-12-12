<?php

    foreach (glob("models/*.php") as $filename) {
        include $filename;
    }

    foreach (glob("Controllers/*.php") as $filename) {
        include $filename;
    }

    Route::set('landfills', function() {
        Landfill::get();
    });

    Route::set('waste', function() {
        WasteController::CreateView();
    });

?>