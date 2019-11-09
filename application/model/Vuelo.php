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
  function nuevoVuelo( $titulo, $precio, $fecha_salida, $fecha_llegada, $origen_id, $destino_id, $tarifa_id, $equipo_id, $descripcion){
    $sql= "INSERT INTO Vuelo (id, titulo, precio, fecha_salida, fecha_llegada, origen_id, destino_id, tarifa_id, equipo_id, descripcion) 
            VALUES   (NULL,'$titulo',$precio,'$fecha_salida', '$fecha_llegada',$origen_id, $destino_id, $tarifa_id, $equipo_id, '$descripcion');";
    $query = $this->database->exec($sql);
    $query = $this->database->get_affected_rows();
    $link =  "location:" . $this->path->getEvent('admin', 'vuelos');
    header ($link);
  }
}
