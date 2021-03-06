<?php
class Usuario
{

  private $database;
  private $id;
  private $nombre_de_usuario;
  private $email;
  private $password;
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

    $contraseniaIncorrecta = "select * from Usuario where email = '$email' and password <> '$password' and estado = 'activo'";
    $contraseniaCorrecta = "select * from Usuario where email = '$email' and password = '$password' and estado = 'activo'";

    $emailNoEncontrado = "select email from Usuario where email = '$email'";
    $isActive = "select * from Usuario where email = '$email' and estado <> 'activo' and password = '$password'";

    $queryContraseniaIncorrecta = $this->database->query($contraseniaIncorrecta);
    $queryContraseniaCorrecta = $this->database->query($contraseniaCorrecta);

    $queryEmailNoEncontrado = $this->database->query($emailNoEncontrado);
    $queryIsActive = $this->database->query($isActive);

    $resultadoContraseniaIncorrecta = $queryContraseniaIncorrecta->fetch_all(MYSQLI_ASSOC);
    $resultadoContraseniaCorrecta = $queryContraseniaCorrecta->fetch_all(MYSQLI_ASSOC);

    $resultadoEmailNoEncontrado = $queryEmailNoEncontrado->fetch_all(MYSQLI_ASSOC);
    $resultadoIsActive = $queryIsActive->fetch_all(MYSQLI_ASSOC);

    if (!empty($resultadoIsActive)) {
      $message = "El usuario no esta activado";
      echo $message;
    } else if (empty($resultadoEmailNoEncontrado)) {
      $message = "Usuario no encontrado";
      echo $message;
    } else if (empty($resultadoContraseniaCorrecta) and empty($resultadoIsActive) and !empty($resultadoEmailNoEncontrado)) {
      $message = "Contraseña incorrecta";
      echo $message;
    } else if (empty($resultadoContraseniaIncorrecta) and empty($resultadoIsActive) and !empty($resultadoContraseniaCorrecta)) {
      return json_encode($resultadoContraseniaCorrecta);
    }
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

  public function obtenerUsuario ($id) {
    $user_id = (int)$id;
    $sql = "select * from Usuario where id = $user_id";
    $query = $this->database->query_row($sql);
    return json_encode($query);
  }

}
