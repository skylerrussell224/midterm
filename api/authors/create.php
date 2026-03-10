<?php
include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author = new Author($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));

// Check parameters
if(!isset($data->author) || empty($data->author)){
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
    return;
}

// Set property
$author->author = $data->author;

// Create author
$result = $author->create();

if ($result === true) {
    echo json_encode(array(
        'id' => $author->id,
        'author' => $author->author
    ));
}
elseif (is_array($result)) {
    echo json_encode($result);
} 
else {
    echo json_encode(
        array('message' => 'Author Not Created')
    );
}
