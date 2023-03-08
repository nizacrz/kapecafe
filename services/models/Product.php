<?php

class Product
{
    private $conn;

    // Table name
    private $DB_TABLE = 'products';

    // properties
    public $id;
    public $category;
    public $name;
    public $description;
    public $image;
    public $price;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM {$this->DB_TABLE}";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute Query
        $stmt->execute();

        return $stmt;
    }

    public function read_single()
    {
        $query = "SELECT * FROM {$this->DB_TABLE} WHERE user_id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        return $stmt;
    }

    public function read_categories()
    {
        $query = "SELECT DISTINCT category FROM {$this->DB_TABLE}";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_products_per_category()
    {
        $query = "SELECT * FROM {$this->DB_TABLE} WHERE category = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function create_product()
    {
        $query = "INSERT IGNORE INTO {$this->DB_TABLE} 
        SET 
            category = :category, 
            name = :name, 
            description = :description, 
            price = :price";

        if (isset($this->image)) {
            $query = $query . ", image = :image";
        }

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->category = Str::sanitizeString($this->category);
        $this->name = Str::sanitizeString($this->name);
        $this->description = Str::sanitizeString($this->description);
        $this->price = Str::sanitizeDouble($this->price);

        if (isset($this->image)) {
            $this->image = Str::sanitizeString($this->image);
        }

        // Bind data
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);

        if (isset($this->image)) {
            $stmt->bindParam(':image', $this->image);
        }

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
