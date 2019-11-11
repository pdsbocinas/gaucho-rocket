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
  //presenta la vista Editar vuelo trayendo los datos de la base
   function editarVuelo(){
     $id=$_GET['id'];
     echo $id;
     $result = $this->vuelo->obtenerVueloPorId($id);
     echo var_dump($result);
     $data = json_decode($result,true);
    $this->view->generate('Admin/view_admin_editar_vuelos.php', 'template_admin.php',$data);
  }
   function editarVuelos(){
    $id=$_POST['id'];
    echo $id;
    $titulo=$_POST['titulo'];
    $precio=$_POST['precio'];
    $fecha_salida=$_POST['fecha_salida'];
    $fecha_llegada=$_POST['fecha_llegada'];
    $origen_id=$_POST['origen_id'];
    $destino_id=$_POST['destino_id'];
    $tarifa_id=$_POST['tarifa_id'];
    $equipo_id=$_POST['equipo_id'];
    $descripcion=$_POST['descripcion'];
    $this->vuelo->actualizaVuelo($id,$titulo, $precio, $fecha_salida, $fecha_llegada, $origen_id, $destino_id, $tarifa_id, $equipo_id, $descripcion);
  }
 
  //inserta un nuevo vuelo y lo guarda
   function guardaVuelo(){
    $titulo=$_POST['titulo'];
    $precio=$_POST['precio'];
    $fecha_salida=$_POST['fecha_salida'];
    $fecha_llegada=$_POST['fecha_llegada'];
    $origen_id=$_POST['origen_id'];
    $destino_id=$_POST['destino_id'];
    $tarifa_id=$_POST['tarifa_id'];
    $equipo_id=$_POST['equipo_id'];
    $descripcion=$_POST['descripcion'];
    $this->vuelo->nuevoVuelo( $titulo, $precio, $fecha_salida, $fecha_llegada, $origen_id, $destino_id, $tarifa_id, $equipo_id, $descripcion);
   }



 
}
