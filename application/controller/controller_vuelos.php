<?php

class Controller_Vuelos extends Controller{

  private $path;
  private $view;
  private $vuelo;

  function __construct() {
    // Incluyo todos los modelos a utilizar
    $this->path = Path::getInstance("config/path.ini");
    require_once( $this->path->getPage("model", "Usuario.php") );
    require_once( $this->path->getPage("model", "Vuelo.php") );
    $this->vuelo = new Vuelo();
    $this->view = new View();
  }

  function index () {
    $this->view->generate('view_home.php', 'template_home.php');
  }

  function obtenerTodoslosVuelos () {
    $data = $this->vuelo->obtenerTodoslosVuelos();
    return $data;
  }

  function obtenerVuelosPorTipoDeVuelo () {
    $equipo_id = $_POST['equipo_id'];
    $data = $this->vuelo->obtenerVuelosPorTipoDeVuelo($equipo_id);
    echo $data;
  }

}