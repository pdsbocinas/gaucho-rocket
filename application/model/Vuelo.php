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

  function obtenerTodoslosVuelos () {
    $sql = "select * from Vuelo";
    $query = $this->database->query($sql);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    return json_encode($result);
  }

  function obtenerVueloPorId ($id) {
    $sql = "select v.id, v.titulo, v.precio, v.fecha_salida, v.fecha_llegada, v.descripcion as vueloDescripcion,
    o.destino as origen, d.destino as destino, t.cantidad_de_dias, t.porcentaje, e.descripcion as equipoDescripcion
    from Vuelo v
    inner join Destino o on v.origen_id = o.id
    inner join Destino d on v.destino_id = d.id
    inner join Tarifa t on v.tarifa_id = t.id
    inner join Equipo e on v.equipo_id = e.id
    where v.id = '$id'";
    $query = $this->database->query($sql);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    return $result;
  }

  function obtenerVuelosPorTipoDeVuelo ($equipo_id) {
    $sql = "select * from Vuelo where equipo_id = '$equipo_id'";
    $query = $this->database->query($sql);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    return json_encode($result);
  }

}
