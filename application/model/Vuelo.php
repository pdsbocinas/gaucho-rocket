<?php

class Vuelo
{

  private $database;
  private $path;

  private $id;
  private $titulo;
 
  // va ser variable
  private $precio;
 
  private $fecha_salida;
  private $fecha_llegada;
  private $origen_id;
  private $destino_id;
  
  // porcentual: multiplicar por un porcentaje el precio segun la cantidad de dias que se queda. ya viene definido
  // ej: id -> 1 - cant_dias -> 10 - porcentaje -> 8 (8%)
  private $tarifa_id;
  
  // equipo ya definido en el vuelo
  private $equipo_id;

  public function __construct() {
    $this->path = Path::getInstance("config/path.ini");
    $this->database = new Database();
  }

  function buscarViajesPorKeyword ($keyword) {
    // buscar en la base de datos
    // $sql = "select * from Vuelo where like sarasa";
    // $query = $this->database->query($sql);
    // $result = $query->fetch_all(MYSQLI_ASSOC);
    // echo json_encode($result);
  }

}
