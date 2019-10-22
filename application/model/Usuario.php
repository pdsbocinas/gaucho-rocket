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

  public function createNewUser($nombre_de_usuario, $email, $password) {
    // le agrego el rol porque en la base esta con la condicion de que no puede ser null
    $sql = "insert into Usuario (nombre_de_usuario, email, password, rol) values ('$nombre_de_usuario', '$email', '$password', 'x')";
    $insertUser = $this->database->exec($sql);
    $insertUser = $this->database->get_affected_rows();
    $this->getUserByMail($email, $password);
    // esto redirecciona
    $link =  "location:" . $this->path->getEvent('main', '');
    header($link);
  }
}
