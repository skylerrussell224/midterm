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

// Check parameters
if(!isset($data->quote) || empty($data->quote) ||
    !isset($data->author_id) || empty($data->author_id) ||
    !isset($data->category_id) || empty($data->category_id)){
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
    return;
}

// Set properties
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;

// Create quote
$result = $quote->create();

if ($result === true) {
    echo json_encode(array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author_id' => $quote->author_id,
        'category_id' => $quote->category_id
    ));
}
elseif (is_array($result)) {
    echo json_encode($result);
} 
else {
    echo json_encode(
        array('message' => 'Quote Not Created')
    );
}
