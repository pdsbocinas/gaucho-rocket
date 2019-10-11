<?php

class Usuario {

    private $database;
    
    public function __construct() {
        $this->database = new Database();
    }

    public function getAllUsers() {
        $sql = "select * from Usuario";
        $query = $this->database->query($sql);
        $result = $query->fetch_all(MYSQLI_ASSOC);
        echo json_encode($result);
    }
    
}