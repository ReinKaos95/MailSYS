<?php 

class authController
{
	
	private $userModel;


	public function __construct()
	{

		// Requerimos el modelo cuando se instancia el controlador
		require_once ROOT_PATH . 'App/Models/User.php';
		$this->userModel = new User();
	}

 // Muestra la vista de Login
public function index()
{
	require_once ROOT_PATH . 'Views/Auth/index.php';
}

public function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');


        $user = $this->userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['correo'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_role'] = $user['rol_nombre']; // 'superadmin' o 'usuario'

            // Redirigir a la acción que muestra Views/index.php
            header('Location: index.php?action=dashboard');
            exit;
        } else {
            $error = "Credenciales incorrectas";
            require_once ROOT_PATH . 'Views/Auth/index.php';
        }
    }
}

public function register()
{
	require_once ROOT_PATH . 'Views/Auth/signup.php';
}

public function storeUser()
{
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
		$password = trim($_POST['password']);

		$errors = [];

		if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Por favor ingresa un correo electrónico válido.";
		}

		if (empty($password) || strlen($password) < 6) {
			$errors[] = "La contraseña debe tener al menos 6 caracteres.";
		}

		if (empty($errors)) {
			$existingUser = $this->userModel->getUserByEmail($email);
			if ($existingUser) {
				$errors[] = "El correo electrónico ya está registrado.";
			}
		}
		if (!empty($errors)) {
			require_once ROOT_PATH . 'Views/Auth/signup.php';
			return;
		}

		$created = $this->userModel->createUser($email, $password);

		if ($created) {
			$success = "¡Registro exitoso! Ya puedes iniciar sesión.";
			require_once ROOT_PATH . 'Views/Auth/index.php';
		} else {
			$errors[] = "Ocurrió un error al intentar registrar el usuario.";
			require_once ROOT_PATH . 'Views/Auth/signup.php';
			
		}
	}
}


public function logout()
{
	$_SESSION = array();

	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
		);
	}

	session_destroy();

	header('Location: index.php');
	exit;
}

}

 ?>