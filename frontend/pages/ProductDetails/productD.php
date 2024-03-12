<?php
// Include the database connection file
include 'connection.php';

// Check if the product ID is provided in the request
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $productId = mysqli_real_escape_string($conn, $_GET['id']);

    // Query to fetch product details based on the provided ID
    $query = "SELECT * FROM products WHERE id = '$productId'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if($result) {
        // Fetch the product details
        $product = mysqli_fetch_assoc($result);

        // Return the product details as JSON response
        echo json_encode($product);
    } else {
        // If the query fails, return an error message
        echo json_encode(array('error' => 'Failed to fetch product details'));
    }
} else {
    // If product ID is not provided, return an error message
    echo json_encode(array('error' => 'Product ID is missing'));
}
?>
