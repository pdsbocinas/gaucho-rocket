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

    function obtenerUsuarioDeListaDeEspera ($usuario_id, $vuelo_id) {
      $sql = "select * from ListaDeEspera where vuelo_id = $vuelo_id and usuario_id = $usuario_id";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }
    
    function agregarAListaDeEspera ($usuario_id, $vuelo_id) {
      $currentTime = date('Y-m-d H:i:s');
      $userInt = (int)$usuario_id;
      $vueloInt = (int)$vuelo_id;
      $sql= "insert into ListaDeEspera (fecha, vuelo_id, usuario_id) values ('$currentTime', $vueloInt, $userInt)";
      $query = $this->database->exec($sql);
      $query = $this->database->get_affected_rows();
      echo $query;
    }

    function obtenerListaDeEspera () {
      $sql = "select v.id, v.referencia_vuelo, v.precio, l.vuelo_id, l.usuario_id, l.fecha, v.titulo, u.email, u.nombre_de_usuario from Vuelo v
      join ListaDeEspera l on l.vuelo_id = v.id
      join Usuario u on l.usuario_id = u.id";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

    function borrarDeLaListaDeEspera ($usuario_id, $vuelo_id) {
      $sql= "delete from ListaDeEspera where vuelo_id = $vuelo_id and usuario_id = $usuario_id";
      $query = $this->database->exec($sql);
      $query = $this->database->get_affected_rows();
      return $query;
    }
  }
