<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="../../assets/css/website.css">
</head>
<body>
    
<?php 
include '../../../database/connection.php';
include '../../components/Header/header.php';
include '../../../database/queries.php';

$productId = isset($_GET['productId']) ? (int) $_GET['productId'] : 0;

if ($productId > 0) {
    $product = getProductById($productId);
    if ($product) {
        // Display the product details
        echo '<div class="product-details">';
        echo '<div class="product-image">';
        $correctedPath = "../../assets/images/" . $product['ImageURL']; // Adjust as necessary
        echo '<img src="' . htmlspecialchars($correctedPath) . '" alt="' . htmlspecialchars($product['Name']) . '" class="product-thumb">';
        echo '</div>'; // Close .product-image
        echo '<h1>' . htmlspecialchars($product['Name']) . '</h1>';
        echo '<p>' . htmlspecialchars($product['Description']) . '</p>';
        echo '<p>Price: $' . htmlspecialchars($product['Price']) . '</p>';
        echo '</div>'; // Close .product-details
    } else {
        echo '<p>Product not found.</p>';
    }
} else {
    echo '<p>Invalid product ID.</p>';
}

include '../../components/Footer/footer.html';  
?>
</body>
</html>
