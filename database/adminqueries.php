<!-- Define functions or classes to handle database queries. -->
<?php

// Include the database connection
include 'connection.php';

// database queries as an admin

// add a new product
function addProduct($name, $description, $price, $stockQuantity, $categoryID, $imageURL) {
    global $conn;
    $sql = "INSERT INTO Products (Name, Description, Price, StockQuantity, CategoryID, ImageURL)
    VALUES ('$name', '$description', $price, $stockQuantity, $categoryID, '$imageURL')";
    $result = $conn->query($sql);
    return $result;
}

// update an existing product
function updateProduct($productID, $name, $description, $price, $stockQuantity, $categoryID, $imageURL) {
    global $conn;
    $sql = "UPDATE Products
    SET Name = '$name', Description = '$description', Price = $price, StockQuantity = $stockQuantity, CategoryID = $categoryID, ImageURL = '$imageURL'
    WHERE ProductID = $productID";
    $result = $conn->query($sql);
    return $result;
}
// delete a product
function deleteProduct($productID) {
    global $conn;
    $sql = "DELETE FROM Products WHERE ProductID = $productID";
    $result = $conn->query($sql);
    return $result;
}