<!-- Define functions or classes to handle database queries. -->
<?php

// Include the database connection
include 'connection.php';

// database queries
// retrieve all products
function getProducts() {
    global $conn;
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
// retrieve a single product by id
function getProductById($id) {
    global $conn;
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}
// insert a new product
function getNewProduct($name, $price, $description) {
    global $conn;
    $sql = "INSERT INTO products (name, price, description) VALUES ('$name', $price, '$description')";
    $result = $conn->query($sql);
    return $result;
}
// update an existing product
function updateProduct($id, $name, $price, $description) {
    global $conn;
    $sql = "UPDATE products SET name = '$name', price = $price, description = '$description' WHERE id = $id";
    $result = $conn->query($sql);
    return $result;
}
// delete a product
function deleteProduct($id) {
    global $conn;
    $sql = "DELETE FROM products WHERE id = $id";
    $result = $conn->query($sql);
    return $result;
}
// add more functions as needed
?>
