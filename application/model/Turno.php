<?php


class Turno
{
    private $database;
    private $path;
    private $usuario_id;
    private $centro_id;
    private $date;

    public function __construct() {
      $this->path = Path::getInstance("config/path.ini");
      $this->database = new Database();
    }

    function crearTurno ($usuario_id, $centro_id, $horario) {
      $sql = "insert into Turno (usuario_id, centro_id, horario) 
      values ('$usuario_id', '$centro_id', '$horario')";
      $insertTurno = $this->database->exec($sql);
      $insertTurno = $this->database->get_affected_rows();
      return $insertTurno;
    }

}