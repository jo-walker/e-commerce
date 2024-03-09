<!-- product.php defines a model class for handling product data. 
It contains methods for interacting with the products table in the database. -->
<?php
class Product {
    // Database connection
    private $conn;

    // Constructor with database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all products
    public function getAllProducts() {
        $query = "SELECT * FROM products";
        $result = $this->conn->query($query);
        return $result;
    }
}
?>
