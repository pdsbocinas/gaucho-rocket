<?php
  class Avion {
    
    private $database;
    private $path;

    private $id;
    private $modelo;
    private $matricula;

    // por ejemplo
    //id -> 1
    //descripcion -> suite
    //porcentaje-> 8
    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }
  }
  