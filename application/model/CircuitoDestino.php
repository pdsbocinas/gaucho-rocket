<?php

class CircuitoDestino
{
    private $database;
    private $path;
    private $destino;
    private $circuito;

    public function __construct() {
        $this->path = Path::getInstance("config/path.ini");
        require_once( $this->path->getPage("model", "Destino.php") );
        require_once( $this->path->getPage("model", "Circuito.php") );
        $this->destino = new Destino();
        $this->circuito = new Circuito();
        $this->database = new Database();
    }
}

?>