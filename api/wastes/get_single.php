<?php
    //Headers
    header('Access-Control-Allow-Origin');
    header('Content-Type: application/json');

    include_once './config/Database.php';
    include_once './models/Waste.php';

    //Intantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Waste
    $waste =  new Waste($db);

    //Get post
    $waste->get_single();

    // Create array
    $waste_arr = array(
        'id' => $waste->id,
        'name' => $waste->name,
        'category' => $waste->category
    );

    // Make JSON
    echo json_encode($waste_arr);
?>