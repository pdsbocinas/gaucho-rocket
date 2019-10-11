<?php

class Controller_Viajes extends Controller{

    private $path;
    private $view;
    private $usuario;

    function __construct() {
        // Incluyo todos los modelos a utilizar
        $this->path = Path::getInstance("config/path.ini");
        require_once( $this->path->getPage("model", "Usuario.php") );
        $this->usuario = new Usuario();

        $this->view = new View();
    }

    function index(){
        $this->view->generate('login_view.php', 'template_login.php');
    }

    function crear () {
        $result = $this->usuario->getAllUsers();
        return $result;
    }
}