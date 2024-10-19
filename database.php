<?php
class Database {
  private $host = "127.0.0.1";
  private $db_name = "api_db";
  private $username = "root";
  private $password = "12345678";
  public $conn;

  public function getConnection() {
    $this->conn = null;
    try {
      $this->conn = new PDO(
        "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
        $this->username,
        $this->password
      );
    } catch(PDOException $exception) {
      echo "Error de conexión: " . $exception->getMessage();
    }
    return $this->conn;
  }
}
?>