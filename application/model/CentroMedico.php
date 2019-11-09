<?php


class CentroMedico
{
    private $database;
    private $path;

    public function __construct() {
        $this->path = Path::getInstance("config/path.ini");
        $this->database = new Database();
        }

    public function obtenerTodosLosCentrosMedicos(){
        $sql = "select * from centroMedico";
        $query = $this->database->query($sql);
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return json_encode($result);

    }

    public function obtenerCentroPorId($id){
        $sql = "select * from centroMedico where id=$id";
        $query = $this->database->query($sql);
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return json_encode($result);
    }
    public function editarCentroMedico($user_id){
        $sql = "update Usuario set nivel = 'rand(1, 3)' where id = '$user_id'";
    }

    public function otorgarPermisoMedico() {
        
    }

}