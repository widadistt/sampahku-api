<?php
    //Headers
    header('Access-Control-Allow-Origin');
    header('Content-Type: application/json');

    include_once './config/Database.php';
    include_once './models/Post.php';

    //Intantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate Post
    $post =  new Post($db);

    // Get and set ID
    $post->id = isset($_GET['id']) ? $_GET['id'] : die() ;

    //Get post
    $post->get_single();

    // Create array
    $post_arr = array(
        'id' => $post->id,
        'title' => $post->title,
        'writer' => $post->writer,
        'content' => $content,
        'published_date' => $post->published_date
    );

    // Make JSON
    echo json_encode($post_arr);
?>