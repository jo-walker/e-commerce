<!-- This PHP file could handle the retrieval of product data from the database and 
serve as an API endpoint for the frontend to fetch product data. -->

<?php
// Include database connection file
include '../database/connection.php';
// Include file with database queries
include '../database/queries.php';

// Retrieve product data from the database
$products = getProducts($conn);

// Output JSON response
header('Content-Type: application/json');
echo json_encode($products);
?>