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

// ID to delete
$category->id = $data->id;

// Delete category
if ($category->delete()) {
    echo json_encode(array(
        'id' => $category->id
    ));
} else {
    echo json_encode(
        array('message' => 'No Categories Found')
    );
}
