<?php 

class authController
{
	
	private $userModel;


	public function __construct()
	{

		// Requerimos el modelo cuando se instancia el controlador
		require_once 'App/Models/User.php';
		$this->userModel = new User();
	}

 // Muestra la vista de Login
public function index()
{
	require_once 'Views/Auth/index.php';
}

public function login()
{
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$email = trim($_POST['email'] ?? '');
		$password = trim($_POST['password' ?? '']);

		$user =$this->userModel->getUserByEmail($email);

		if ($user && password_verify($password, $user['password'])) {
			session_start();
			$_SESSION['user_id'] = $user['id'];
			echo "string";
			//header('index.php');
		} else {
			$error = "Credenciales incorrectas";
			require_once 'Views/Auth/index.php';
		}

	}
}

public function register()
{
	require_once 'Views/Auth/signup.php';
}

}

 ?>