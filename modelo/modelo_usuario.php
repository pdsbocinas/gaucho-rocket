<?php
class Usuario {
    private $db;
    private $personas;
    private $conectar;
 
    public function __construct(){
      require_once './helpers/conexion.php';
      $this->conectar = new Conectar();
      $this->db=$this->conectar->conexion();
    }

    public function getAll(){
      $query = $this->db->query("SELECT * FROM Usuario");
      //Devolvemos el resultset en forma de array de objetos
      while ($row = $query->fetch_object()) {
         $resultSet[] = $row;
      }

      return $resultSet;
    }

    public function ingresarAction() {
      echo 'logueado';
    }

}
?>
