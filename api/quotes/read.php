<?php
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

// Get query parameters
$quote->author_id = $_GET['author_id'] ?? null;
$quote->category_id = $_GET['category_id'] ?? null;

// quote read query
$result = $quote->read();

// Quote array
$quote_arr = array();
$quote_arr= array();

while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $quote_item = array(
        'id' => $id,
        'quote' => $quote,
        'author' => $authorName,
        'category' => $categoryName
    );

    // Push to "data"
    $quote_arr[]= $quote_item;
}
if(count($quote_arr) > 0){
    echo json_encode($quote_arr);
} else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}