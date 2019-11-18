<?php
  class Reserva {
    
    private $path;
    
    private $database;

    private $codigo;

    private $fecha;

    private $vuelo_id;
        
    private $servicio_id;
    
    private $usuario_id;
    
    private $precio_final;
    
    private $pagada;

    private $tipo_de_cabina;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      require_once( $this->path->getPage("model", "Equipo.php") );
      $this->database = new Database();
      $this->equipo = new Equipo();
    }

    function crearReserva($user_id, $userEmail, $vueloId, $servicio, $precioFinal, $cabina) {
      $currentTime = date('Y-m-d H:i:s');
      $result = md5($userEmail);
      $sql = "insert into Reserva (codigo, fecha, vuelo_id, servicio_id, usuario_id, precio_final, pagada, tipo_de_cabina) 
      values ('$result', '$currentTime', '$vueloId', $servicio, '$user_id', $precioFinal, 0, '$cabina')";
      $insertReserva = $this->database->exec($sql);
      $insertReserva = $this->database->get_affected_rows();
      return $insertReserva;
    }

    function obtenerReservasPorUsuario($id) {
      $sql = "select * from Reserva where usuario_id = '$id'";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

    function pagarReserva($reserva_id) {
      $sql = "update Reserva set pagada = 1 where id = " . $reserva_id;
      $updateReserva = $this->database->exec($sql);
      $updateReserva = $this->database->get_affected_rows();
      $updateReserva;
    }

    function obtenerDisponibilidad($result) {
      
      $vuelo_id = $result[0]['id'];
      $avion_id = (int)$result[0]['avion_id'];
      
      $sql = "select count(*) from Reserva r 
      join Vuelo v on v.id = r.vuelo_id
      join Avion av on av.id = v.avion_id
      where r.vuelo_id = '$vuelo_id' and v.avion_id = '$avion_id'";
      $query = $this->database->query($sql);
      $data = $query->fetch_all(MYSQLI_ASSOC);
      $cantidad_de_reservas = (int)$data[0]['count(*)'];
      
      $capacidad = json_decode($this->equipo->obtenerCapacidad($avion_id), true);
      $capacidad = (int)$capacidad[0]['familiar'] + (int)$capacidad[0]['general'] + (int)$capacidad[0]['suite'];
      $lugares_disponibles = $capacidad - $cantidad_de_reservas;

      $disponibilidad = [
        "mensaje" => "quedan " . $lugares_disponibles . " lugares.",
        "disponibilidad" => true,
      ];
      $no_hay_disponibilidad = [
        "mensaje" => "no hay mas lugar",
        "disponibilidad" => false,
      ];
      
      if ($capacidad == $cantidad_de_reservas) {
        return $no_hay_disponibilidad;
      } else {
        return $disponibilidad;
      }
    }
  }
  
?>



