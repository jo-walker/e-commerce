<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../../assets/css/styles.css"> <!-- Link to external CSS file -->
    <link rel="stylesheet" href="../../assets/css/products.css">
    <link rel="stylesheet" href="../../assets/css/website.css">
</head>
<body>

<?php 
include '../../../database/connection.php';
include '../../components/Header/header.php';
include '../../../database/queries.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}require '..\..\..\database\connection.php'; // database config file

// Get the search term from URL parameters
$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : ''; ?>

<!-- Product Display Section -->
<div class="product-display">
    <?php
    if (!empty($searchTerm)) {
        $products = searchProducts($searchTerm); // This is your search function from queries.php

        if (!empty($products)) {
            echo '<div class="product-grid">'; // CSS for .product-grid to display products in a grid
            foreach ($products as $product) {
                echo '<div class="product-item">'; // Individual product item
                echo '<img src="' . htmlspecialchars($product['ImageURL']) . '" alt="Product Image" class="product-image">'; // Assuming there's an ImageURL field
                echo '<div class="product-details">';
                echo '<h2>' . htmlspecialchars($product['Name']) . '</h2>'; // Product name
                echo '<p>' . htmlspecialchars($product['Description']) . '</p>'; // Product description
                echo '<p class="product-price">$' . htmlspecialchars($product['Price']) . '</p>'; // Product price
                echo '<a href="..\ProductDetails\productD.php?productId=' . htmlspecialchars($product['ProductID']) . '" class="view-details">View Details</a>'; // Link to product details
                echo '</div>';
                echo '</div>'; // Close .product-item
            }
            echo '</div>'; // Close .product-grid
        } else {
            echo '<div>No products found.</div>';
        }
    }
    ?>
</div>
<!-- Pagination (If applicable) -->
<div class="pagination">
    <!-- Insert your pagination links here -->
</div>

<?php include '../../components/Footer/footer.html'; ?>
</body>
</html>