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

    function obtenerVuelosPorEquipoyCapacidad(){
      $sql = "SELECT vuelo_id,count(vuelo_id) cantidad,vuelo.avion_id,equipo.id equipo,equipo.general,equipo.familiar,equipo.suite,(equipo.general+equipo.familiar+equipo.suite) as totalEquipo
              FROM asiento JOIN vuelo ON asiento.vuelo_id=vuelo.id
              JOIN equipo ON  vuelo.avion_id=equipo.avion_id
              GROUP BY vuelo_id;";
        $query = $this->database->query($sql);
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return json_encode($result, true);
    }
  }
