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

    public function eliminaCentroPorId($id){
        $sql= "DELETE FROM centroMedico
                WHERE id=$id;";
        $query = $this->database->exec($sql);
        $query = $this->database->get_affected_rows();
        $link =  "location:" . $this->path->getEvent('admin', 'centros');
        header ($link);
    }

    public function actualizaCentro($id,$nombre,$ubicacion){
        $sql= "UPDATE centroMedico
                SET nombre = '$nombre' ,ubicacion = '$ubicacion'
                WHERE id=$id;";
        $query = $this->database->exec($sql);
        $query = $this->database->get_affected_rows();
        $link =  "location:" . $this->path->getEvent('admin','centros');
        header ($link);
    }

    public function NuevoCentro($nombre,$ubicacion){
        $sql= " INSERT INTO centroMedico
                VALUES (NULL,'$nombre','$ubicacion')";
        $query = $this->database->exec($sql);
        $query = $this->database->get_affected_rows();
        $link =  "location:" . $this->path->getEvent('admin', 'centros');
        header ($link);
    }
    
    
    
}