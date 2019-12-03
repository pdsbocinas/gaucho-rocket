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
      values ('$asiento', $vuelo_id, $usuario_id, $reserva_id)";
      $insertAsiento = $this->database->exec($sql);
      $insertAsiento = $this->database->get_affected_rows();
      return $insertAsiento;
    }

    function obtenerAsientosOcupados ($vuelo) {
      $vuelo_id = (int)$vuelo[0]['id'];

      $sql = "select a.asiento from asiento a
      join Vuelo v on v.id = a.vuelo_id
      where a.vuelo_id = $vuelo_id or exists
      (SELECT id FROM Vuelo vl where vl.referencia_vuelo = $vuelo_id)";

      // $sqlVueloId = "select distinct a.vuelo_id, rt.destino_id, a.asiento from Vuelo v
      // join Asiento a on a.vuelo_id = v.id
      // join ReservaTrayecto rt on rt.vuelo_id = v.id
      // where rt.vuelo_id = $vuelo_id";
      
      // $sqlVueloRef = "select distinct a.vuelo_id, rt.destino_id, a.asiento from Vuelo v
      // join Vuelo vRef on v.id = vRef.referencia_vuelo
      // join ReservaTrayecto rt on rt.vuelo_id = vRef.id
      // join Asiento a on a.vuelo_id = vRef.id";
      

      $queryVueloId = $this->database->query($sql);
      // $queryVueloRef = $this->database->query($sqlVueloRef);

      $resultVueloId = $queryVueloId->fetch_all(MYSQLI_ASSOC);
      // $resultVueloRef = $queryVueloRef->fetch_all(MYSQLI_ASSOC);

      return json_encode($resultVueloId);
    }

    function obtenerAsientosOcupadosVuelosHijos ($vuelo) {
      $vuelo_referencia = (int)$vuelo[0]['referencia_vuelo'];
      $vuelo_id = (int)$vuelo[0]['id'];
      
      $sql = "select DISTINCT a.asiento from asiento a join Vuelo v on v.id = a.vuelo_id join Avion av on av.id = v.avion_id join ReservaTrayecto rt on rt.vuelo_id = v.id where (a.vuelo_id = $vuelo_id or a.vuelo_id = $vuelo_referencia)";

      // $sqlVueloId = "select distinct a.vuelo_id, rt.destino_id, a.asiento from Vuelo v
      // join Asiento a on a.vuelo_id = v.id
      // join ReservaTrayecto rt on rt.vuelo_id = v.id
      // where rt.vuelo_id = $vuelo_id";

      // $sqlVueloRef = "select distinct a.vuelo_id, rt.destino_id, a.asiento from Vuelo v
      // join Vuelo vRef on vRef.id = v.referencia_vuelo
      // join ReservaTrayecto rt on rt.vuelo_id = v.referencia_vuelo
      // join Asiento a on a.vuelo_id = v.referencia_vuelo";

      $queryVueloId = $this->database->query($sql);
      // $queryVueloRef = $this->database->query($sqlVueloRef);

      // $resultVueloRef = $queryVueloRef->fetch_all(MYSQLI_ASSOC);
      $resultVueloId = $queryVueloId->fetch_all(MYSQLI_ASSOC);
            
      // $list_filtered = array_filter($resultVueloRef, function ($var) use ($resultVueloId) {
      //   if (in_array($var['destino_id'], array_column($resultVueloId, 'destino_id'))) {
      //     return array_push($resultVueloId, $var);
      //   }
      // });

      // $merged_array = array_merge($resultVueloId, $list_filtered);

      return json_encode($resultVueloId);
    }

    function obtenerTodosLosAsientosPorUsuario ($usuario_id) {
      $sql = "select reserva_id from Asiento where usuario_id = '$usuario_id'";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }
}

