<?php
include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new category($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));

// Check parameters
if(!isset($data->category) || empty($data->category)){
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
    return;
}

// Set property
$category->category = $data->category;

// Create category
if ($category->create()) {
    echo json_encode(
        array('message' => 'Category Created')
    );
} else {
    echo json_encode(
        array('message' => 'Category Not Created')
    );
}
