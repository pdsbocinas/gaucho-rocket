<?php

class Controller_MiCuenta extends Controller{

  private $path;
  private $view;
  private $turno;
  private $usuario;
  private $centros;
  private $reserva;
  private $vuelo;
  private $equipo;

  function __construct() {
    // Incluyo todos los modelos a utilizar
    $this->path = Path::getInstance("config/path.ini");
    require_once( $this->path->getPage("model", "Usuario.php") );
    require_once( $this->path->getPage("model", "CentroMedico.php") );
    require_once( $this->path->getPage("model", "Turno.php") );
    require_once( $this->path->getPage("model", "Reserva.php") );
    require_once( $this->path->getPage("model", "Vuelo.php") );
    require_once( $this->path->getPage("model", "Equipo.php") );

    $this->view = new View();
    $this->usuario = new Usuario();
    $this->turno = new Turno();
    $this->centros = new CentroMedico();
    $this->reserva = new Reserva();
    $this->vuelo = new Vuelo();
    $this->equipo = new Equipo();
  }

  function index () {
    $this->view->generate('view_home.php', 'template_home.php');
  }

  function reservas () {
    $id = $_SESSION['id'];
    $data = $this->reserva->obtenerReservasPorUsuario($id);
    $data = json_decode($data);
    $this->view->generate('micuenta/view_mis_reservas.php', 'template_home.php', $data);
  }

  function examenes () {
    $id = $_SESSION['id'];
    $user = $this->usuario->obtenerNivelDelUsuario($id);
    $user = json_decode($user);
    if (is_null($_SESSION['nivel']) and is_null($user->nivel)) {
      $result = $this->centros->obtenerTodosLosCentrosMedicos();
      $data = json_decode($result, true);
      $this->view->generate('micuenta/view_sin_examen_medico.php', 'template_home.php', $data);
    } else {
      $data = $user;
      $this->view->generate('micuenta/view_con_examen_medico.php', 'template_home.php', $data);
    }
  }

  function crearTurno () {
    $id = $_SESSION['id'];
    $user = $this->usuario->obtenerNivelDelUsuario($id);
    $user = json_decode($user);
    if(is_null($_SESSION['nivel']) and is_null($user->nivel)) {
      $currentTime = date('Y-m-d H:i:s');
      $usuario_id = (int)$_SESSION['id'];
      $centro_id = (int)$_POST['centro_id'];
      $result = $this->turno->crearTurno($usuario_id, $centro_id ,$currentTime);
      $this->centros->otorgarPermisoMedico($usuario_id);
      $this->view->generate('micuenta/view_con_examen_medico.php', 'template_home.php');
    } else {
      $link =  "location:" . $this->path->getEvent('main', 'index');
      header($link);
    }
  }

  function cerrarSession(){
    session_start();
    session_destroy();
    $link =  "location:" . $this->path->getEvent('main', 'index');
    header($link);
  }

  function checkin(){
      $this->view->generate('micuenta/view_checkin.php', 'template_home.php');
  }

  function traeReservasParaRealizarCheckin(){
    $id = (int)$_GET['id'];
    $codigo = $_GET['codigo'];
    $result=$this->reserva->ConsultaPorCodigoDeReservaPagaUsuario($codigo,$id);
    $data=json_decode($result, true);
    $this->view->generate('micuenta/checkin_paso1.php', 'template_home.php', $data);
  }

  function checkinPaso2 () {
    $this->view->generate('micuenta/checkin_paso2.php', 'template_home.php');
  }

  function obtenerCapacidadTotal () {
    $vuelo_id = (int)$_GET['vuelo_id'];
    $vuelo = $this->vuelo->obtenerVueloPorId($vuelo_id);
    $avion_id = json_decode($vuelo, true)[0]['avion_id'];
    $capacidad = $this->equipo->obtenerCapacidad($avion_id);
    echo $capacidad;
  }
}