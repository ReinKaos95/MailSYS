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
	    $stmt = $this->db->prepare("
	        SELECT u.*, r.nombre AS rol_nombre 
	        FROM usuarios u
	        INNER JOIN roles r ON u.rol_id = r.id
	        WHERE u.correo = :email LIMIT 1
	    ");
	    $stmt->execute(['email' => $email]);
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

	public function getAllUsers()
	{
	    $stmt = $this->db->prepare("
	        SELECT u.id, u.nombre, u.correo, r.nombre AS rol_nombre 
	        FROM usuarios u
	        INNER JOIN roles r ON u.rol_id = r.id
	        ORDER BY u.id DESC
	    ");
	    $stmt->execute();
	    return $stmt->fetchAll();
	}

	public function createUserByAdmin($nombre, $correo, $password, $rolId = 2)
	{
	    $stmt = $this->db->prepare("
	        INSERT INTO usuarios (nombre, correo, password, rol_id) 
	        VALUES (:nombre, :correo, :password, :rol_id)
	    ");
	    return $stmt->execute([
	        'nombre'   => $nombre,
	        'correo'   => $correo,
	        'password' => password_hash($password, PASSWORD_DEFAULT),
	        'rol_id'   => $rolId
	    ]);
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