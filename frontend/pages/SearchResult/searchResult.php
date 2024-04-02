<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>

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
$categoryOptions = getCategoriesFilter(); // to fetch all categories for filter
$colorOptions = getColorOptions();

// Use these variables in your product fetching logic to apply filters.

// Get the search term from URL parameters
$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

// Retrieve filter values from the form submission
$category = isset($_GET['category']) ? $_GET['category'] : '';
$minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : '';
$maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : '';
$color = isset($_GET['color']) ? $_GET['color'] : '';

// Now, use these variables to fetch filtered products
$products = searchProductsFiltered($searchTerm, $category, $minPrice, $maxPrice, $color);
 ?>

<!-- Product Display Section -->
<div class="product-display">
    <?php
    // if (!empty($searchTerm)) {
        // $products = searchProducts($searchTerm); // This is your search function from queries.php

        if (!empty($products)) {
            echo '<div class="product-grid">'; // CSS for .product-grid to display products in a grid
            foreach ($products as $product) {
                echo '<div class="product-item">'; // Individual product item
                echo '<img src="' . htmlspecialchars($product['ImageURL']) . '" alt="Product Image" class="product-image">'; // Assuming there's an ImageURL field
                echo '<div class="product-details">';
                echo '<h2>' . htmlspecialchars($product['Name']) . '</h2>'; // Product name
                echo '<p>' . htmlspecialchars($product['Description']) . '</p>'; // Product description
                echo '<p class="product-price">$' . htmlspecialchars($product['Price']) . '</p>'; // Product price
                echo '<p class="product-category">Category: ' . htmlspecialchars($product['category'] ?? 'Not specified') . '</p>';
                echo '<p class="product-color">Color: ' . htmlspecialchars($product['Color'] ?? 'Not specified') . '</p>';
                                echo '<a href="..\ProductDetails\productD.php?productId=' . htmlspecialchars($product['ProductID']) . '" class="view-details">View</a>'; // Link to product details
                echo '</div>';
                echo '</div>'; // Close .product-item
            }
            echo '</div>'; // Close .product-grid
        } else {
            echo '<div>No products found.</div>';
        }
    // }
    ?>
</div>
<form id="filterForm" method="GET" action="searchResult.php">
    <!-- Keep the search term input hidden to maintain search context -->
    <input type="hidden" name="searchTerm" value="<?php echo htmlspecialchars($searchTerm); ?>">
    <!-- Category filter -->
    <select name="category">
        <option value="">Select Category</option>
        <?php foreach ($categoryOptions as $option) : ?>
            <option value="<?php echo $option; ?>">
                <?php echo $option; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <!-- Price range filter -->
    <input type="number" name="minPrice" placeholder="Min Price">
    <input type="number" name="maxPrice" placeholder="Max Price">
    <!-- Color filter -->
    <select name="color">
        <option value="">Select Color</option>
        <?php foreach ($colorOptions as $option) : ?>
            <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Filter</button>
</form>
<!-- Pagination -->
<div class="pagination">
    <!-- Insert your pagination links here -->
</div>

<?php include '../../components/Footer/footer.html'; ?>
</body>
</html>