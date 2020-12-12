<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Landfill.php';

    //Intantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Landfill
    $landfill =  new Landfill($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $landfill->name = $data->name;
    $landfill->phone_number = $data->phone_number;
    $landfill->address = $data->address;

    // Create post
    if ($landfill->post()) {
        echo json_encode(
            array('message' => 'Post created')
        );
    } else {
        echo json_encode(
            array('message' => 'Post not created')
        );
    }
?>