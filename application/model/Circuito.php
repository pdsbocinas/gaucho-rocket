<?php

class Circuito
{
    private $database;
    private $path;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      require_once( $this->path->getPage("model", "Usuario.php") );
      $this->database = new Database();
    }
}
