<?php
// Cargar configuraciones iniciales
require_once 'App/Config/define.php'; 
require_once 'App/Config/db.php'; 
require_once 'App/Controllers/authController.php'; 

$auth = new authController();

// Enrutador básico para pruebas rápidas
$action = $_GET['action'] ?? 'index';

switch ($action) {
	case 'register':
		$auth->register();
		break;
		case 'login':
			$auth->login();
			break;
	default:
		$auth->index();
		break;
}
?>