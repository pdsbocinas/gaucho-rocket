<?php

class Controller_Vuelos extends Controller{

  private $path;
  private $view;
  private $vuelo;
  private $circuitoDestino;

  function __construct() {
    // Incluyo todos los modelos a utilizar
    $this->path = Path::getInstance("config/path.ini");
    require_once( $this->path->getPage("model", "Usuario.php") );
    require_once( $this->path->getPage("model", "Vuelo.php") );
    require_once( $this->path->getPage("model", "CircuitoDestino.php") );

    $this->vuelo = new Vuelo();
    $this->circuitoDestino = new CircuitoDestino();
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

  function obtenerVuelosPorDestinoFechas () {
    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];
    $origen_id = $_POST['origen_id'];
    $destino_id = $_POST['destino_id'];
    $data = $this->vuelo->obtenerVuelosPorDestinoFechas($origen_id, $destino_id, $desde, $hasta);
    echo $data;
  }

  function obtenerVuelosPorPrecio () {
    $min = $_POST['min'];
    $max = $_POST['max'];
    $data = $this->vuelo->obtenerVuelosPorPrecio($min, $max);
    echo $data;
  }

  function obtenerTodosLosDestinoPorCircuito () {
    $data = $this->circuitoDestino->circuitoDestino();
    $result = json_decode($data, true);
    echo $data;
  }

}