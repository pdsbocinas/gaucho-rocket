<?php

class Usuario
{

  private $database;
  private $nombre;

  public function __construct() {
    $this->database = new Database();
  }

  
}
