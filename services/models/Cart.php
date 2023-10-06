

<?php
// include_once $_SERVER['DOCUMENT_ROOT'] . '/services/utils/string.php';
class Cart
{
    private $conn;

    // Table name
    private $DB_TABLE = 'cart';
    private $PRODUCTS_TABLE = 'products';

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

    public function read_by_user_full()
    {
        $query = "SELECT c.user_id, c.product_id, c.quantity, p.category, p.name, p.description, p.image, p.price FROM {$this->DB_TABLE} c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->user_id);
        $stmt->execute();

        return $stmt;
    }

    public function insert()
    {
        $query = "INSERT IGNORE INTO {$this->DB_TABLE} SET 
            user_id = :user_id,
            product_id = :product_id,
            quantity = :quantity
        ";

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_id = $this->user_id;
        $this->product_id = $this->product_id;
        $this->quantity = $this->quantity;

        // Bind Data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);

        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE {$this->DB_TABLE} SET 
            quantity = :quantity
            WHERE user_id = :id AND product_id = :pid
        ";

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_id = $this->user_id;
        $this->product_id = $this->product_id;
        $this->quantity = $this->quantity;

        // Bind Data
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':id', $this->user_id);
        $stmt->bindParam(':pid', $this->product_id);

        return $stmt->execute();
    }

    public function remove()
    {
        $query = "DELETE FROM {$this->DB_TABLE} WHERE 
            user_id = :user_id AND
            product_id = :product_id
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':product_id', $this->product_id);

        return $stmt->execute();
    }

    public function removeAll()
    {
        $query = "DELETE FROM {$this->DB_TABLE} WHERE 
        user_id = :user_id
    ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $this->user_id);
        return $stmt->execute();
    }

    public function increment_product_quantity()
    {
        $query = "UPDATE {$this->DB_TABLE} SET 
        quantity = quantity + 1
        WHERE user_id = :id AND product_id = :pid
    ";

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_id = $this->user_id;
        $this->product_id = $this->product_id;

        // Bind Data
        $stmt->bindParam(':id', $this->user_id);
        $stmt->bindParam(':pid', $this->product_id);

        return $stmt->execute();
    }

    public function check_if_product_exists($product_id)
    {
        $query = "SELECT * FROM {$this->DB_TABLE} WHERE product_id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($query);

        $product_id = $product_id;

        $stmt->bindParam(1, $product_id);
        $stmt->bindParam(2, $this->user_id);

        $stmt->execute();

        return ($stmt->rowCount() > 0);
    }
}
