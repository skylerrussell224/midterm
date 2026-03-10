<?php
include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author = new Author($db);

// Get ID
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get author
$author->read_single();

// Check if author exists
if($author->author != null){

    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author
    );

    echo json_encode($author_arr);

}else{

    echo json_encode(
        array('message' => 'author_id Not Found')
    );

}