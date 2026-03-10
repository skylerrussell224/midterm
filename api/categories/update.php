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
if(!isset($data->category) || empty($data->category) ||
!isset($data->id) || empty($data->id)){
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
    return;
}

// Variables to update
$category->id = $data->id;
$category->category = $data->category;

// Update category
$result = $category->update();

if ($result === true) {
    echo json_encode(array(
        'id' => $category->id,
        'category' => $category->category
    ));
}
elseif (is_array($result)) {
    echo json_encode($result);
}
else {
    echo json_encode(
        array('message' => 'Category Not Updated')
    );
}
