<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once($this->path->getPage("phpmailer", "Exception.php"));
require_once($this->path->getPage("phpmailer", "PHPMailer.php"));
require_once($this->path->getPage("phpmailer", "SMTP.php"));
class Controller_Reservas extends Controller{
  
  private $path;
  private $view;
  private $vuelo;
  private $usuario;
  private $reserva;
  private $mail;

  function __construct() {
    // Incluyo todos los modelos a utilizar
    $this->path = Path::getInstance("config/path.ini");
    require_once( $this->path->getPage("model", "Usuario.php") );
    require_once( $this->path->getPage("model", "Vuelo.php") );
    require_once( $this->path->getPage("model", "Reserva.php") );
    require_once( $this->path->getPage("model", "ListaDeEspera.php") );
    $this->vuelo = new Vuelo();
    $this->usuario = new Usuario();
    $this->reserva = new Reserva();
    $this->view = new View();
    $this->lista = new ListaDeEspera();
    $this->mail = new PHPMailer(true);
  }

  function index () {
    $id = $_GET['id'];
    $data = $this->vuelo->obtenerVueloPorId($id);
    $result = json_decode($data, true);
    $disponibilidad = $this->reserva->obtenerDisponibilidad($result);
    $data_mergeada = array_merge($disponibilidad, $result);
    $this->view->generate('view_detalle_reserva.php', 'template_home.php', $data_mergeada);
  }

  function confirm () {
    $vueloId = $_POST['id'];
    $cabina = $_POST['servicio'];
    $user_id = $_SESSION['id'];
    $userEmail = $_SESSION['email'];
    $userNivel = $_SESSION['nivel'];
    $nivel = $this->usuario->obtenerNivelDelUsuario($_SESSION['id']);
    if (is_null($userNivel) and is_null($nivel)) {
      $this->view->generate('micuenta/view_sin_estudio_hecho.php', 'template_home.php');
    } else {
      $data = $this->reserva->crearReserva($user_id, $userEmail, $vueloId, $cabina);
      $link =  "location:" . $this->path->getEvent('micuenta', 'reservas');
      header($link);
    }
  }

  function pagarReserva () {
    $reserva_id = $_POST['reserva_id'];
    $data = $this->reserva->pagarReserva($reserva_id);
    $link =  "location:" . $this->path->getEvent('reservas', 'exito');
    header($link);
  }

  function exito () {
    $user_id = $_SESSION['id'];
    $reserva = $this->reserva->obtenerReservasPorUsuario($user_id);
    $this->enviarMailConDatosDelVuelo($reserva);
  }

  function enviarMailConDatosDelVuelo ($reserva) {
		$time = date(DATE_RFC2822);
    $nombre_de_usuario = $_SESSION['nombre_de_usuario'];
    $data = $reserva;
    $link =  "location:" . $this->path->getEvent('main', '');
    header($link);

		try {
				//Server settings
			$this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
			$this->mail->isSMTP();                                            // Send using SMTP
			$this->mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
			$this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$this->mail->Username   = 'twtesttest5@gmail.com';                     // SMTP username
			$this->mail->Password   = 'gmxiqbibvamibalz';                               // SMTP password
			$this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			$this->mail->Port       = 587;                                    // TCP port to connect to
	
			//Recipients
			$this->mail->setFrom('twtesttest5@gmail.com', 'Datos de la reserva');
			$this->mail->addAddress('pds.gomez@gmail.com', $nombre_de_usuario);     // Add a recipient
			//$this->mail->addAddress('ellen@example.com');               // Name is optional
			//$this->mail->addReplyTo('info@example.com', 'Information');
			//$this->mail->addCC('cc@example.com');
			//$this->mail->addBCC('bcc@example.com');
	
			// Attachments
			//$this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	
			// Content
			$this->mail->isHTML(true);                                  // Set email format to HTML
			$this->mail->Subject = 'Datos de la reserva';
			$this->mail->Body    = $data;
			$this->mail->AltBody = 'This is the body in plain text for non-HTML this->mail clients';


			$this->mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
  }
  
  function agregarAListaDeEspera () {
    $usuario_id = (int)$_POST['usuario'];
    $vuelo_id = (int)$_POST['vuelo'];
    $usuarioEnEspera = $this->lista->obtenerDeListaDeEspera($usuario_id, $vuelo_id);
    $isEmpty = empty(json_decode($usuarioEnEspera, true));
    if($isEmpty) {
      $this->lista->agregarAListaDeEspera($usuario_id, $vuelo_id);
    } else {
      echo $usuarioEnEspera;
    }
  }
}

?>