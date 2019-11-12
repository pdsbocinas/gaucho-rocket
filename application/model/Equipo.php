<?php
  class Equipo {

    private $database;
    private $path;

    private $id;
    private $descripcion;
    private $familiar;
    private $general;
    private $suite;
    private $avion_id;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }
  }
?>