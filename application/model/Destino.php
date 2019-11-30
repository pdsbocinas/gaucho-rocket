<?php
class Destino {
  
  private $database;
  private $path;

  private $id;
  private $destino;
  
  public function __construct() {
    $this->path = Path::getInstance("config/path.ini");
    $this->database = new Database();
  }
}
