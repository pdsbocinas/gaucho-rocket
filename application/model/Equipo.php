<?php
  class Equipo {

    private $database;
    private $path;

    private $id;
    private $descripcion;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }
  }
?>