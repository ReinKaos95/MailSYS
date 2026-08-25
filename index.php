<?php 
session_start();

define('ROOT_PATH', __DIR__ . '/');

// Importar Autoloader de Libs (Carbon)
if (file_exists(ROOT_PATH . 'App/Libs/vendor/autoload.php')) {
    require_once ROOT_PATH . 'App/Libs/vendor/autoload.php';
}

// Configurar la zona horaria y el idioma local por defecto
use Carbon\Carbon;
Carbon::setLocale('es');
date_default_timezone_set('America/Caracas');

//echo "Hora actual: " . Carbon::now()->format('d/m/Y h:i A'); 
// Imprime algo como: Hora actual: 23/08/2026 06:30 PM

//echo "<br>Hace cuánto: " . Carbon::now()->subHours(3)->diffForHumans();

require_once ROOT_PATH . 'App/Config/define.php';
require_once ROOT_PATH . 'App/Config/db.php';
require_once ROOT_PATH . 'App/Controllers/authController.php';
require_once ROOT_PATH . 'App/Controllers/mainController.php'; // Incluimos el controlador principal
require_once ROOT_PATH . 'App/Controllers/profileController.php';
require_once ROOT_PATH . 'App/Controllers/agendaController.php';

$auth = new authController();
$main = new mainController();
$profile = new profileController();
$agenda = new agendaController();

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
    case 'logout':
        $auth->logout();
        break;
    case 'dashboard':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php');
            exit;
        }
        $main->index();
        break;
    case 'profile':
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        $profile->index();
        break;
    case 'config':
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        $profile->config();
        break;
    case 'updateProfile':
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        $profile->update();
        break;
    case 'storeNote':
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        $agenda->store();
        break;
    case 'getNotes':
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        $agenda->getNotes();
        break;
    case 'adminUsers':
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'superadmin') {
        header('Location: index.php?action=dashboard');
        exit;
        }
        $profile->adminUsers(); // Método en profileController
        break;
    case 'storeUserByAdmin':
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        $profile->storeUserByAdmin();
        break;
    default:
        $auth->index();
        break;
}
?>