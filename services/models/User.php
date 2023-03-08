<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/services/utils/string.php';

class User
{
    private $conn;

    // Table name
    private $DB_TABLE = 'users';

    // Properties
    public $id;
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    public $role;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all users
    public function read()
    {
        $query = "SELECT * FROM {$this->DB_TABLE}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    /**
     * Read a single user based on id
     * 
     * @return bool True if read is successful or false otherwise.
     */
    public function read_single()
    {
        $query = "SELECT * FROM {$this->DB_TABLE} WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return false;
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->username = $row['username'];
        $this->email = $row['email'];
        $this->password = $row['password'];
        $this->role = $row['role'];
        return true;
    }

    /**
     * Read a single user based on username & password
     * 
     * @return bool True if read is successful or false otherwise. 
     */
    public function login()
    {
        if (!isset($this->username, $this->password)) {
            return false;
        }

        $query = "SELECT * FROM {$this->DB_TABLE} WHERE username = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->username);
        $stmt->execute();

        // If user doesn't exist
        if ($stmt->rowCount() === 0) {
            return false;
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($this->password, $row['password'])) {
            // If password matches, set properties
            $this->id = $row['id'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->email = $row['email'];
            $this->role = $row['role'];
            return true;
        }

        return false;
    }

    public function logout()
    {
        unset($this->id,  $this->first_name, $this->last_name, $this->email, $this->username, $this->role, $this->password);
    }

    public function create()
    {
        $query = "INSERT INTO {$this->DB_TABLE}
        SET
            first_name = :first_name,
            last_name = :last_name,
            username = :username,
            email = :email,
            password = :password,
            role = :role";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->first_name = Str::sanitizeString($this->first_name);
        $this->last_name = Str::sanitizeString($this->last_name);
        $this->username = Str::sanitizeString($this->username);
        $this->email = Str::sanitizeString($this->email);
        $this->role = Str::sanitizeString($this->role);

        // Hash + Salt password
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        // Bind data
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function find_by_username()
    {
        $query = "SELECT * FROM {$this->DB_TABLE} WHERE username = :username";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':username', $this->username);

        // Execute Query
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    private function setProperties()
    {
        $query = "SELECT * FROM {$this->DB_TABLE} WHERE username = :username";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':username', $this->username);

        // Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->id = intval($row['id']);
    }
}
