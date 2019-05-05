<?php

class Database {

    private static $connection;

    public final function __construct() {
        //$this = new Database();
//        
    }

    /**
     * Connect database
     */
    private function connect_db() {
        $config = include('Config.php');
        $host = $config['host'];
        $database = $config['database'];
        $dbUsername = $config['username'];
        $dbPassword = $config['password'];
        try {
            Database::$connection = new PDO("mysql:host=".$host.";dbname=".$database, $dbUsername, $dbPassword);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Select query
     *
     * @param string $table
     * @param array $columns
     * @param string $where
     * @return array
     */
    public static function select($table, $columns = array(), $where = "") {
        Database::connect_db();
        $selectCols = "* ";
        if(!empty($columns)) {
            $lastElement = end($columns);
            $selectCols = "";
            foreach($columns as $column) {
                if ($column == $lastElement) {
                    $selectCols .= "$column";
                } else {
                    $selectCols .= "$column, ";
                }
            }
        }
        if($where === "") {
            $where = "1 = 1";
        }
        $sql = "SELECT $selectCols FROM $table WHERE $where";
        $query = Database::$connection->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function get($sql) {
        Database::connect_db();
        $query = Database::$connection->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Insert query
     *
     * @param string $table
     * @param array $colVal
     * @return boolean
     */
    public static function insert($table, $colVal = array()) {
        Database::connect_db();
        $columns = $values = '';
        if(!empty($colVal)) {
            $lastElement = end($colVal);
            foreach($colVal as $column => $value) {
                if ($value == $lastElement) {
                    $columns .= "$column";
                    $values .= "'$value'";
                } else {
                    $columns .= "$column, ";
                    $values .= "'$value', ";
                }
            }
        }
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $query = Database::$connection->prepare($sql);
        return $query->execute();
    }

    /**
     * Update query
     *
     * @param string $table
     * @param array $colVals
     * @param string $where
     * @return boolean
     */
    public static function update($table, $colVals = array(), $where = '') {
        Database::connect_db();
        $updateCols = "";
        if(!empty($colVals)) {
            $lastElement = end($colVals);
            foreach($colVals as $column => $value) {
                if ($value == $lastElement) {
                    $updateCols .= "$column = '$value'";
                } else {
                    $updateCols .= "$column = '$value', ";
                }
            }
        }
        if($where === "") {
            $where = "1 = 1";
        }
        $sql = "UPDATE $table SET $updateCols WHERE $where";
        $query = Database::$connection->prepare($sql);
        return $query->execute();
    }
}