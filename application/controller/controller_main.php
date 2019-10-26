<?php

class Controller_Main extends Controller
{

	private $path;
	private $view;
	private $usuario;
	private $vuelo;

	public function __construct() {
		// Incluyo todos los modelos a utilizar
		$this->path = Path::getInstance("config/path.ini");
		require_once($this->path->getPage("model", "Usuario.php"));
		require_once($this->path->getPage("model", "Vuelo.php"));
		$this->usuario = new Usuario();
		$this->vuelo = new Vuelo();
		$this->view = new View();
	}

	function index() {
    $result = $this->vuelo->obtenerTodoslosVuelos();
    $data = json_decode($result, true);
		$this->view->generate('view_home.php', 'template_home.php', $data);
	}

	function home () {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$result = $this->usuario->getUserByMail($email, $password);
		$array = json_decode($result, true);

		foreach ($array as $fila) {
			$this->usuario->setEmail($fila['email']);
			$this->usuario->setNombre($fila['nombre_de_usuario']);
			$this->usuario->setRol($fila['rol']);
			$_SESSION['nombre_de_usuario'] = $this->usuario->getNombre();
			$_SESSION['email'] = $this->usuario->getEmail();
			$_SESSION['userId'] = $this->usuario->getId();
			$_SESSION['rol'] = $this->usuario->getRol();
		}

		if (is_array($array)) {
			$data = $this->usuario;
		} else {
			$data = $result;
			session_start();
			session_destroy();
			$this->index();
		}
		$link =  "location:" . $this->path->getEvent('main', 'index');
    header($link);
		$this->view->generate('view_home.php', 'template_home.php', $data);
  }
    
	function register () {
			$email = $_POST['email'];
			$password = $_POST['password'];
			$nombre_de_usuario = $_POST['nombre_de_usuario'];

			$result = $this->usuario->createNewUser($nombre_de_usuario, $email, $password);
	}
}
