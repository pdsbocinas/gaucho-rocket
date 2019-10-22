<?php
  class Reserva {
    
    private $path;
    private $database;

    // se debe autogenerar un codigo
    private $codigo;
    private $fecha;

    // el vuelo tiene fecha de salida y de entrada, y tarifa
    private $vuelo_id;
    
    // me traigo las cabinas con sus porcentajes
    private $cabina_id;
    
    // me traigo los servicios con sus porcentajes
    private $servicio_id;
    
    // generar un nuevo usuario cuando el tipo agrega invitados al viaje
    private $usuario_id;
    
    // seria el valor del vuelo + el de la cabina + el del servicio
    private $precio_final;
    
    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }

    function crearReserva($userEmail, $vueloId) {
      $currentTime = date('Y-m-d H:i:s');
      $sql = "insert into Reserva (codigo, fecha, vuelo_id, cabina_id, servicio_id, usuario_id, precio_final) 
      values ('fse4634b', '$currentTime', '$vueloId', 1, 1, 1, 123456)";
      $insertReserva = $this->database->exec($sql);
      $insertReserva = $this->database->get_affected_rows();
      $link =  "location:" . $this->path->getEvent('main', '');
      header($link);
    }
  }
  
?>



