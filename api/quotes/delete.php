<?php
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));

// ID to delete
$quote->id = $data->id;

// Delete quote
if ($quote->delete()) {
    echo json_encode(
        array('message' => 'Quote Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}
