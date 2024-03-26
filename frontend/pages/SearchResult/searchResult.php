<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../../assets/css/styles.css"> <!-- Link to your external CSS file -->
</head>
<body>

<?php 
include '../../../database/connection.php';
include '../../components/Header/header.php';
include '../../../database/queries.php';

// Get the search term from URL parameters
$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : ''; ?>

<?php

// Only search if there is a search term
if (!empty($searchTerm)) {
    $products = searchProducts($searchTerm); // Call the function from queries.php

    // Check if products were found and display them
    if (!empty($products)) {
        foreach ($products as $product) {
            echo '<div>' . htmlspecialchars($product['Name']) . ' - ' . htmlspecialchars($product['Description']) . '</div>';
        }
    } else {
        echo '<div>No products found.</div>';
    }
}
?>

<?php include '../../components/Footer/footer.php'; ?>
</body>
</html>