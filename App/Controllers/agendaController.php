<?php 

/* 

Controlador que lleba registro

 */
class agendaController 
{
	private $agendaModel;
	function __construct()
	{
		require_once ROOT_PATH . 'App/Models/agenda.php';
		$this->agendaModel = new agenda();
	}

	public function store()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$userId = $_SESSION['user_id'] ?? null;
			$titulo = trim($_POST['titulo'] ?? '');
			$fecha = $_POST['fecha'] ?? date('Y-m-d');
			$hora = $_POST['hora'] ?? null;
			$desc = trim($_POST['descripcion'] ?? '');

			$hoy = date('Y-m-d');
			if ($fecha < $hoy) {
				header('Location: index.php?action=dashboard&error=fecha_invalida');
				exit;
			}

			if ($userId && !empty($titulo)) {
				$this->agendaModel->createNote($userId, $titulo, $fecha, $hora, $desc);
				}
			header('Location: index.php?action=dashboard');
			exit;
		}
	}



	public function getNotes()
	{
	    // Limpiar cualquier salida previa que pueda romper el JSON
	    if (ob_get_length()) ob_clean(); 

	    header('Content-Type: application/json');

	    $userId = $_SESSION['user_id'] ?? null;
	    $fecha = $_GET['fecha'] ?? date('Y-m-d');

	    if (!$userId) {
	        echo json_encode([]);
	        exit;
	    }

	    $notas = $this->agendaModel->getNotesByDate($userId, $fecha);
	    echo json_encode($notas ?: []);
	    exit;
	}
}

 ?>