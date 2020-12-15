<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // include_once '../../config/Database.php';
    // include_once '../../models/Landfill.php';

    include_once './config/Database.php';
    include_once './models/Landfill.php';

    //Intantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Landfill
    $landfill =  new Landfill($db);

    //landfill query
    $result = $landfill->get();
    //get row count
    $num = $result->rowCount();

    //check if any landfill
    if ($num>0) {
        //landfill array
        $landfill_arr = array();
        #$landfill_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $landfill_item = array(
                'id' => $id,
                'name' => $name,
                'phone_number' => $phone_number,
                'address' => $address
            );

            //push data
            array_push($landfill_arr, $landfill_item);
        }

        //Turn to JSON & Output
        echo json_encode($landfill_arr);
           

    } else{
        //No landfill
        echo json_encode(
            array('message' => 'No Landfill Found')
        );
    }
?>