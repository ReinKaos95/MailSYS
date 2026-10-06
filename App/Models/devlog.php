<?php 

/**
 * 
 */
class devlog
{
    private $db;

    public function __construct()
    {
        $conn = new connection();
        $this->db = $conn->connect();
    }

    public function getAllLogs()
    {
        $stmt = $this->db->prepare("SELECT * FROM devlogs ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createLog($version, $titulo, $descripcion, $tipo)
    {
        $stmt = $this->db->prepare("INSERT INTO devlogs (version, titulo, descripcion, tipo)
            VALUES (:version, :titulo, :descripcion, :tipo)");
        return $stmt->execute([
            'version'     => $version,
            'titulo'      => $titulo,
            'descripcion' => $descripcion,
            'tipo'        => $tipo
        ]);
    }
}


 ?>