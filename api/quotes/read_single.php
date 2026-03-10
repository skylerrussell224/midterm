<?php
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

// Get ID
$quote->id = $_GET['id'] ?? die();

// Get quote
$quote->read_single();

// Check if quote exists
if($quote->quote != null){

    $quote_item = array(
    'id' => $row['id'],
    'quote' => $row['quote'],
    'author' => $row['authorName'],
    'category' => $row['categoryName']
    );

    echo json_encode($quote_arr);

} else {

    echo json_encode(
        array('message' => 'No Quotes Found')
    );

}