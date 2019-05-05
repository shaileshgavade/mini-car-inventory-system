<?php

include '../classes/Database.php';
class Inventory {

    private $database = '';

    /**
     * Construct method
     */
    public final function __construct()
    {
        $this->database = new Database();
    }

    /**
     * Get model by id
     *
     * @param string $id
     */
    public function get($id) {
        $sql = "SELECT m.id AS id, m.name AS model_name, 
                        mf.name AS manufacturer_name, m.color AS color, m.manufacturing_year,
                        m.registration_number, m.note 
                        FROM car_manufacturer mf LEFT JOIN car_model m ON mf.id = m.manufaturer_id 
                        WHERE m.id = $id";
        $result = $this->database->get($sql);
        return $result;
    }

    /**
     * Get all car models
     */
    public function getAll(){
        $sql = "SELECT m.id AS id, f.name AS manufacturer_name, m.name AS model_name 
                
                FROM car_model m INNER JOIN car_manufacturer f ON f.id = m.manufaturer_id 
                WHERE m.sold = 0";
        $result = $this->database->get($sql);
        return $result;
    }

    /**
     * Sold out
     *
     * @param string $id
     */
    public function sold($id)
    {
        $result = $this->database->update('car_model', array("sold" => 1), "id = $id");
        if($result) {
            return json_encode(array('status' => 'success', 'message' => 'Model sold successfully'));
        } else {
            return json_encode(array('status' => 'error', 'message' => 'Something went wrong, Please try again later'));
        }
    }
}