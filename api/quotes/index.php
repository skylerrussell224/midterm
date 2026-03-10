<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS'){
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    switch($method){
        case 'GET':
            // read or read_single
            if(isset($_GET['id'])){
                require_once 'read_single.php';
            }else{
                require_once 'read.php';
            }
            break;

        case 'POST':
            // create
            require_once 'create.php';
            break;
        case 'PUT':
            // update
            require_once 'update.php';
            break;
        case 'DELETE':
            // delete
            require_once 'delete.php';
            break;
    }