<?php

class Controller_Vuelos extends Controller{

    private $path;
    private $view;
    private $vuelo;

    function __construct() {
        // Incluyo todos los modelos a utilizar
        $this->path = Path::getInstance("config/path.ini");
        require_once( $this->path->getPage("model", "Usuario.php") );
        require_once( $this->path->getPage("model", "Vuelo.php") );
        $this->vuelo = new Vuelo();
        $this->view = new View();
    }

    function index () {
        $this->view->generate('view_home.php', 'template_home.php');
    }

    function obtenerTodoslosVuelos () {
        $data = $this->vuelo->obtenerTodoslosVuelos();
        return $data;
    }

    // function buscar ($keyword) {
    //     // llega el GET del frontend
    //     // del front en el action se llama de esta forma: $path->getEvent('viajes', 'buscarPorPalabra');
    //     // otra opcion es hacer una peticion con AJAX cosa de mandar a la url algo mas copado tipo /?keyword=palabra-buscada
    //     // $this->vuelo->buscarViajesPorKeyword($keyword)
    // }

}