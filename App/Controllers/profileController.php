<?php 

/**
 * 
 */
class profileController
{
	
	private $userModel;


	public function __construct()
    {
        require_once ROOT_PATH . 'App/Models/User.php';
        $this->userModel = new User();
    }

	public function index()
	{
	    $user = $this->userModel->getUserByEmail($_SESSION['user_email'] ?? '');
	    require_once ROOT_PATH . 'Views/Profile/index.php';
	}

	public function config()
	{
	    $user = $this->userModel->getUserByEmail($_SESSION['user_email'] ?? '');
	    require_once ROOT_PATH . 'Views/Profile/config.php';
	}

	public function update()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$userId = $_SESSION['user_id'] ?? null;
			$nombre	= trim($_POST['nombre'] ?? '');
			$password = trim($_POST['password'] ?? '');

			if ($userId) {
				$actualizado = $this->userModel->updateUser($userId, $nombre, $password);
				if ($actualizado) {
					if (!empty($nombre)) {
						$_SESSION['user_name'] = $nombre;
					}
					$success = "Configuración actualizada con éxito.";
				} else {
					$error = "No se realizaron cambios o sucedió un error.";
				}
			}
			require_once ROOT_PATH . 'Views/Profile/config.php';
		}
	}

}

 ?>