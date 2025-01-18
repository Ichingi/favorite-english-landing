<?php
class Application
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function saveApplication($name, $email, $level)
    {
        $query = "INSERT INTO applications (name, email, level) VALUES (:name, :email, :level)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':level', $level);
        
        return $stmt->execute();
    }
}