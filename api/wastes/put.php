<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once './config/Database.php';
    include_once './models/Waste.php';

    //Intantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Waste
    $waste =  new Waste($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set to update data
    $waste->name = $data->name;
    $waste->category = $data->category;

    // Create post
    if ($waste->update()) {
        echo json_encode(
            array('message' => 'Post updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Post has not updated')
        );
    }
?>