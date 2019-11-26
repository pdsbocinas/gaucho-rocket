<?php

class Circuito
{
    private $database;
    private $path;
    private $usuario;

    public function __construct() {
        $this->path = Path::getInstance("config/path.ini");
        require_once( $this->path->getPage("model", "Usuario.php") );
        $this->usuario = new Usuario();
        $this->database = new Database();
    }
}

?>