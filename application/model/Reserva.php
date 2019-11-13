<?php
  class Reserva {
    
    private $path;
    private $database;

    // se debe autogenerar un codigo
    private $codigo;
    private $fecha;

    // el vuelo tiene fecha de salida y de entrada, y tarifa
    private $vuelo_id;
        
    // me traigo los servicios con sus porcentajes
    private $servicio_id;
    
    // generar un nuevo usuario cuando el tipo agrega invitados al viaje
    private $usuario_id;
    
    // seria el valor del vuelo + el de la cabina + el del servicio
    private $precio_final;
    
    private $pagada;

    private $tipo_de_cabina;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }

    function crearReserva($userEmail, $vueloId) {
      $currentTime = date('Y-m-d H:i:s');
      $result = md5($userEmail);
      $sql = "insert into Reserva (codigo, fecha, vuelo_id, servicio_id, usuario_id, precio_final, pagada, tipo_de_cabina) 
      values ('$result', '$currentTime', '$vueloId', 1, 1, 123456, 0, 'general')";
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
  }
  
?>



