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
    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        error_log("Database query failed: " . $conn->error); // Log error to PHP error log
        return []; // Return an empty array as a safe default
    }
}

// retrieve a single product by id
function getProductById($id) {
    global $conn;
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// search for products by name or description
function searchProducts($searchTerm) {
    global $conn;
    $searchTerm = '%' . $searchTerm . '%';
    $sql = "SELECT * FROM Products WHERE Name LIKE ? OR Description LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $searchTerm, $searchTerm); // 'ss' denotes two string parameters
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// filter products by category
function filterProducts($categoryID) {
    global $conn;
    $sql = "SELECT * FROM Products WHERE CategoryID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoryID); // CategoryID is an integer
    $stmt->execute();
    $result = $stmt->get_result();
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
?>
