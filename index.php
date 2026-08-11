<?php

define('ROOT_PATH', __DIR__ . '/');
// Cargar configuraciones iniciales
require_once ROOT_PATH . 'App/Config/define.php';
require_once ROOT_PATH . 'App/Config/db.php';
require_once ROOT_PATH . 'App/Controllers/authController.php';

$auth = new authController();

// Enrutador básico para pruebas rápidas
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
    default:
        $auth->index();
        break;
}
?>