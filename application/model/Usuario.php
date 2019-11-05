<?php

class Usuario
{

  private $database;
  private $id;
  private $nombre_de_usuario;
  private $email;
  private $password;
  // el nivel se setea una vez que el tipo le da reservar turno. Se le asigna un numero random (1,2,3)
  private $nivel;
  private $estado;


  public function __construct() {
    $this->path = Path::getInstance("config/path.ini");
    $this->database = new Database();
  }

  public function getNombre() {
    return $this->nombre_de_usuario;
  }

  public function setNombre($nombre_de_usuario) {
    $this->nombre_de_usuario = $nombre_de_usuario;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id){
    $this->id = $id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email){
    $this->email = $email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password){
    $this->password = $password;
  }

  public function getRol() {
    return $this->rol;
  }

  public function setRol($rol){
    $this->rol = $rol;
  }

  public function getNivel() {
    return $this->nivel;
  }

  public function setNivel($nivel) {
    $this->nivel = $nivel;
  }

  public function getAllUsers() {
    $sql = "select * from Usuario";
    $query = $this->database->query($sql);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    echo json_encode($result);
  }

  public function getUserByMail($email, $password) {

    $message = "";

    $withEmail = "select * from Usuario where email = '$email'";
    $withPassword = "select * from Usuario where password = '$password'";
    $queryEmail = $this->database->query($withEmail);
    $queryPassword = $this->database->query($withPassword);

    $resultoEmail = $queryEmail->fetch_all(MYSQLI_ASSOC);
    $resultadoPassword = $queryPassword->fetch_all(MYSQLI_ASSOC);

    if (!empty($resultoEmail) and !empty($resultadoPassword)) {
      return json_encode($resultoEmail);
    }

    if (!empty($resultoEmail) and empty($resultadoPassword)) {
      $message = "Contraseña incorrecta";
      return $message;
    }

    $message = "Usuario no encontrado";
    return $message;
  }

  public function createNewUser($nombre_de_usuario, $email, $password, $estado) {
    // le agrego el rol porque en la base esta con la condicion de que no puede ser null
    $sql = "insert into Usuario (nombre_de_usuario, email, password, rol, estado) values ('$nombre_de_usuario', '$email', '$password', 'x', '$estado')";
    $insertUser = $this->database->exec($sql);
    $insertUser = $this->database->get_affected_rows();
    $this->getUserByMail($email, $password);
    // esto redirecciona
    $link =  "location:" . $this->path->getEvent('main', '');
    header($link);
  }

  public function getUserByHash($hash) {
    $sql = "select * from Usuario where estado = '$hash'";
    $query = $this->database->query_row($sql);
    return json_encode($query);
  }

  public function updateUserState ($id) {
    $sql = "update Usuario set estado = 'activo' where id = " . $id;
    $updateUser = $this->database->exec($sql);
    $updateUser = $this->database->get_affected_rows();
    return $updateUser;
  }
}
