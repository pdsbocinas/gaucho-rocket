<?php

class Controller_Main extends Controller
{

	private $path;
	private $view;
	private $usuario;

	public function __construct() {
		// Incluyo todos los modelos a utilizar
		$this->path = Path::getInstance("config/path.ini");
		require_once($this->path->getPage("model", "Usuario.php"));
		$this->usuario = new Usuario();
		$this->view = new View();
	}

	function index() {
		$this->view->generate('view_home.php', 'template_home.php');
	}

	function home () {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$result = $this->usuario->getUserByMail($email, $password);
		$array = json_decode($result, true);

		foreach ($array as $fila) {
			$this->usuario->setEmail($fila['email']);
			$this->usuario->setNombre($fila['nombre_de_usuario']);
			$_SESSION['nombre_de_usuario'] = $this->usuario->getNombre();
			$_SESSION['email'] = $this->usuario->getEmail();
		}

		if (is_array($array)) {
			$data = $this->usuario;
		} else {
			$data = $result;
			session_start();
            session_destroy();
            $this->index();
		}
		
		$this->view->generate('view_home.php', 'template_home.php', $data);
	}
}
