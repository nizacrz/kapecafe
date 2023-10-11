<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/utils/string.php';

class Order
{
    private $conn;

    // Table name
    private $DB_TABLE = 'orders';

    public $id;
    public $name;
    public $number;
    public $email;
    public $method;
    public $flat;
    public $street;
    public $city;
    public $state;
    public $country;
    public $pin_code;
    public $total_products;
    public $total_price;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT IGNORE INTO {$this->DB_TABLE} SET 
            name = :name,
            number = :number,
            email = :email,
            method = :method,
            flat = :flat,
            street = :street,
            city = :city,
            state = :state,
            country = :country,
            pin_code = :pin_code,
            total_products = :total_products,
            total_price = :total_price
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':number', $this->number);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':method', $this->method);
        $stmt->bindParam(':flat', $this->flat);
        $stmt->bindParam(':street', $this->street);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':state', $this->state);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':pin_code', $this->pin_code);
        $stmt->bindParam(':total_products', $this->total_products);
        $stmt->bindParam(':total_price', $this->total_price);

        return $stmt->execute();
    }
}
