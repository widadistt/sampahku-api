<?php
    //Headers
    header('Access-Control-Allow-Origin');
    header('Content-Type: application/json');

    include_once './config/Database.php';
    include_once './models/Landfill.php';

    //Intantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Landfill
    $landfill =  new Landfill($db);

    // Get and set ID
    $landfill->id = isset($_GET['id']) ? $_GET['id'] : die() ;

    //Get post
    $landfill->get_single();

    // Create array
    $landfill_arr = array(
        'id' => $landfill->id,
        'name' => $landfill->name,
        'phone_number' => $landfill->phone_number,
        'address' => $landfill->address
    );

    // Make JSON
    echo json_encode($landfill_arr);
?>