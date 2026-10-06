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
	        
	        header('Location: index.php?action=config&tab=usuarios&status=created');
	        exit;
	    }
	}


public function update() 
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId   = $_SESSION['user_id'] ?? null;
        $nombre   = trim($_POST['nombre'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $seccion  = trim($_POST['seccion_trabajo'] ?? '');
        $fechaNac = $_POST['fecha_nacimiento'] ?? null;
        $cedula   = trim($_POST['cedula'] ?? '');

        if (!$userId) {
            header('Location: index.php?action=login');
            exit;
        }

        // 1. Validaciones de Cédula (Ejemplo formato V-12345678 o solo números)
        if (!empty($cedula)) {
            // Formato permitido: Letra opcional (V/E/J) seguida de guion y 6 a 9 dígitos
            if (!preg_match('/^(?:[VEJvej]-)?\d{6,9}$/', $cedula)) {
                header('Location: index.php?action=config&error=cedula_invalida');
                exit;
            }

            // Verificar si la cédula ya está registrada por otro usuario
            if ($this->userModel->isCedulaTaken($cedula, $userId)) {
                header('Location: index.php?action=config&error=cedula_duplicada');
                exit;
            }
        }

        // 2. Validación de Fecha de Nacimiento (Edad mínima: 18 años)
        if (!empty($fechaNac)) {
            $dob = new DateTime($fechaNac);
            $hoy = new DateTime();
            $edad = $hoy->diff($dob)->y;

            if ($edad < 18) {
                header('Location: index.php?action=config&error=menor_edad');
                exit;
            }
        }

        // 3. Procesamiento de la Foto de Perfil
        $fotoRuta = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['foto']['tmp_name'];
            $fileName    = $_FILES['foto']['name'];
            $fileSize    = $_FILES['foto']['size'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $maxFileSize       = 2 * 1024 * 1024; // 2 MB

            if (!in_array($fileExtension, $allowedExtensions)) {
                header('Location: index.php?action=config&error=foto_formato');
                exit;
            }

            if ($fileSize > $maxFileSize) {
                header('Location: index.php?action=config&error=foto_tamano');
                exit;
            }

            // Guardar con nombre único
            $newFileName = 'avatar_' . $userId . '_' . time() . '.' . $fileExtension;
            $uploadFileDir = ROOT_PATH . 'public/uploads/avatars/';

            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }

            $destPath = $uploadFileDir . $newFileName;
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $fotoRuta = 'public/uploads/avatars/' . $newFileName;
            }
        }

        // Guardar cambios en DB
        $datosActualizar = [
            'nombre'           => $nombre,
            'password'         => $password,
            'seccion_trabajo'  => $seccion,
            'fecha_nacimiento' => $fechaNac,
            'cedula'           => $cedula
        ];

        if ($fotoRuta) {
            $datosActualizar['foto'] = $fotoRuta;
            $_SESSION['user_photo'] = $fotoRuta;
        }

        $actualizado = $this->userModel->updateUser($userId, $datosActualizar);

        if ($actualizado) {
            if (!empty($nombre)) {
                $_SESSION['user_name'] = $nombre;
            }
            header('Location: index.php?action=config&status=success');
            exit;
        } else {
            header('Location: index.php?action=config&error=sin_cambios');
            exit;
        }
    }
}

}

 ?>