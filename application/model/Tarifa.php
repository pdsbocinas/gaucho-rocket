<?php

class Tarifa
{
  private $database;
  private $path;

  private $id;
  private $cant_dias;
  private $porcentaje;
  
  public function __construct() {
    $this->path = Path::getInstance("config/path.ini");
    $this->database = new Database();
  }
}

?>