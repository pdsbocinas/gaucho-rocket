<?php

class Controller_Reservas extends Controller{
  private $path;
  private $view;
  private $vuelo;
  private $usuario;
  private $reserva;

  function __construct() {
    // Incluyo todos los modelos a utilizar
    $this->path = Path::getInstance("config/path.ini");
    require_once( $this->path->getPage("model", "Usuario.php") );
    require_once( $this->path->getPage("model", "Vuelo.php") );
    require_once( $this->path->getPage("model", "Reserva.php") );
    $this->vuelo = new Vuelo();
    $this->usuario = new Usuario();
    $this->reserva = new Reserva();
    $this->view = new View();
  }

  function index () {
    $id = $_GET['id'];
    $data = $this->vuelo->obtenerVueloPorId($id);
    $result = json_decode($data);
    $this->view->generate('view_detalle_reserva.php', 'template_home.php', $result);
  }

  function confirm () {
    $vueloId = $_POST['id'];
    $userEmail = $_SESSION['email'];
    $userNivel = $_SESSION['nivel'];
    $nivel = $this->usuario->obtenerNivelDelUsuario($_SESSION['id']);
    if (is_null($userNivel) and is_null($nivel)) {
      $this->view->generate('micuenta/view_sin_estudio_hecho.php', 'template_home.php');
    } else {
      $data = $this->reserva->crearReserva($userEmail, $vueloId);
      $link =  "location:" . $this->path->getEvent('micuenta', 'reservas');
      header($link);
    }
  }

  function pagarReserva () {
    $reserva_id = $_POST['reserva_id'];
    $data = $this->reserva->pagarReserva($reserva_id);
    echo $data;
  }
}

?>