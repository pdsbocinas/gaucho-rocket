<?php

class ReservaTrayecto
{
  private $database;
  private $path;
  private $reserva;
  private $destino;
  private $vuelo;

  public function __construct() {
    $this->path = Path::getInstance("config/path.ini");
    require_once( $this->path->getPage("model", "Reserva.php") );
    require_once( $this->path->getPage("model", "Destino.php") );
    require_once( $this->path->getPage("model", "Vuelo.php") );
    $this->reserva = new Reserva();
    $this->destino = new Destino();
    $this->vuelo = new Vuelo();
    $this->database = new Database();
  }

  function guardarTrayectos ($vuelo_id, $reserva_id, $destinos_id) {
    $sql = "insert into ReservaTrayecto (reserva_id, vuelo_id, destino_id) 
    values ('$reserva_id', '$vuelo_id', '$destinos_id')";
    $insertTrayecto = $this->database->exec($sql);
    $insertTrayecto = $this->database->get_affected_rows();
    return $insertTrayecto;
  }
}
