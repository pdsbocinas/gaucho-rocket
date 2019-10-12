<?php

class Controller_Login extends Controller
{

	private $path;
	private $view;
	private $usuario;

	public function __construct()
	{
		// Incluyo todos los modelos a utilizar
		$this->path = Path::getInstance("config/path.ini");
		require_once($this->path->getPage("model", "Usuario.php"));
		$this->usuario = new Usuario();
		$this->view = new View();
	}

	function index()
	{
		session_start();
		session_destroy();
		$this->view->generate('login_view.php', 'template_login.php');
	}

	function loginAction()
	{
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
			$this->path->getEvent('login', 'index');
		} else {
			$data = $result;
			session_start();
			session_destroy();
			$this->path->getEvent('login', 'index');
		}

		$this->view->generate('login_view.php', 'template_login.php', $data);
	}
}
