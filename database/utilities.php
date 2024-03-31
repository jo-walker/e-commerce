<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function isAdmin() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}

function requireAdmin() {
    if (!isAdmin()) {
        header('Location: ../frontend/pages/Home/index.php'); // Adjust the redirection as needed
        exit;
    }
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addProduct'])) {
    // Process adding a new product
    $productName = $_POST['productName']; // Assume proper validation
    // ... more processing and validation ...
    $stmt = $conn->prepare("INSERT INTO Products (name, price, stock) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $productName, $productPrice, $productStock);
    if ($stmt->execute()) {
        echo "Product added successfully";
    } else {
        echo "Error adding product: " . $conn->error;
    }
    $stmt->close();
    // Redirect or further processing
}

?>


