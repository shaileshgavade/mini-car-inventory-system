<?php

include '../classes/Manufacturer.php';

$method = $_REQUEST['method'];
$manufacturer = new Manufacturer();
if ($method != '') {
    switch ($method) {
        case 'create':
            echo $manufacturer->create(array('name'=>$_REQUEST['name']));
            break;
        case 'getAll':
            echo json_encode($manufacturer->getAll());
            break;
        default:
            break;
    }
}

//var_dump($_REQUEST);exit;
//echo $manufacturer->add(["name"=>$_REQUEST["name"]]);

