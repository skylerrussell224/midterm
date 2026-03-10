<?php
include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author = new Author($db);

// author read query
$result = $author->read();

// Get row count
$num = $result->rowcount();

// Check if any authors
if($num > 0){
    // Author array
    $author_arr = array();
    $author_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $author_item = array(
            'id' => $id,
            'author' => $author
        );

        // Push to "data"
        $author_arr[]= $author_item;
    }
    echo json_encode($author_arr);
} else {
    // No authors
    echo json_encode(
        array('message' => 'No Authors Found')
    );
}