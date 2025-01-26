<?php
class Database
{
    private $host = '127.0.0.1';
    private $dbname = 'landing';
    private $username = 'root';
    private $password = 'h6J2vT37Ti';
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->exec("set names utf8");
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