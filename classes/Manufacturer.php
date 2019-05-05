<?php

include '../classes/Database.php';
class Manufacturer {

    private $table = 'car_manufacturer';
    private $database = '';

    public final function __construct()
    {
        $this->database = new Database();
    }
    
    /**
     * Create manufacturer
     *
     * @param array $colVal
     * @return json
     */
    public function create($colVal = array())
    {
        $condition = "name = '$colVal[name]'";
        $isManufacturerExists = Database::select($this->table, array("name"), $condition);
        if(count($isManufacturerExists) > 0) {
            return json_encode(array('status' => 'duplicate', 'message' => 'Manufacturer already exists'));
        }
        $result = $this->database->insert($this->table, $colVal);
        if($result) {
            return json_encode(array('status' => 'success', 'message' => 'Manufacturer created successfully'));
        } else {
            return json_encode(array('status' => 'error', 'message' => 'Something went wrong, Please try again later'));
        }
    }

    public function getAll()
    {
        $result = $this->database->select($this->table, array('id', 'name'));
        return $result;
    }

}