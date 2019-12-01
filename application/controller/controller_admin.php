<?php

class Controller_Admin extends Controller {

  private $path;
  private $view;
  private $vuelo;
  private $centroMedico;
  private $listaDeEspera;
  private $reserva;
  private $pdf;

  function __construct() {
    $this->path = Path::getInstance("config/path.ini");
    require_once($this->path->getPage("model", "Usuario.php") );
    require_once($this->path->getPage("model", "Vuelo.php"));
    require_once($this->path->getPage("model", "CentroMedico.php"));
    require_once($this->path->getPage("model", "ListaDeEspera.php"));
    require_once($this->path->getPage("model", "Reserva.php"));
    require_once($this->path->getPage("model", "Equipo.php"));
    //require_once( $this->path->getPage("model", "Pdf.php") );
    require_once($this->path->getPage("fpdf", "html_table.php"));

    $this->vuelo = new Vuelo();
    $this->view = new View();
    $this->centroMedico = new CentroMedico();
    $this->listaDeEspera = new ListaDeEspera();
    $this->reserva = new Reserva();
    $this->equipo = new Equipo();
    $this->pdf = new Pdf();
    
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
  
  function reportes () {
    $this->view->generate('Admin/reportes/view_admin_reportes.php', 'template_admin.php');
  }

  function obtenerFacturacionPorMes () {
    $fin =  date("Y-m-d");
    $inicio = date("Y-m-d",strtotime($fin. "- 30 days"));
    $result = $this->reserva->obtenerFacturacionPorMes($inicio, $fin);
    $data = json_decode($result, true);
    $this->pdf->AliasNbPages();
    $this->pdf->AddPage();
    $this->pdf->SetFont('Times','',12);
    foreach ($data as $fila) {
      $tabla="
        <h2>Desde: $inicio </h2><h2>Hasta : $fin </h2><br><br>
        <table border='1'table bordercolor='666633' >
          <tr>
            <td colspan='2' width='200' height='30'>Total Vendido por Mes</td><td width='200' height='30'>{$fila['total']}</td>
          </tr>
        </table>";
    }
    $this->pdf->WriteHTML($tabla);
    $this->pdf->Output();
  }

  function cabinaMasVendida () {
    $data = $this->reserva->obtenerCabinaMasVendida();
    $data = json_decode($data, true);
    $tabla = "";
    $this->pdf->AliasNbPages();
    $this->pdf->AddPage();
    $this->pdf->SetFont('Times','',12);
    $max=0;
    foreach ($data as $fila) {
      if ($fila['cantidad']>=$max) {
        $tabla .="<table border='1' bordercolor='666633' ><tr><td colspan='2' width='200' height='30'>{$fila['tipo_de_cabina']}</td><td width='200' height='30'>{$fila['cantidad']}</td></tr></table>";
      }
    }
    $tablaConTitulo="<table border='1' bordercolor='666633' ><td colspan='2' width='200' height='30'>TIPO DE CABINA</td><td width='200' height='30'>CANTIDAD</td><br></table>".$tabla;
    $this->pdf->WriteHTML($tablaConTitulo);
    $this->pdf->Output();
  }

  function facturacionPorUsuario () {
    $data = $this->reserva->obtenerFacturacionPorUsuario();
    $data = json_decode($data, true);
    $tabla = "";
    $this->pdf->AliasNbPages();
    $this->pdf->AddPage();
    $this->pdf->SetFont('Times','',12);
    foreach ($data as $fila) {
      $tabla .="<table border='1' bordercolor='666633' ><tr><td colspan='2' width='200' height='30'>{$fila['usuario_id']}</td><td width='200' height='30'>{$fila['cantidad']}</td><td width='200' height='30'>$ {$fila['total']}</td></tr></table>";
      }
    $tablaConTitulo="<table border='1' bordercolor='666633' ><td colspan='2' width='200' height='30'>ID DE USUARIO</td><td width='200' height='30'>CANT. FACTURAS</td><td width='200' height='30'>TOTAL</td><br></table>".$tabla;
    $this->pdf->WriteHTML($tablaConTitulo);
    $this->pdf->Output();

  }

  function tasaOcupacionPorViajeyEquipo(){
    $data = $this->equipo->obtenerVuelosPorEquipoyCapacidad();
    $data = json_decode($data, true);
    $tabla = "";
    $this->pdf->AliasNbPages();
    $this->pdf->AddPage();
    $this->pdf->SetFont('Times','',12);
    foreach ($data as $fila) {
      $valor=number_format(((int)$fila['cantidad']/(int)$fila['totalEquipo'])*100,2);
      $tabla.="<table border='1' bordercolor='666633' ><tr><td colspan='2' width='120' height='30'>{$fila['vuelo_id']}</td><td width='100' height='30'>{$fila['cantidad']}</td><td width='100' height='30'>{$fila['avion_id']}</td><td width='140' height='30'>{$fila['totalEquipo']}</td><td width='180' height='30'>$valor %</td></tr></table>";
    }
    $tablaConTitulo="<h1>TASA DE OCUPACION POR VIAJE Y EQUIPO</h1><br><br><table border='1' bordercolor='666633' ><td colspan='2' width='120' height='30'>ID DE VUELO</td><td width='100' height='30'>CANTIDAD</td><td width='100' height='30'>EQUIPO</td><td width='140' height='30'>TOTAL EQUIPO</td><td width='180' height='30'>TASA OCUPACION</td><br></table>".$tabla;
    $this->pdf->WriteHTML($tablaConTitulo);
    $this->pdf->Output();

    //$this->view->generate('Admin/reportes/view_admin_tasa_ocupacion_viaje_equipo.php', 'template_admin.php', $data);
  }
}
