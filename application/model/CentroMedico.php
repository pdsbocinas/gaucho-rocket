<?php
class CentroMedico
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

    public function editarCentroMedico(){
    }

    public function otorgarPermisoMedico($user_id) {
        $nivel = rand(1, 3);
        $sql = "update Usuario set nivel = '$nivel' where id = '$user_id'";
        $updateUserLevel = $this->database->exec($sql);
        $updateUserLevel = $this->database->get_affected_rows();
        $link =  "location:" . $this->path->getEvent('main', 'index');
        header($link);
    }

    public function eliminaCentroPorId($id){
        $sql = "DELETE FROM centroMedico
                WHERE id=$id;";
        $query = $this->database->exec($sql);
        $query = $this->database->get_affected_rows();
        $link =  "location:" . $this->path->getEvent('admin', 'centros');
        header ($link);
    }

    public function actualizaCentro($id,$nombre,$ubicacion){
        $sql = "UPDATE centroMedico
                SET nombre = '$nombre' ,ubicacion = '$ubicacion'
                WHERE id=$id;";
        $query = $this->database->exec($sql);
        echo $this->database->get_affected_rows();
        $query = $this->database->get_affected_rows();
        if ($this->database->get_affected_rows()>0) {
            $link =  "location:" . $this->path->getEvent('admin','centros');
            header ($link);
        } else {
            echo 'no se pudo actualizar';
        }
    }

    public function NuevoCentro($nombre,$ubicacion){
        $sql = "INSERT INTO centroMedico
                VALUES (NULL,'$nombre','$ubicacion')";
        $query = $this->database->exec($sql);
        
        $query = $this->database->get_affected_rows();
        $link =  "location:" . $this->path->getEvent('admin', 'centros');
        header ($link);
    }
    
}