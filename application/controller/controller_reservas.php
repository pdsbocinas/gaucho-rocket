<?php

class Controller_Reservas extends Controller{
  private $path;
  private $view;
  private $vuelo;
  private $usuario;

  function __construct() {
    // Incluyo todos los modelos a utilizar
    $this->path = Path::getInstance("config/path.ini");
    require_once( $this->path->getPage("model", "Usuario.php") );
    require_once( $this->path->getPage("model", "Vuelo.php") );
    $this->vuelo = new Vuelo();
    $this->usuario = new Usuario();
    $this->view = new View();
  }

  function index () {
    $id = $_GET['id'];
    $data = $this->vuelo->obtenerVueloPorId($id);
    $result = json_decode($data, true);
    $this->view->generate('view_detalle_reserva.php', 'template_home.php', $data);
  }
}

?>