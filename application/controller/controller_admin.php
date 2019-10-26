<?php

class Controller_Admin extends Controller {

  private $path;
  private $view;
  private $vuelo;

  function __construct() {
    // Incluyo todos los modelos a utilizar
    $this->path = Path::getInstance("config/path.ini");
    require_once($this->path->getPage("model", "Usuario.php") );
		require_once($this->path->getPage("model", "Vuelo.php"));
    $this->vuelo = new Vuelo();
    $this->view = new View();
  }

  function index () {
    $this->view->generate('Admin/view_admin.php', 'template_home.php');
  }

  function vuelos () {
    $result = $this->vuelo->obtenerTodoslosVuelos();
    $data = json_decode($result, true);
    $this->view->generate('Admin/view_admin_vuelos.php', 'template_admin.php', $data);
  }

  function crearCentro () {
    echo "hola!!!";
  }

  function verTodosLosCentros () {
    echo "hola!!!";
  }

  function modificarCentros () {
    echo "hola!!!";
  }
}
