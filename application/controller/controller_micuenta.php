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
    $id = $_SESSION['id'];
    $user = $this->usuario->obtenerNivelDelUsuario($id);
    $user = json_decode($user);
    if (is_null($_SESSION['nivel']) and is_null($user->nivel)) {
      $result = $this->centros->obtenerTodosLosCentrosMedicos();
      $data = json_decode($result, true);
      $this->view->generate('Examenes/view_sin_examen_medico.php', 'template_home.php', $data);
    } else {
      $data = $user;
      $this->view->generate('Examenes/view_con_examen_medico.php', 'template_home.php', $data);
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
      $this->view->generate('Examenes/view_con_examen_medico.php', 'template_home.php');
    } else {
      $link =  "location:" . $this->path->getEvent('main', 'index');
      header($link);
    }
  }

}