<?php

class CircuitoDestino
{
  private $database;
  private $path;
  private $destino;
  private $circuito;

  public function __construct() {
    $this->path = Path::getInstance("config/path.ini");
    require_once( $this->path->getPage("model", "Destino.php") );
    require_once( $this->path->getPage("model", "Circuito.php") );
    $this->destino = new Destino();
    $this->circuito = new Circuito();
    $this->database = new Database();
  }

  function obtenerTodosLosDestinoPorCircuito () {
    $sql = "select d.destino, c.tipo from CircuitoDestino cd
    join Destino d on d.id = cd.destino_id
    join Circuito c on c.id = cd.circuito_id";
    $query = $this->database->query($sql);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    return json_encode($result);
  }
}

?>