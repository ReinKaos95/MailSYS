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

}

 ?>