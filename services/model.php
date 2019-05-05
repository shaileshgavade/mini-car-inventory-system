<?php

include '../classes/Model.php';

$data = $_REQUEST;
$method = $_REQUEST['method'];
$model = new Model();
if ($method != '') {
    switch ($method) {
        case 'create':
            unset($data['method']);
            echo $model->create($data);
            break;
        case 'getAll':
            echo json_encode($model->getAll());
            break;
        default:
            break;
    }
}