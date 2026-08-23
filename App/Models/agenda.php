<?php 

/**
 * 
 */
class agenda
{
	
	function __construct()
	{
		$conn = new connection();
		$this->db = $conn->connect();
	}

	public function getNotesByDate($userId, $fecha)
	{
		$stmt = $this->db->prepare("SELECT * FROM agenda_eventos WHERE user_id = :user_id AND fecha = :fecha ORDER BY hora ASC");
		$stmt->execute([
			'user_id' => $userId,
			'fecha' => $fecha,
		]);
		return $stmt->fetchAll();
	}

	public function createNote($userId, $titulo, $fecha, $hora = null, $descripcion = null)
	{
		$stmt = $this->db->prepare("INSERT INTO agenda_eventos (user_id, titulo, fecha, hora, descripcion) VALUES (:user_id, :titulo, :fecha, :hora, :descripcion)");
		return $stmt->execute([
			'user_id' => $userId,
			'titulo' => $titulo,
			'fecha' => $fecha,
			'hora' => $hora,
			'descripcion' => $descripcion
		]);
	}
}

 ?>