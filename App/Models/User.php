<?php 


class User
{
	private $db;

	public function __construct()
	{
		$conn = new connection();
		$this->db = $conn->connect();
	}

	public function getUserByEmail($correo)
	{
		$stmt = $this->db->prepare("SELECT * FROM usuarios WHERE correo = :correo LIMIT 1");
		$stmt->execute(['correo' => $correo]);
		return $stmt->fetch();
	}

	public function createUser($correo, $password)
	{
		$passwordHash = password_hash($password, PASSWORD_DEFAULT);

		$stmt = $this->db->prepare("INSERT INTO usuarios (correo, password) VALUES (:correo, :password)");
		return $stmt->execute([
			'correo' => $correo,
			'password' => $passwordHash
		]);
	}


	public function updateUser($userId, $nuevoNombre = null, $nuevaClave)
	{
		$params = ['id' => $userId];
		$fields = [];

		if (!empty($nuevoNombre)) {
			$fields[] = "nombre = :nombre";
			$params['nombre'] = $nuevoNombre;
		}

		if (!empty($nuevaClave)) {
			$fields[] = "password = :password";
			$params['password'] = password_hash($nuevaClave, PASSWORD_DEFAULT);
		}

		if (empty($fields)) {
			return false;
		}

		$sql = "UPDATE usuarios SET " . implode(', ', $fields) . " WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		return $stmt->execute($params);
	}

}

 ?>