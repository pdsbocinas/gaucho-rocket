<?php
  class Asiento {
    
    private $path;
    private $database;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }

    function guardarAsiento ($asiento, $vuelo_id, $usuario_id) {
      $sql = "insert into Asiento (asiento, vuelo_id, usuario_id) 
      values ('$asiento', '$vuelo_id', '$usuario_id')";
      $insertAsiento = $this->database->exec($sql);
      $insertAsiento = $this->database->get_affected_rows();
      return $insertAsiento;
    }

    function obtenerAsientosOcupados ($vuelo_id) {
      $sql = "select asiento from Asiento where vuelo_id = '$vuelo_id'";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }
}
?>

