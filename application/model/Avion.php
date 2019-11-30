<?php
  class Avion {
    
    private $database;
    private $path;

    private $id;
    private $modelo;
    private $matricula;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }
  }
