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

// ID to delete
$author->id = $data->id;

// Delete author
if ($author->delete()) {
    echo json_encode(
        array('message' => 'Author Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'No Authors Found')
    );
}
