<?php

class Controller_Admin extends Controller {

  private $path;
  private $view;
  private $vuelo;
  private $centroMedico;
  
  
  function __construct() {
    // Incluyo todos los modelos a utilizar
    $this->path = Path::getInstance("config/path.ini");
    require_once($this->path->getPage("model", "Usuario.php") );
    require_once($this->path->getPage("model", "Vuelo.php"));
    require_once($this->path->getPage("model", "CentroMedico.php"));
    $this->vuelo = new Vuelo();
    $this->view = new View();
    $this->centroMedico= new CentroMedico();
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

  
   function altaVuelos(){
    $this->view->generate('Admin/view_admin_alta_vuelos.php', 'template_admin.php');
   }

   
   function guardaVuelo(){
    $titulo=$_GET['titulo'];
    $precio=$_GET['precio'];
    $fecha_salida=($_GET['fecha_salida']);
    $fecha_llegada=($_GET['fecha_llegada']);
    $origen_id=$_GET['origen_id'];
    $destino_id=$_GET['destino_id'];
    $tarifa_id=$_GET['tarifa_id'];
    $equipo_id=$_GET['equipo_id'];
    $descripcion=$_GET['descripcion'];
    $this->vuelo->nuevoVuelo( $titulo, $precio, $fecha_salida, $fecha_llegada, $origen_id, $destino_id, $tarifa_id, $equipo_id, $descripcion);
   }

   function altaCentro(){
    $this->view->generate('Admin/view_admin_alta_centros.php', 'template_admin.php');
     }
  function guardaCentro(){
    //$id=$_GET['id'];
    $nombre=$_GET['nombre'];
    $ubicacion=$_GET['ubicacion'];
    $this->centroMedico->nuevoCentro($nombre,$ubicacion);
   }
  
  function exito(){
    $id=$_GET['id'];
    $nombre=$_GET['nombre'];
    $ubicacion=$_GET['ubicacion'];
    $this->centroMedico->actualizaCentro($id,$nombre,$ubicacion);
  }
 
}
