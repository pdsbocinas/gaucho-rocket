<?php
  class ListaDeEspera {

    private $database;
    private $path;

    private $id;
    private $fecha;
    private $usuario_id;
    private $avion_id;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }

    function obtenerDeListaDeEspera ($usuario_id, $vuelo_id) {
      $sql = "select * from ListaDeEspera where vuelo_id = '$vuelo_id' and usuario_id = '$usuario_id'";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }
    
    function agregarAListaDeEspera ($usuario_id, $vuelo_id) {
      $currentTime = date('Y-m-d H:i:s');
      $sql= "insert into ListaDeEspera (fecha, vuelo_id, usuario_id) values ('$currentTime', '$vuelo_id', '$usuario_id')";
      $query = $this->database->exec($sql);
      $query = $this->database->get_affected_rows();
      echo $query;
    }

  }
?>