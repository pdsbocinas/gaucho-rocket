<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once($this->path->getPage("phpmailer", "Exception.php"));
require_once($this->path->getPage("phpmailer", "PHPMailer.php"));
require_once($this->path->getPage("phpmailer", "SMTP.php"));

class Controller_Main extends Controller
{

	private $path;
	private $view;
	private $usuario;
	private $vuelo;
	private $mail;

	public function __construct() {
		// Incluyo todos los modelos a utilizar
		$this->path = Path::getInstance("config/path.ini");
		require_once($this->path->getPage("model", "Usuario.php"));
		require_once($this->path->getPage("model", "Vuelo.php"));

		$this->usuario = new Usuario();
		$this->vuelo = new Vuelo();
		$this->view = new View();
		$this->mail = new PHPMailer(true);
	}

	function index() {
    $result = $this->vuelo->obtenerTodoslosVuelos();
		$data = json_decode($result, true);
		$this->view->generate('view_home.php', 'template_home.php', $data);
	}

	function login () {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$result = $this->usuario->getUserByMail($email, $password);
		$array = json_decode($result, true);
		session_start();
		foreach ($array as $fila) {
			$_SESSION['userId'] = $fila['id'];
			$_SESSION['nombre_de_usuario'] = $fila['nombre_de_usuario'];
			$_SESSION['email'] = $fila['email'];
			$_SESSION['userId'] = $fila['id'];
			$_SESSION['rol'] = $fila['rol'];
			$_SESSION['nivel'] = $fila['nivel'];
		}
		
		if (is_array($array)) {
			$data = $this->usuario;
		} else {
			$data = $result;
			session_start();
			return $data;
		}
		
		$link =  "location:" . $this->path->getEvent('main', 'index');
		header($link);
		exit();
  }
    
	function confirm () {
			// aca valido los hash que me vienen del mail con los que guarde en la base
			// y si esta OK cambio el estado de pendiente a comfirmado
			$hash = $_GET['hash'];
			$result = $this->usuario->getUserByHash($hash);
			$data = json_decode($result, true);
			$query = $this->usuario->updateUserState($data['id']);
			
			$link =  "location:" . $this->path->getEvent('main', 'index');
			header($link);
	}

	function register ($nombre_de_usuario = "", $email= "", $password= "") {
		// en este paso registro al usuario con estado pendiente y le agrego en el get
		// le guardo el password, todo los datos
		// el email y un hash del current date
		// ej /confirm?email=pds.gomez@gmail.com&password=353453jnhkhc34u5
		$time = date(DATE_RFC2822);
		$email = $_POST['email'];
		$nombre_de_usuario = $_POST['nombre_de_usuario'];
		$estado = md5($time);
		$password = $_POST['password'];
		$this->usuario->createNewUser($nombre_de_usuario, $email, $password, $estado);

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
			$this->mail->setFrom('twtesttest5@gmail.com', 'Confirma tu cuenta');
			$this->mail->addAddress($email, $nombre_de_usuario);     // Add a recipient
			//$this->mail->addAddress('ellen@example.com');               // Name is optional
			//$this->mail->addReplyTo('info@example.com', 'Information');
			//$this->mail->addCC('cc@example.com');
			//$this->mail->addBCC('bcc@example.com');
	
			// Attachments
			//$this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	
			// Content
			$this->mail->isHTML(true);                                  // Set email format to HTML
			$this->mail->Subject = 'Confirma tu cuenta';
			$event = $this->path->getEvent('main', 'confirm' ) . "?email=" . $email . "&hash=" . $estado;
			$this->mail->Body    = "<a href=" . $event . "> Confirma tu cuenta</a>";
			$this->mail->AltBody = 'This is the body in plain text for non-HTML this->mail clients';


			$this->mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		}
	}
}
