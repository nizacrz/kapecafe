<?php
class Cart
{
    private $conn;

    // Table name
    private $DB_TABLE = 'cart';

    // Properties
    public $id;
    public $user_id;
    public $product_id;
    public $quantity;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all by user_id
    public function read_by_user()
    {
        $query = "SELECT * FROM {$this->DB_TABLE} WHERE user_id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->user_id);
        $stmt->execute();

        return $stmt;
    }
}
