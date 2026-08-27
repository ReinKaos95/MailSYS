<?php 

//archivo para definir caracteres

class connection
{

	//Parametros de la base de datos
	private $host = DB_HOST;
	private $dbname = DB_NAME;
	private $username = DB_USER;
	private $password = DB_PASS;
	private $charset = DB_CHARSET;
 	private $port = DB_PORT;

 	//Instancia de conexion PDO
 	public $pdo;

	public function connect()
	{
		// Data Source Name (DSN)
		$dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}";

		// PHP Data Objects (PDO)

		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,
		];

		// Validar conexion

		try {
			$this->pdo = new PDO($dsn, $this->username, $this->password, $options);
			return $this->pdo;
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int)$e->getCode());
			
		}
	}

}

 ?>