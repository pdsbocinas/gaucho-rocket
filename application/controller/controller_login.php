<?php

class Controller_Login extends Controller{

    private $path;
    private $view;

    function __construct()
    {
        // Incluyo todos los modelos a utilizar

        $this->path = Path::getInstance("config/path.ini");
        require_once( $this->path->getPage("model", "Usuario.php") );

        $this->view = new View();
    }

    function index(){
        $this->view->generate('login_view.php', 'template_login.php');
    }

}