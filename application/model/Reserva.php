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
  }
  
?>



