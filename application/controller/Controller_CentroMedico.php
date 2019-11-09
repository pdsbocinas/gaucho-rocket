<?php

// $centros=new CentroMedico();
// $datos=$centros->obtenerTodosLosCentrosMedicos();



class Controller_CentroMedicos extends Controller
{
    private $path;
    private $view;
    private $centroMedico;

    function __construct() {
        $this->path = Path::getInstance("config/path.ini");
        require_once( $this->path->getPage("model", "Usuario.php") );
        require_once( $this->path->getPage("model", "CentroMedico.php") );
        $this->centroMedico = new CentroMedico();
        $this->view = new View();
    }

    function index () {
        $this->view->generate('view_home.php', 'template_home.php');
    }

    function obtenerTodosLosCentrosMedicos () {
        $data = $this->centroMedico->obtenerTodosLosCentrosMedicos();
        return $data;
    }

}