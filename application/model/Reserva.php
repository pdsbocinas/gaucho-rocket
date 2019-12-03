<?php
  class Reserva {
    
    private $path;
    
    private $database;

    private $codigo;

    private $fecha;

    private $vuelo_id;
        
    private $servicio_id;
    
    private $usuario_id;
    
    private $precio_final;
    
    private $pagada;

    private $tipo_de_cabina;

    private $vuelo;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      require_once( $this->path->getPage("model", "Equipo.php") );
      require_once( $this->path->getPage("model", "Vuelo.php") );
      $this->database = new Database();
      $this->equipo = new Equipo();
      $this->vuelo = new Vuelo();
    }

    function crearReserva($user_id, $userEmail, $vueloId, $servicio, $precioFinal, $menu = null) {
      $currentTime = date('Y-m-d H:i:s');
      $codigo = md5($currentTime);
      $sql = "insert into Reserva (codigo, fecha, vuelo_id, servicio_id, usuario_id, precio_final, pagada, tipo_de_cabina) 
      values ('$codigo', '$currentTime', $vueloId, $servicio, $user_id, $precioFinal, 0, '$menu')";
      $insertReserva = $this->database->exec($sql);
      $insertReserva = $this->database->get_affected_rows();
      return $codigo;
    }

    function obtenerReservasPorUsuario($id) {
      $sql = "select r.id, r.codigo, r.fecha, v.titulo, s.descripcion, u.email, r.tipo_de_cabina, r.precio_final, r.pagada, r.checkin from Reserva r 
      join Servicio s on s.id = r.servicio_id
      join Usuario u on u.id = r.usuario_id
      join Vuelo v on v.id = r.vuelo_id
      where usuario_id = '$id'";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

    function pagarReserva($reserva_id) {
      $sql = "update Reserva set pagada = 1 where id = " . $reserva_id;
      $updateReserva = $this->database->exec($sql);
      $updateReserva = $this->database->get_affected_rows();
      $updateReserva;
    }

    function ConsultaPorCodigoDeReservaPagaUsuario($codigo,$usuario_id){
      $sql="SELECT r.id as reserva_id, v.id as vuelo_id, r.codigo, v.fecha_salida, r.tipo_de_cabina FROM Reserva r join Vuelo v on r.vuelo_id = v.id WHERE codigo = '$codigo' and usuario_id = $usuario_id and pagada = 1";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }
    
    function obtenerDisponibilidad($result) {
      $vuelo_id = (int)$result[0]['id'];
      $vRef = (int)$result[0]['referencia_vuelo'];
      $avion_id = (int)$result[0]['avion_id'];
      
      if ($result[0]['referencia_vuelo'] == null) {
        $sql = "select COUNT(*) as total from Reserva r
        join Vuelo v on v.id = r.vuelo_id
        where r.vuelo_id = $vuelo_id or exists
        (SELECT id FROM Vuelo vl where vl.referencia_vuelo = $vuelo_id)";
      } else {
        $sql = "select COUNT(*) as total from Reserva r 
        join Vuelo v on v.id = r.vuelo_id
        join Avion av on av.id = v.avion_id
        where (r.vuelo_id = $vuelo_id or r.vuelo_id = $vRef) and v.avion_id = $avion_id";
      }

      $query = $this->database->query($sql);
      $data = $query->fetch_all(MYSQLI_ASSOC);
      $cantidad_de_reservas = (int)$data[0]['total'];

      $capacidad = json_decode($this->equipo->obtenerCapacidad($avion_id), true);
      $capacidad = (int)$capacidad[0]['familiar'] + (int)$capacidad[0]['general'] + (int)$capacidad[0]['suite'];
      $lugares_disponibles = $capacidad - $cantidad_de_reservas;

      $disponibilidad = [
        "mensaje" => "quedan " . $lugares_disponibles . " lugares.",
        "disponibilidad" => true,
      ];
      $no_hay_disponibilidad = [
        "mensaje" => "no hay mas lugar",
        "disponibilidad" => false,
      ];
      
      if ($capacidad == $cantidad_de_reservas) {
        return $no_hay_disponibilidad;
      } else {
        return $disponibilidad;
      }
    }

    function eliminarReserva ($reserva_id) {
      $sql = "delete from Reserva where id = '$reserva_id'";
      $deleteReserva = $this->database->exec($sql);
      $deleteReserva = $this->database->get_affected_rows();
      $link =  "location:" . $this->path->getEvent('reservas', 'exito');
      header($link);
      exit();
    }

    function obtenerReservasPagas () {
      $sql = "select r.id as reserva_id, r.codigo, v.id as vuelo_id, v.referencia_vuelo, r.usuario_id from Reserva r join Vuelo v on v.id = r.vuelo_id where pagada = 1";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

    function obtenerReservasNoPagas () {
      $sql = "select r.id as reserva_id, r.codigo, v.id as vuelo_id, v.referencia_vuelo, r.usuario_id from Reserva r join Vuelo v on v.id = r.vuelo_id where pagada = 0";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

    function obtenerFacturacionPorMes ($desde, $hasta) {
      $sql = "select sum(precio_final) as total,count(*) as 'Cantidad de Facturas' from Reserva where fecha BETWEEN '$desde' AND  '$hasta';";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

    function obtenerCabinaMasVendida ($inicio,$fin) {
      $sql = "
      select tipo_de_cabina, count(tipo_de_cabina) as cantidad FROM Reserva where pagada = 1 AND fecha BETWEEN '$inicio' AND '$fin' GROUP BY tipo_de_cabina ORDER BY cantidad DESC";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

    function obtenerFacturacionPorUsuario () {
      $sql = "select usuario_id,count(*) as cantidad, sum(precio_final)as total from Reserva where pagada = 1 group by usuario_id";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

    function traeDatosGeneraPase($id){
      $sql = "select u.estado,v.fecha_salida,u.nombre_de_usuario,u.id,r.tipo_de_cabina,a.asiento,O.destino as Origen,D.destino as Destino,v.id as vuelo_id,u.email,r.id as reserva_id
              from usuario u join reserva r on u.id=r.usuario_id
              join asiento a on a.vuelo_id=r.vuelo_id 
              join vuelo v on a.vuelo_id=v.id
              join Destino O on O.id = v.origen_id
              join Destino D on D.id = v.destino_id
              where r.pagada=1 && r.id=$id ";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

    function obtenerReservaPorCodigo($codigo){
      $sql="select * from Reserva where codigo = '$codigo'";
      $query = $this->database->query($sql);
      $result = $query->fetch_all(MYSQLI_ASSOC);
      return json_encode($result);
    }

    function actualizarCheckin ($reserva_id) {
      $sql = "update Reserva set checkin = 1 where id = " . $reserva_id;
      $updateReserva = $this->database->exec($sql);
      $updateReserva = $this->database->get_affected_rows();
      $updateReserva;
    }
  }




