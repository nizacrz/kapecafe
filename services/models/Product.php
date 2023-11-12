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

    public function read($size = 30, $index = 1, $offset = 0)
    {
        $query = "SELECT * FROM {$this->DB_TABLE}";

        $limit = '';

        if ($size > 0) {
            if ($index > 0) {
                $offset = $index * $size - $size + $offset;
                $limit = $limit . " LIMIT $offset, $size";
            } else {
                $limit = $limit . " LIMIT $offset, $size";
            }
        }

        $query = $query . $limit;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute Query
        $stmt->execute();

        return $stmt;
    }

    public function search($query, $size = 30, $index = 1, $offset = 0)
    {
        // Define the search query
        $searchQuery = "SELECT * FROM {$this->DB_TABLE} WHERE 
    name LIKE :query OR 
    description LIKE :query";

        // Add pagination if needed
        $limit = '';
        if ($size > 0) {
            if ($index > 0) {
                $offset = $index * $size - $size + $offset;
                $limit = " LIMIT $offset, $size";
            } else {
                $limit = " LIMIT $offset, $size";
            }
        }

        // Complete the query with pagination
        $searchQuery = $searchQuery . $limit;

        // Prepare statement
        $stmt = $this->conn->prepare($searchQuery);

        // Bind parameters
        $searchParam = "%{$query}%";
        $stmt->bindParam(':query', $searchParam);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    public function read_by_category()
    {
        $query = "SELECT * FROM {$this->DB_TABLE} WHERE category = ?";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind Category as Parameter
        $stmt->bindParam(1, $this->category);

        // Execute Query
        $stmt->execute();

        return $stmt;
    }

    public function read_single()
    {
        $query = "SELECT * FROM {$this->DB_TABLE} WHERE id = ?";

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

    public function read_products_per_category($size = 30, $index = 1, $offset = 0)
    {
        $query = "SELECT * FROM {$this->DB_TABLE} WHERE category = ?";

        $limit = '';

        if ($size > 0) {
            if ($index > 0) {
                $final = $size * $index + $offset;
                $offset = $index * $size - $size + $offset;
                $limit = $limit . " LIMIT $offset, $final";
            } else {
                $final = $size + $offset;
                $limit = $limit . " LIMIT $offset, $final";
            }
        }

        $query = $query . $limit;

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->category);

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

        // Bind data
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);

        if (isset($this->image)) {
            $stmt->bindParam(':image', $this->image);
        }

        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE {$this->DB_TABLE} SET
        category = :category,
        name = :name,
        description = :description,
        price = :price";

        // Insert an update value for image
        if (isset($this->image)) {
            $query = $query . ", image = :image";
        }

        // End the SQL Query
        $query = $query . " WHERE id = :id";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':id', $this->id);

        if (isset($this->image)) {
            $stmt->bindParam(':image', $this->image);
        }

        return $stmt->execute();
    }

    /**
     * This function deletes the product using its id
     */
    public function delete()
    {
        $query = "DELETE FROM {$this->DB_TABLE} WHERE
            id = :product_id
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':product_id', $this->id);

        return $stmt->execute();
    }


    public function check_if_exists($id)
    {
        $query = "SELECT * FROM {$this->DB_TABLE} WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        // Bind Parameters
        $stmt->bindParam(1, $id);

        // Execute query
        $stmt->execute();

        return ($stmt->rowCount() > 0);
    }
}
