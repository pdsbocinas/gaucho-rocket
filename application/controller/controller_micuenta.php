<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once($this->path->getPage("phpmailer", "Exception.php"));
require_once($this->path->getPage("phpmailer", "PHPMailer.php"));
require_once($this->path->getPage("phpmailer", "SMTP.php"));
class Controller_MiCuenta extends Controller{
  
  private $path;
  private $view;
  private $turno;
  private $usuario;
  private $centros;
  private $reserva;
  private $vuelo;
  private $equipo;
  private $asiento;
  private $mail;
  
  function __construct() {
    $this->path = Path::getInstance("config/path.ini");
    require_once( $this->path->getPage("model", "Usuario.php") );
    require_once( $this->path->getPage("model", "CentroMedico.php") );
    require_once( $this->path->getPage("model", "Turno.php") );
    require_once( $this->path->getPage("model", "Reserva.php") );
    require_once( $this->path->getPage("model", "Vuelo.php") );
    require_once( $this->path->getPage("model", "Equipo.php") );
    require_once( $this->path->getPage("model", "Asiento.php") );

    $this->view = new View();
    $this->usuario = new Usuario();
    $this->turno = new Turno();
    $this->centros = new CentroMedico();
    $this->reserva = new Reserva();
    $this->vuelo = new Vuelo();
    $this->equipo = new Equipo();
    $this->asiento = new Asiento();
    $this->mail = new PHPMailer(true);
  
  }
  
  function index () {
    $this->view->generate('view_home.php', 'template_home.php');
  }

  function reservas () {
    $id = $_SESSION['id'];
    $data = $this->reserva->obtenerReservasPorUsuario($id);
    $checkin = $this->asiento->obtenerTodosLosAsientosPorUsuario($id);
    $data = json_decode($data, true);
    $checkin = json_decode($checkin, true);
    $values = array_values($checkin[0]);
    foreach ($data as $key => $value) {
      $exists = in_array($value['id'], $values);
      if ($exists) {
        $data[$key]['checkin'] = true;
      } else {
        $data[$key]['checkin'] = false;
      }
    }
    if (empty($data)) {
      $this->view->generate('micuenta/view_sin_reservas_hechas.php', 'template_home.php', $data);
    } else {
      $this->view->generate('micuenta/view_mis_reservas.php', 'template_home.php', $data);
    }
  }

  function examenes () {
    $id = $_SESSION['id'];
    $user = $this->usuario->obtenerNivelDelUsuario($id);
    $user = json_decode($user);
    if (is_null($_SESSION['nivel']) and is_null($user->nivel)) {
      $result = $this->centros->obtenerTodosLosCentrosMedicos();
      $data = json_decode($result, true);
      $this->view->generate('micuenta/view_sin_examen_medico.php', 'template_home.php', $data);
    } else {
      $data = $user;
      $this->view->generate('micuenta/view_con_examen_medico.php', 'template_home.php', $data);
    }
  }

  function crearTurno () {
    $id = $_SESSION['id'];
    $user = $this->usuario->obtenerNivelDelUsuario($id);
    $user = json_decode($user);
    if(is_null($_SESSION['nivel']) and is_null($user->nivel)) {
      $currentTime = date('Y-m-d H:i:s');
      $usuario_id = (int)$_SESSION['id'];
      $centro_id = (int)$_POST['centro_id'];
      $result = $this->turno->crearTurno($usuario_id, $centro_id ,$currentTime);
      $this->centros->otorgarPermisoMedico($usuario_id);
      $this->view->generate('micuenta/view_con_examen_medico.php', 'template_home.php');
    } else {
      $link =  "location:" . $this->path->getEvent('main', 'index');
      header($link);
    }
  }

  function cerrarSession(){
    session_start();
    session_destroy();
    $link = "location:" . $this->path->getEvent('main', 'index');
    header($link);
  }

  function checkin(){
    $this->view->generate('micuenta/view_checkin.php', 'template_home.php');
  }

  function traeReservasParaRealizarCheckin(){
    $id = (int)$_SESSION['id'];
    $codigo = $_GET['codigo'];
    $result = $this->reserva->ConsultaPorCodigoDeReservaPagaUsuario($codigo, $id);
    $data = json_decode($result, true);
    $this->view->generate('micuenta/checkin_paso1.php', 'template_home.php', $data);
  }

  function checkinPaso2 () {
    $this->view->generate('micuenta/checkin_paso2.php', 'template_home.php');
  }

  function obtenerCapacidadTotal () {
    $vuelo_id = (int)$_GET['vuelo_id'];
    $vuelo = $this->vuelo->obtenerVueloPorId($vuelo_id);
    $avion_id = json_decode($vuelo, true)[0]['avion_id'];
    $capacidad = $this->equipo->obtenerCapacidad($avion_id);
    echo $capacidad;
  }

  function obtenerAsientosOcupados () {
    $vuelo_id = $_GET['vuelo_id'];
    $data = $this->asiento->obtenerAsientosOcupados($vuelo_id);
    echo $data;
  }

  function guardarAsiento () {
    $asiento = $_POST['asiento'];
    $vuelo_id = $_POST['vuelo_id'];
    $reserva_id = $_POST['reserva_id'];
    $usuario_id = $_SESSION['id'];
    $data = $this->asiento->guardarAsiento($asiento, $vuelo_id, $usuario_id, $reserva_id);
    echo $data;
  }

   
function armaPase(){
  $reserva_id= 1;
  $result = $this->reserva->traeDatosGeneraPase($reserva_id);
  echo $result;
  $data = json_decode($result,true);
  $this->view->generate('micuenta/checkin_paso3.php', 'template_home.php', $data);
}


function EnviarCodigoaMail($vuelo_id, $reserva_id, $nombre_de_usuario, $email){
  $time = date(DATE_RFC2822);
try {
    //Server settings
  $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
  $this->mail->isSMTP();                                            // Send using SMTP
  $this->mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
  $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $this->mail->Username   = 'aa2736502@gmail.com';                     // SMTP username
  $this->mail->Password   = '324aguamistica';                               // SMTP password
  $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
  $this->mail->Port       = 587;                                    // TCP port to connect to

  //Recipients
  $this->mail->setFrom('aa2736502@gmail.com', 'GauchoRocket');
  $this->mail->addAddress('aa2736502@gmail.com', $nombre_de_usuario);     // Add a recipient
  //$this->mail->addAddress('ellen@example.com');               // Name is optional
  //$this->mail->addReplyTo('info@example.com', 'Information');
  //$this->mail->addCC('cc@example.com');
  //$this->mail->addBCC('bcc@example.com');

  // Attachments
  $this->mail->addAttachment('resources/qr/'.$nombre_de_usuario.$vuelo_id.$reserva_id.'.jpeg');         // Add attachments
  //$this->mail->addAttachment('resources/qr/'.$nombre_de_usuario.$vuelo_id.'.jpeg', 'new.jepg');    // Optional name

  // Content
  $this->mail->isHTML(true);                                  // Set email format to HTML
  $this->mail->Subject = 'Datos de la reserva';
  $this->mail->Body    = "Te adjuntamos a continuacion el QR";
  $this->mail->AltBody = 'este es un mensaje de la empresa de viajes';


  $this->mail->send();
  echo 'Message has been sent';
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
}
//$this->view->generate('micuenta/checkin_paso4_pdf.php', 'template_home.php');
}

function EnviarCodigo(){
  $vuelo_id = $_GET['vuelo_id'];
    $reserva_id = $_GET['reserva_id'];
    $nombre_de_usuario = $_GET['nombre_de_usuario'];
    $email = $_GET['email'];
    $this->EnviarCodigoaMail($vuelo_id, $reserva_id, $nombre_de_usuario, $email);
    //$this->view->generate('micuenta/checkin_paso4_pdf.php', 'template_home.php');

}
}

