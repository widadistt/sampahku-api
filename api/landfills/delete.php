<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once './config/Database.php';
    include_once './models/Landfill.php';

    //Intantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Landfill
    $landfill =  new Landfill($db);

    // Create post
    if ($landfill->delete()) {
        echo json_encode(
            array('message' => 'Landfill deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Landfill has not deleted')
        );
    }
?>