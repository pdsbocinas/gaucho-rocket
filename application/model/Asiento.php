<?php
  class Asiento {
    
    private $path;
    private $database;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }

    function guardarAsiento ($asiento, $vuelo_id, $usuario_id, $reserva_id) {
      $sql = "insert into Asiento (asiento, vuelo_id, usuario_id, reserva_id) 
      values ('$asiento', '$vuelo_id', '$usuario_id', '$reserva_id')";
      $insertAsiento = $this->database->exec($sql);
      $insertAsiento = $this->database->get_affected_rows();
      return $insertAsiento;
    }

    function obtenerAsientosOcupados ($vuelo) {
      $vuelo_id = (int)$vuelo[0]['id'];
      $vuelo_referencia = (int)$vuelo[0]['referencia_vuelo'];
      $reserva_id = (int)$vuelo[0]['reserva_id'];
      // $sql = "select asiento from Asiento where vuelo_id = '$vuelo_id'";
      $sql = "select rt.vuelo_id, rt.destino_id, a.asiento from Asiento a
      join Vuelo v on v.id = a.vuelo_id
      join ReservaTrayecto rt on rt.vuelo_id = v.id
      where rt.vuelo_id = '$vuelo_id' or rt.vuelo_id = '$vuelo_referencia'";
      
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

    function obtenerTodosLosAsientosPorUsuario ($usuario_id) {
      $sql = "select reserva_id from Asiento where usuario_id = '$usuario_id'";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }
}

