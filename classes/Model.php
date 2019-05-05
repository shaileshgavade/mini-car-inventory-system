<?php

include '../classes/Database.php';
class Model {
    private $table = 'car_model';
    private $database = '';

    /**
     * Construct method
     */
    public final function __construct()
    {
        $this->database = new Database();
    }

    
    public function getAll()
    {
        $selectCols = array('id', 'name', 'registration_number', 'manufacturing_year', 'color', 'note', 'manufacturer_id');
        $result = $this->database->select($this->table, $selectCols);
        return $result;
    }

    /**
     * Create model
     *
     * @param array $columns
     */
    public function create($colVals = array())
    {
        $result = $this->database->insert($this->table, $colVals);
        if($result) {
            return json_encode(array('status' => 'success', 'message' => 'Model creates successfully'));
        } else {
            return json_encode(array('status' => 'error', 'message' => 'Something went wrong, Please try again later'));
        }
    }

    public function sold($id)
    {
        $result = $this->database->update($this->table, array("sold" => 1), "id = $id");
        if($result) {
            return json_encode(array('status' => 'success', 'message' => 'Model sold successfully'));
        } else {
            return json_encode(array('status' => 'error', 'message' => 'Something went wrong, Please try again later'));
        }
    }
}