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
  private $circuitoDestino;
  private $trayectos;
  private $pdf;

  function __construct() {
    $this->path = Path::getInstance("config/path.ini");
    require_once( $this->path->getPage("model", "Usuario.php") );
    require_once( $this->path->getPage("model", "Vuelo.php") );
    require_once( $this->path->getPage("model", "Reserva.php") );
    require_once( $this->path->getPage("model", "ListaDeEspera.php") );
    require_once( $this->path->getPage("model", "Servicio.php") );
    require_once( $this->path->getPage("model", "CircuitoDestino.php") );
    require_once( $this->path->getPage("model", "ReservaTrayecto.php") );
    require_once( $this->path->getPage("model", "Pdf.php") );

    $this->vuelo = new Vuelo();
    $this->usuario = new Usuario();
    $this->reserva = new Reserva();
    $this->view = new View();
    $this->lista = new ListaDeEspera();
    $this->mail = new PHPMailer(true);
    $this->servicio = new Servicio();
    $this->circuitoDestino = new CircuitoDestino();
    $this->trayectos = new ReservaTrayecto();
    $this->pdf = new Pdf();
  }

  function index () {
    $id = $_GET['id'];
    $data = $this->vuelo->obtenerVueloPorId($id);
    $result = json_decode($data, true);
    $disponibilidad = $this->reserva->obtenerDisponibilidad($result);
    $data_mergeada = array_merge($disponibilidad, $result);
    $this->view->generate('view_detalle_reserva.php', 'template_home.php', $data_mergeada);
  }

  function confirmarReserva () {
    $precioFinal = $_POST['precioFinal'];
    $vueloId = (int)$_POST['vuelo_id'];
    $servicio = $_POST['servicio'];
    $user_id = $_SESSION['id'];
    $userEmail = $_SESSION['email'];
    $userNivel = $_SESSION['nivel'];
    $nivel = $this->usuario->obtenerNivelDelUsuario($_SESSION['id']);
    $servicioPorId = json_decode($this->servicio->obtenerServicioPorId($servicio), true);
    $cabina = $servicioPorId[0]['descripcion'];
    $data = $this->vuelo->obtenerVueloPorId($vueloId);
    $result = json_decode($data, true);
   
    $disponibilidad = $this->reserva->obtenerDisponibilidad($result);

    if (is_null($userNivel) and is_null($nivel)) {
      $this->view->generate('micuenta/view_sin_estudio_hecho.php', 'template_home.php');
    }

    if ($disponibilidad['disponibilidad']) {
      $circuito_id = (int)$result[0]['circuito_id'];
      $origen_id = (int)$result[0]['origen_id'];
      $destino_id = (int)$result[0]['destino_id'];

      $codigoReserva = $this->reserva->crearReserva($user_id, $userEmail, $vueloId, $servicio, $precioFinal, $cabina);
      $circuitosPorId = $this->circuitoDestino->obtenerDestinosPorCircuito($circuito_id);
      $jsonCircuitos = json_decode($circuitosPorId, true);

      foreach ($jsonCircuitos as $key => $value) {
        if ($value['destino_id'] === '17' and $origen_id === 17 ) {
          $index = array_search(18, array_column($jsonCircuitos, 'destino_id'));
          unset($jsonCircuitos[$index]);
        }
        if ($value['destino_id'] === '18' and $origen_id === 18 ) {
          $index = array_search(17, array_column($jsonCircuitos, 'destino_id'));
          unset($jsonCircuitos[$index]);
        }
      }

      $indexOrigen = array_search($origen_id, array_column($jsonCircuitos, 'destino_id'));
      $indexDestino = array_search($destino_id, array_column($jsonCircuitos, 'destino_id'));

      $dataReservaTrayectos = array_slice($jsonCircuitos, $indexOrigen, $indexDestino);
      $codigoReserva = json_decode($this->reserva->obtenerReservaPorCodigo($codigoReserva), true);
      $reserva_id = (int)$codigoReserva[0]['id'];
      
      foreach ($dataReservaTrayectos as $key => $value) {
        $destinoId = (int)$value['destino_id'];
        $this->trayectos->guardarTrayectos($vueloId, $reserva_id, $destinoId);
      }

      $link =  "location:" . $this->path->getEvent('micuenta', 'reservas');
      header($link);
    } else {
      echo "No hay lugar para este vuelo";
    }
  }

  function pagarReserva () {
    $reserva_id = $_POST['reserva_id'];
    $data = $this->reserva->pagarReserva($reserva_id);
    $link =  "location:" . $this->path->getEvent('reservas', 'exito');
    header($link);
  }

  function exito () {
    $user_id = 1;
    $reserva = json_decode($this->reserva->obtenerReservasPorUsuario($user_id), true);
    $this->enviarMailConDatosDelVuelo($reserva);
  }

  function enviarMailConDatosDelVuelo ($reserva) {
		$time = date(DATE_RFC2822);
    $nombre_de_usuario = $_SESSION['nombre_de_usuario'];
    $data = $reserva;
    $link =  "location:" . $this->path->getEvent('main', '');
    header($link);

		try {
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
      $this->mail->Body    = "
        <h1>Datos de la reserva</h1>
        <strong>Codigo: </strong><p>" . $data[0]['codigo'] . "</p>
        <strong>Vuelo: </strong><p>" . $data[0]['titulo'] . "</p>
        <strong>Tipo de cabina: </strong><p>" . $data[0]['tipo_de_cabina'] . "</p>
        <strong>Valor: </strong><p> $" . $data[0]['precio_final'] . "</p>";
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
    $usuarioEnEspera = $this->lista->obtenerUsuarioDeListaDeEspera($usuario_id, $vuelo_id);
    $isEmpty = empty(json_decode($usuarioEnEspera, true));
    if($isEmpty) {
      $this->lista->agregarAListaDeEspera($usuario_id, $vuelo_id);
    } else {
      echo $usuarioEnEspera;
    }
  }

  function obtenerTodosLosServicios () {
    $data = $this->servicio->obtenerTodosLosServicios();
    echo $data;
  }

  function eliminarReserva () {
    $reserva_id = $_POST['reserva_id'];
    $data = $this->reserva->eliminarReserva($reserva_id);
  }
  
  function generaFactura () {
    $reserva_codigo = $_GET['codigo'];
    $result = $this->reserva->obtenerReservaPorCodigo($reserva_codigo);
    $data = json_decode($result, true);
    $this->pdf->AliasNbPages();
    $this->pdf->AddPage();
    $this->pdf->SetFont('Times','',12);
    
    foreach ($data as $fila) {
      $this->pdf->Cell(0,10,'Reserva ID: '.$data[0]['id'],0,1);
      $this->pdf->Cell(0,10,'Codigo: '.$data[0]['codigo'],0,1);
      $this->pdf->Cell(0,10,'Cabina: '.$data[0]['tipo_de_cabina'],0,1);
      $this->pdf->Cell(0,10,'Precio Final: '.$data[0]['precio_final'],0,1);
    }

    $this->pdf->Output();
  }
}

?>