<?php

class Database
{
    private static $db_host = 'localhost';
    private static $db_name = 'kapecafe';
    private static $db_username = 'root';
    private static $db_password = '';
    private static $conn;

    public static function connect()
    {
        if (!isset(Database::$conn)) {
            try {
                Database::$conn = new PDO('mysql:host=' . Database::$db_host . ';dbname=' . Database::$db_name, Database::$db_username, Database::$db_password);
                Database::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
        }

        return Database::$conn;
    }
}

// DECLARED CONSTANTS
$DISPLAY_COUNT = 8;
