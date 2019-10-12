<?php

/*
 Forma de Uso
echo $path->getPage("controller", "controller_main.php") . "<br>";
echo $path->getLink( "resources", "img.txt" ) . "<br>";
 */


class Path
{
    private static $instance;
    private $paths;

    //Evita que el objeto se pueda crear desde afuera
    private function __construct($pathsFile){

        if (file_exists( $pathsFile )) {
            $this->paths = parse_ini_file($pathsFile);
        } else {
            die("Ruta de configuración inexistente");
        }

    }

    // Evita que el objeto se pueda clonar
    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }

    public static function getInstance($pathFile = '')
    {
        if( !isset( Path::$instance ) || is_null(Path::$instance)){
            self::$instance = new Path($pathFile);
        }
        return self::$instance;
    }

    public function getPage($path, $file = ''){

        if (array_key_exists($path, $this->paths )) {
            $fullPath =  $this->paths['root'] .  $this->paths[$path] . $file;
            if (file_exists( $fullPath )) {
                return $fullPath;
            }else {
                return null;
            }
            
        }else {
            return null;
        }
    }

    public function getLink($path, $file = ''){

        $root =  $this->paths["root"]  != "" ?  $this->paths["root"] : "/";

        if (array_key_exists( $path, $this->paths )) {
            $fullLink = "http://" . $_SERVER['HTTP_HOST'] . $root . $this->paths[$path] . $file;
            return $fullLink;

        } else {

            return null;
        }

    }
    // armar urls para utilizar
    public function getEvent($controller, $action) {
        // $root =  $this->paths["root"]  != "" ?  $this->paths["root"] : "/";
        $event = "http://" . $_SERVER['HTTP_HOST'] . "/" . 'gaucho-rocket' . "/". $controller . "/" . $action;
        return $event;
    }
}