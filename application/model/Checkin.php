<?php
  class Checkin {
    
    private $path;
    private $database;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }
}
?>

