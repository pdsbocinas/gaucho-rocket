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
  private $avion_id;
  private $descripcion;
  // equipo ya definido en el vuelo

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

  public function eliminaVueloPorId($id){
    $sql= "DELETE FROM Vuelo WHERE id=$id;";
    $query = $this->database->exec($sql);
    $query = $this->database->get_affected_rows();
    $link =  "location:" . $this->path->getEvent('admin', 'vuelos');
    header ($link);
  }

  function obtenerVueloPorId ($id) {
    $sql = "SELECT * FROM Vuelo where id = $id;";
    $query = $this->database->query($sql);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    return json_encode($result);
  }

  function nuevoVuelo( $titulo, $precio, $fecha_salida, $fecha_llegada, $origen_id, $destino_id, $tarifa_id, $descripcion, $avion_id){
    $sql= "INSERT INTO Vuelo (id, titulo, precio, fecha_salida, fecha_llegada, origen_id, destino_id, tarifa_id, descripcion, avion_id) VALUES (NULL,'$titulo',$precio,'$fecha_salida', '$fecha_llegada',$origen_id, $destino_id, $tarifa_id, '$descripcion', '$avion_id');";
    $query = $this->database->exec($sql);
    $query = $this->database->get_affected_rows();
    $link =  "location:" . $this->path->getEvent('admin', 'vuelos');
    header ($link);
  }

  function obtenerVuelosPorTipoDeVuelo ($equipo_id) {
    $id = $equipo_id;
    $sql = "select * from Vuelo v join Equipo e on e.id = v.avion_id where e.tipo = '$id'";
    $query = $this->database->query($sql);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    return json_encode($result);
  }

  function obtenerVuelosPorDestinoFechas ($origen_id, $destino_id, $desde, $hasta) {
    $sql = "select * from Vuelo where origen_id = '$origen_id' and destino_id = '$destino_id' and fecha_salida >= '$desde' and fecha_llegada <= '$hasta'";
    $query = $this->database->query($sql);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    return json_encode($result);
  }

  function actualizaVuelo($id, $titulo, $precio, $fecha_salida, $fecha_llegada, $origen_id, $destino_id, $tarifa_id, $descripcion, $avion_id) {
    $sql= "UPDATE Vuelo
            SET titulo= '$titulo',
                precio = $precio,
                fecha_salida = '$fecha_salida',
                fecha_llegada = '$fecha_llegada',
                origen_id = $origen_id,
                destino_id = $destino_id,
                tarifa_id = $tarifa_id,
                descripcion = '$descripcion'
                avion_id = $avion_id
            WHERE id = '$id'";
    $query = $this->database->exec($sql);
    $query = $this->database->get_affected_rows();
    $link =  "location:" . $this->path->getEvent('admin','vuelos');
    header ($link);
  }

  function obtenerVuelosPorPrecio($min, $max) {
    $sql = "select * from Vuelo where precio >= '$min' and precio <= '$max'";
    $query = $this->database->query($sql);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    return json_encode($result);
  }
}
