<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once './config/Database.php';
    include_once './models/Post.php';

    //Intantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Post
    $post =  new Post($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set to update data
    $post->id = $data->id;
    $post->title = $data->title;
    $post->writer = $data->writer;
    $post->published_date = $data->published_date;
    $post->content = $data->content;

    // Create post
    if ($post->update()) {
        echo json_encode(
            array('message' => 'Post updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Post has not updated')
        );
    }
?>