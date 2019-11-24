<?php

class Controller_Admin extends Controller {

  private $path;
  private $view;
  private $vuelo;
  private $centroMedico;
  private $listaDeEspera;
  private $reserva;

  function __construct() {
    // Incluyo todos los modelos a utilizar
    $this->path = Path::getInstance("config/path.ini");
    require_once($this->path->getPage("model", "Usuario.php") );
    require_once($this->path->getPage("model", "Vuelo.php"));
    require_once($this->path->getPage("model", "CentroMedico.php"));
    require_once($this->path->getPage("model", "ListaDeEspera.php"));
    require_once($this->path->getPage("model", "Reserva.php"));

    $this->vuelo = new Vuelo();
    $this->view = new View();
    $this->centroMedico = new CentroMedico();
    $this->listaDeEspera = new ListaDeEspera();
    $this->reserva = new Reserva();
  }
  
  function index () {
    $this->view->generate('Admin/view_admin.php', 'template_home.php');
  }

  function vuelos () {
    $result = $this->vuelo->obtenerTodoslosVuelos();
    $data = json_decode($result, true);
    $this->view->generate('Admin/view_admin_vuelos.php', 'template_admin.php', $data);
  }

  function centros(){
    $result = $this->centroMedico->obtenerTodosLosCentrosMedicos();
    $data = json_decode($result, true);
    $this->view->generate('Admin/view_admin_centros.php', 'template_admin.php', $data);
  }

  function editarCentro(){
    $id=$_GET['id'];
     $result = $this->centroMedico->obtenerCentroPorId($id);
     $data = json_decode($result, true);
    $this->view->generate('Admin/view_admin_editar_centros.php', 'template_admin.php',$data);
  }

  function eliminarCentro(){
    $id=$_GET['id'];
    $this->centroMedico->eliminaCentroPorId($id);
  }

  function altaCentro(){
    $this->view->generate('Admin/view_admin_alta_centros.php', 'template_admin.php');
  }

  function guardaCentro(){
    //$id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $ubicacion=$_POST['ubicacion'];
    
    $this->centroMedico->nuevoCentro($nombre,$ubicacion);
  }
  
  function exito(){
    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $ubicacion=$_POST['ubicacion'];
    $this->centroMedico->actualizaCentro($id,$nombre,$ubicacion);
  }

  function altaVuelos(){
    $this->view->generate('Admin/view_admin_alta_vuelos.php', 'template_admin.php');
  }

  function eliminarVuelo(){
    $id=$_GET['id'];
    $this->vuelo->eliminaVueloPorId($id);
  }

  function editarVuelo(){
    $id=$_GET['id'];
    $result = $this->vuelo->obtenerVueloPorId($id);
    $data = json_decode($result,true);
    $this->view->generate('Admin/view_admin_editar_vuelos.php', 'template_admin.php',$data);
  }

  function actualizaVuelo(){
    $id=(int)$_POST['id'];
    $titulo=$_POST['titulo'];
    $precio=$_POST['precio'];
    $fecha_salida=$_POST['fecha_salida'];
    $fecha_llegada=$_POST['fecha_llegada'];
    $origen_id=$_POST['origen_id'];
    $destino_id=$_POST['destino_id'];
    $tarifa_id=$_POST['tarifa_id'];
    $descripcion=$_POST['descripcion'];
    $avion_id=$_POST['avion_id'];

    $this->vuelo->actualizaVuelo($id, $titulo, $precio, $fecha_salida, $fecha_llegada, $origen_id, $destino_id, $tarifa_id, $descripcion, $avion_id);
  }
 
  function guardaVuelo(){
    $titulo=$_POST['titulo'];
    $precio=$_POST['precio'];
    $fecha_salida=$_POST['fecha_salida'];
    $fecha_llegada=$_POST['fecha_llegada'];
    $origen_id=$_POST['origen_id'];
    $destino_id=$_POST['destino_id'];
    $tarifa_id=$_POST['tarifa_id'];
    $descripcion=$_POST['descripcion'];
    $avion_id=$_POST['avion_id'];

    $this->vuelo->nuevoVuelo($titulo, $precio, $fecha_salida, $fecha_llegada, $origen_id, $destino_id, $tarifa_id, $descripcion, $avion_id);
  }

  function listas(){
    $result = $this->listaDeEspera->obtenerListaDeEspera();
    $data = json_decode($result,true);
    $this->view->generate('Admin/listaDeEsperas/view_admin_lista_de_esperas.php', 'template_admin.php', $data);
  }

  function reservas () {
    $pagas = json_decode($this->reserva->obtenerReservasPagas(), true);
    $noPagas = json_decode($this->reserva->obtenerReservasNoPagas(), true);
    $data = [
      "pagas" => $pagas,
      "noPagas" => $noPagas,
    ];
    $this->view->generate('Admin/reservas/view_admin_reservas.php', 'template_admin.php', $data);
  }
 
}
