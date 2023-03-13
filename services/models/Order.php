<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/utils/string.php';

class Order
{
    private $conn;

    // Table name
    private $DB_TABLE = 'order';

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

        $this->name = Str::sanitizeString($this->name);


        $stmt = $this->conn->prepare($query);
    }
}
