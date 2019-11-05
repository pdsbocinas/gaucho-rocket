<?php

class Controller_MiCuenta extends Controller{

  private $path;
  private $view;
  private $turno;
  private $usuario;
  private $centros;
  
  function __construct() {
    // Incluyo todos los modelos a utilizar
    $this->path = Path::getInstance("config/path.ini");
    require_once( $this->path->getPage("model", "Usuario.php") );
    require_once( $this->path->getPage("model", "CentroMedico.php") );
    require_once( $this->path->getPage("model", "Turno.php") );
    $this->view = new View();
    $this->usuario = new Usuario();
    $this->turno = new Turno();
    $this->centros = new CentroMedico();
  }

  function index () {
    $this->view->generate('view_home.php', 'template_home.php');
  }

  function reservas () {
    $this->view->generate('view_home.php', 'template_home.php');

  }

  function examenes () {
    //var_dump($_SESSION['nivel']);die();
    if (is_null($_SESSION['nivel'])) {
      $result = $this->centros->obtenerTodosLosCentrosMedicos();
      $data = json_decode($result, true);
      $this->view->generate('view_sin_examen_medico.php', 'template_home.php', $data);
    } else {
      $this->view->generate('view_con_examen_medico.php', 'template_home.php');
    }
  }

  function crearTurno () {
    $currentTime = date('Y-m-d H:i:s');
    $usuario_id = (int)$_SESSION['id'];
    $centro_id = (int)$_POST['centro_id'];
    $result = $this->turno->crearTurno($usuario_id, $centro_id ,$currentTime);
    echo $result;
  }

}