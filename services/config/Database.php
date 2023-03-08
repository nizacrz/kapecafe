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

// DECLARED CONSTANTS
$DISPLAY_COUNT = 8;
