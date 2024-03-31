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
    $sql = "SELECT * FROM products WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($product = $result->fetch_assoc()) {
        return $product;
    } else {
        return null; // Return null if no product is found
    }}

// Function to generate HTML for a single product
function displayProduct($productId) {
    $product = getProductById($productId);
    if ($product) {
        //  'product-details.php' is  product details page -> it expects a 'productId' query parameter.
        $productDetailsUrl = "product-details.php?productId=" . htmlspecialchars($productId);

        $html = '<a href="' . $productDetailsUrl . '" class="product-card-link">';

        $html = '<div class="product-card">';
        $html .= '<div class="product-image">';
        $html .= '<img src="' . htmlspecialchars($product['ImagePath']) . '" alt="' . htmlspecialchars($product['Name']) . '">';
        $html .= '</div>'; // Close product-image
        $html .= '<div class="product-info">';
        $html .= '<h3>' . htmlspecialchars($product['Name']) . '</h3>';
        $html .= '<p>' . htmlspecialchars($product['Description']) . '</p>';
        $html .= '<p>Price: $' . htmlspecialchars($product['Price']) . '</p>';
        $html .= '</div>'; // Close product-info
        $html .= '</div>'; // Close product-card
        $html .= '</a>'; // Close product-card-link

        return $html;
    } else {
        return '<p>Product not found.</p>';
    }
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
    try {
        $sql = "INSERT INTO Products (Name, Description, Price, StockQuantity, CategoryID, ImageURL)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception($conn->error);
        }
        $stmt->bind_param("ssdiss", $name, $description, $price, $stockQuantity, $categoryID, $imageURL);
        $stmt->execute();
        $conn->commit();
        if ($stmt->error) {
            throw new Exception($stmt->error);
        }
        return true;
    } catch (Exception $e) {
        error_log($e->getMessage()); // Log error to a file
        return false; // Consider returning $e->getMessage() for more detailed error feedback
    }
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
// update stock fcn
function updateStock($productID, $newStock) {
    global $conn;
    $sql = "UPDATE Products SET StockQuantity = ? WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $newStock, $productID);
    if (!$stmt->execute()) {
        return false; // You could also return $conn->error here for debugging
    }
    return true;
}
// update price fcn
function updatePrice($productID, $newPrice) {
    global $conn;
    $sql = "UPDATE Products SET Price = ? WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $newPrice, $productID);
    if (!$stmt->execute()) {
        return false;
    }
    return true;
}

// delete a product
function deleteProduct($productID) {
    global $conn;
    $sql = "DELETE FROM Products WHERE ProductID = $productID";
    $result = $conn->query($sql);
    return $result;
}
?>