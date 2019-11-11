<?php
  class Servicio {
    
    private $id;
    private $descripcion;
    private $porcantaje;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }

  }
  
?>