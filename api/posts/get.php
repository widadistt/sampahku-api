<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once './config/Database.php';
    include_once './models/Post.php';

    //Intantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Post
    $post =  new Post($db);

    //post query
    $result = $post->get();
    //get row count
    $num = $result->rowCount();

    //check if any post
    if ($num>0) {
        //post array
        $post_arr = array();
        #$post_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $post_item = array(
                'id' => $id,
                'title' => $title,
                'writer' => $writer,
                'content' => $content,
                'published_date' => $published_date
            );

            //push data
            array_push($post_arr, $post_item);
        }

        //Turn to JSON & Output
        echo json_encode($post_arr);
           

    } else{
        //No post
        echo json_encode(
            array('message' => 'No Post Found')
        );
    }
?>