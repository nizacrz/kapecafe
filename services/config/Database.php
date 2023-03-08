<?php

class Database
{
    private $db_host = 'localhost';
    private $db_name = 'kapecafe';
    private $db_username = 'root';
    private $db_password = '';
    private $conn;

    public function connect()
    {
        if (!isset($this->conn)) {
            try {
                $this->conn = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_username, $this->db_password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
        }

        return $this->conn;
    }
}

// Database configuration
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'kapecafe';

// Connect to the database
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS) or die(mysqli_error($conn));
mysqli_select_db($conn, $DATABASE_NAME) or die(mysqli_error($conn));

if (!$conn) {
    echo "Failed to select Database!";
}
