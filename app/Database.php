<?php
class Database
{
    private $host = 'localhost';
    private $dbname = 'favorite-english';
    private $username = 'root';
    private $password = '123456';
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Помилка підключення: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}