<?php

include '../classes/Inventory.php';

$method = $_REQUEST['method'];
$inventory = new Inventory();
if ($method != '') {
    switch ($method) {
        case 'get':
            if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
                echo json_encode($inventory->get($_REQUEST['id']));
            }
            break;
        case 'getAll':
            echo json_encode($inventory->getAll());
            break;
        case 'sold':
            echo $inventory->sold($_REQUEST['id']);
            break;
        default:
            break;
    }
}

//$inventory = new Inventory();
//if(isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
//    echo json_encode($inventory->select($_REQUEST['id'])[0]);
//} else {
//    echo json_encode($inventory->selectAll());
//}