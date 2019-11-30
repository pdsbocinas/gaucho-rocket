<?php
  class Servicio {
    
    private $id;
    private $descripcion;
    private $porcantaje;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }

    function obtenerTodosLosServicios () {
      $sql = "select * from Servicio";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

    function obtenerServicioPorId ($servicio_id) {
      $sql = "select * from Servicio where id = '$servicio_id'";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

  }
