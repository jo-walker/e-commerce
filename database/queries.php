<!-- Define functions or classes to handle database queries. -->
<?php

// Include the database connection
include 'connection.php';

// database queries as a customer
// retrieve all products
function getProducts() {
    global $conn;
    $sql = "SELECT * FROM Products";
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
// search for products by name or description
function searchProducts($name) {
    global $conn;
    $sql = "SELECT * FROM Products
    WHERE Name LIKE '%$name%' OR Description LIKE '%$description%'";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
// filter products by category
function filterProducts($category) {
    global $conn;
    $sql = "SELECT * FROM Products WHERE CategoryID = '$categoryID'";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
// view details of a product
function viewProduct($productID) {
    global $conn;
    $sql = "SELECT * FROM Products WHERE ProductID = $productID";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// both admin and customer queries
// list all categories for filtering (clientside) or editing (admin)
function getCategories() {
    global $conn;
    $sql = "SELECT * FROM Categories";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
// add a new user
function addUser($name, $password, $email, $role) {
    global $conn;
    $sql = "INSERT INTO Users (Username, Password, Email, Role)
    VALUES ('$name', '$password', '$email', '$role')";
    $result = $conn->query($sql);
    return $result;
}
// update an existing user information
function updateUser($userID, $name, $password, $email, $role) {
    global $conn;
    $sql = "UPDATE Users
    SET Username = '$name', Password = '$password', Email = '$email', Role = '$role'
    WHERE UserID = $userID";
    $result = $conn->query($sql);
    return $result;
}
// delete a user
function deleteUser($userID) {
    global $conn;
    $sql = "DELETE FROM Users WHERE UserID = $userID";
    $result = $conn->query($sql);
    return $result;
}
?>
