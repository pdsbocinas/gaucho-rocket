<?php
  class Cabina {
    
    private $database;
    private $path;

    private $id;
    private $descripcion;
    private $porcentaje;

    // por ejemplo
    //id -> 1
    //descripcion -> suite
    //porcentaje-> 8
    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }
  }
?>