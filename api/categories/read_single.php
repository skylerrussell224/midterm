<?php
include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new category($db);

// Get ID
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get category
$category->read_single();

// Check if category exists
if($category->category != null){                
    // Create category array
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    echo json_encode($category_arr);

}else{

    echo json_encode(
        array('message' => 'category_id Not Found')
    );

}