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
    $sql = "SELECT d.id as destino_id, cd.id, d.destino, c.tipo FROM CircuitoDestino cd
    JOIN Destino d ON d.id = cd.destino_id
    JOIN Circuito c ON c.id = cd.circuito_id";
    $query = $this->database->query($sql);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    return json_encode($result);
  }

  function obtenerDestinosPorCircuito ($circuito_id) {
    $cirInt = (int)$circuito_id;
    $sql = "select cd.id as circuito_destino, d.id as destino_id, d.destino, c.tipo from CircuitoDestino cd
    join Destino d on d.id = cd.destino_id
    join Circuito c on c.id = cd.circuito_id
    where cd.circuito_id = $cirInt";
    $query = $this->database->query($sql);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    return json_encode($result);
  }
}
