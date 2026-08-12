<?php 
session_start();

define('ROOT_PATH', __DIR__ . '/');

require_once ROOT_PATH . 'App/Config/define.php';
require_once ROOT_PATH . 'App/Config/db.php';
require_once ROOT_PATH . 'App/Controllers/authController.php';
require_once ROOT_PATH . 'App/Controllers/mainController.php'; // Incluimos el controlador principal

$auth = new authController();
$main = new mainController();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'register':
        $auth->register();
        break;
    case 'storeUser':
        $auth->storeUser();
        break;
    case 'login':
        $auth->login();
        break;
	case 'logout': // <--- AGREGAR ESTA ACCIÓN
        $auth->logout();
        break;
    case 'dashboard': // <--- AQUÍ CAPTURAMOS LA ACCIÓN
        // Verificar si existe la sesión activa
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php');
            exit;
        }
        $main->index();
        break;
    default:
        $auth->index();
        break;
}
?>