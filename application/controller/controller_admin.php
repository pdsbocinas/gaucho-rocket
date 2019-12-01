<?php

class Controller_Admin extends Controller {

  private $path;
  private $view;
  private $vuelo;
  private $centroMedico;
  private $listaDeEspera;
  private $reserva;

  function __construct() {
    $this->path = Path::getInstance("config/path.ini");
    require_once($this->path->getPage("model", "Usuario.php") );
    require_once($this->path->getPage("model", "Vuelo.php"));
    require_once($this->path->getPage("model", "CentroMedico.php"));
    require_once($this->path->getPage("model", "ListaDeEspera.php"));
    require_once($this->path->getPage("model", "Reserva.php"));
    require_once($this->path->getPage("model", "Equipo.php"));

    $this->vuelo = new Vuelo();
    $this->view = new View();
    $this->centroMedico = new CentroMedico();
    $this->listaDeEspera = new ListaDeEspera();
    $this->reserva = new Reserva();
    $this->equipo = new Equipo();
  }
  
  function index () {
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $this->view->generate('Admin/view_admin.php', 'template_home.php');
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
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
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $id=$_GET['id'];
      $result = $this->centroMedico->obtenerCentroPorId($id);
      $data = json_decode($result, true);
      $this->view->generate('Admin/view_admin_editar_centros.php', 'template_admin.php',$data);
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
      
  }

  function eliminarCentro(){
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $id=$_GET['id'];
      $this->centroMedico->eliminaCentroPorId($id);
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
    
  }

  function altaCentro(){
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $this->view->generate('Admin/view_admin_alta_centros.php', 'template_admin.php');
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
    
  }

  function guardaCentro(){
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $nombre=$_POST['nombre'];
      $ubicacion=$_POST['ubicacion'];
      $this->centroMedico->nuevoCentro($nombre,$ubicacion);
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
   
  }
  
  function exito(){
    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $ubicacion=$_POST['ubicacion'];
    $this->centroMedico->actualizaCentro($id,$nombre,$ubicacion);
  }

  function altaVuelos(){
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $this->view->generate('Admin/view_admin_alta_vuelos.php', 'template_admin.php');
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);

  }

  function eliminarVuelo(){
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $id=$_GET['id'];
      $this->vuelo->eliminaVueloPorId($id);
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
    
    
  }

  function editarVuelo(){
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $id=$_GET['id'];
      $result = $this->vuelo->obtenerVueloPorId($id);
      $data = json_decode($result,true);
      $this->view->generate('Admin/view_admin_editar_vuelos.php', 'template_admin.php',$data);
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
    
  
   
  }

  function actualizaVuelo(){
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
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
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
  }
 
  function guardaVuelo(){
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
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
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
    }

  function listas(){
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $result = $this->listaDeEspera->obtenerListaDeEspera();
      $data = json_decode($result,true);
      $this->view->generate('Admin/listaDeEsperas/view_admin_lista_de_esperas.php', 'template_admin.php', $data);
    }
    $link =  "location:" . $this->path->getEvent('main', 'index');
		header($link);
  }

  function reservas () {
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $pagas = json_decode($this->reserva->obtenerReservasPagas(), true);
      $noPagas = json_decode($this->reserva->obtenerReservasNoPagas(), true);
      $data = [
        "pagas" => $pagas,
        "noPagas" => $noPagas,
      ];
      $this->view->generate('Admin/reservas/view_admin_reservas.php', 'template_admin.php', $data);
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
  }
  
  function reportes () {
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $this->view->generate('Admin/reportes/view_admin_reportes.php', 'template_admin.php');
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
   
  }

  function obtenerFacturacionPorMes () {
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $inicio = "2019-01-01";
      $fin = "2020-01-01";
      $data = $this->reserva->obtenerFacturacionPorMes($inicio, $fin);
      $data = json_decode($data, true);
      $this->view->generate('Admin/reportes/view_admin_facturacion_por_mes.php', 'template_admin.php', $data);
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
  }

  function cabinaMasVendida () {
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $data = $this->reserva->obtenerCabinaMasVendida();
      $data = json_decode($data, true);
      $this->view->generate('Admin/reportes/view_admin_cabina mas vendida.php', 'template_admin.php', $data);
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
   
  }

  function facturacionPorUsuario () {
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $data = $this->reserva->obtenerFacturacionPorUsuario();
      $data = json_decode($data, true);
      $this->view->generate('Admin/reportes/view_admin_facturacion_por_usuario.php', 'template_admin.php', $data);
    }
    $link =  "location:" . $this->path->getEvent('main', 'index');
		header($link);   
  }

  function tasaOcupacionPorViajeyEquipo(){
    if(isset($_SESSION['rol']) && $_SESSION['rol'] === "admin"){
      $data = $this->equipo->obtenerVuelosPorEquipoyCapacidad();
      $data = json_decode($data, true);
      $this->view->generate('Admin/reportes/view_admin_tasa_ocupacion_viaje_equipo.php', 'template_admin.php', $data);
    }
      $link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
  }

}
