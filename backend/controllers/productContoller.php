<!-- productController.php includes the necessary files and uses the Product model to fetch all products from the database. 
It then outputs the products as JSON, which can be consumed by the frontend application. -->
<?php
include '../config/database.php';
include '../models/Product.php';

// Instantiate database connection
$db = new mysqli($db_host, $db_username, $db_password, $db_name);

// Instantiate Product model
$product = new Product($db);

// Get all products
$products = $product->getAllProducts();

// Output products as JSON or process further as needed
echo json_encode($products);
?>
