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

    function obtenerCapacidad ($avion_id) {
      $sql = "select * from Equipo where avion_id = '$avion_id'";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result, true);
    }

  }

?>