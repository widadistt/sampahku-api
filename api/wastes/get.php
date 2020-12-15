<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once './config/Database.php';
    include_once './models/Waste.php';

    //Intantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Waste
    $waste =  new Waste($db);

    //waste query
    $result = $waste->get();
    //get row count
    $num = $result->rowCount();

    //check if any waste
    if ($num>0) {
        //waste array
        $waste_arr = array();
        #$waste_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $waste_item = array(
                'id' => $id,
                'name' => $name,
                'category' => $category
            );

            //push data
            array_push($waste_arr, $waste_item);
        }

        //Turn to JSON & Output
        echo json_encode($waste_arr);
           

    } else{
        //No waste
        echo json_encode(
            array('message' => 'No Waste Found')
        );
    }
?>