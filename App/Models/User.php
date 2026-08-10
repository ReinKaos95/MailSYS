<?php 


class User
{
	private $db;

	public function __construct()
	{
		$conn = new connection();
		$this->db = $conn->connect();
	}

	public function getUserByEmail($email)
	{
		$stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
		$stmt->execute(['email' => $email]);
		return $stmt->fetch();
	}

	public function createUser()
	{
		$passwordHash = password_hash($password, PASSWORD_DEFAULT);

		$stmt = $this->db->prepare("INSERT INTO usuarios (correo, password) VALUES (:email, :password)");
		$stmt->execute([
			'email' => $email,
			'password' => $passwordHash
		]);
	}

}

 ?>