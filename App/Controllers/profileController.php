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
	// Cargar notas del usuario
    require_once ROOT_PATH . 'App/Models/Agenda.php';
    $agendaModel = new Agenda();
    $notas = $agendaModel->getNotesByUser($_SESSION['user_id'] ?? 0);
	    require_once ROOT_PATH . 'Views/Profile/index.php';
	}

	public function config()
    {
        $user = $this->userModel->getUserByEmail($_SESSION['user_email'] ?? '');
        $listaUsuarios = [];
        $devlogs = [];

        // Si es superadmin, cargamos la lista de usuarios para la pestaña de gestión
        if (($_SESSION['user_role'] ?? '') === 'superadmin') {
            $listaUsuarios = $this->userModel->getAllUsers() ?: [];

		require_once ROOT_PATH . 'App/Models/DevLog.php';
        $devLogModel = new DevLog();
        $devlogs = $devLogModel->getAllLogs() ?: [];
        }

        require_once ROOT_PATH . 'Views/Profile/config.php';
    }

public function storeDevLog()
{
    if (($_SESSION['user_role'] ?? '') !== 'superadmin') {
        header('Location: index.php?action=dashboard');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $version = trim($_POST['version'] ?? '');
        $titulo  = trim($_POST['titulo'] ?? '');
        $desc    = trim($_POST['descripcion'] ?? '');
        $tipo    = $_POST['tipo'] ?? 'update';

        if (!empty($version) && !empty($titulo) && !empty($desc)) {
            require_once ROOT_PATH . 'App/Models/DevLog.php';
            $devLogModel = new DevLog();
            $devLogModel->createLog($version, $titulo, $desc, $tipo);
        }

        header('Location: index.php?action=config&tab=devlog&status=devlog_created');
        exit;
    }
}

// En App/Controllers/profileController.php

	public function adminUsers()
	{
	    // 1. Verificar nuevamente que la sesión sea de un superadmin por seguridad
	    if (($_SESSION['user_role'] ?? '') !== 'superadmin') {
	        header('Location: index.php?action=dashboard');
	        exit;
	    }

	    // 2. Obtener la lista de usuarios desde el modelo User
	    $listaUsuarios = $this->userModel->getAllUsers();

	    // 3. Cargar la vista (que ahora sí recibirá la variable $listaUsuarios)
	    require_once ROOT_PATH . 'Views/Profile/admin_users.php';
	}

	public function storeUserByAdmin()
	{
	    if (($_SESSION['user_role'] ?? '') !== 'superadmin') {
	        header('Location: index.php?action=dashboard');
	        exit;
	    }

	    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	        $nombre   = trim($_POST['nombre'] ?? '');
	        $correo   = trim($_POST['correo'] ?? '');
	        $password = trim($_POST['password'] ?? '');
	        $rolId    = intval($_POST['rol_id'] ?? 2);

	        if (!empty($correo) && !empty($password)) {
	            $this->userModel->createUserByAdmin($nombre, $correo, $password, $rolId);
	        }
	        
	        header('Location: index.php?action=adminUsers');
	        exit;
	    }
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