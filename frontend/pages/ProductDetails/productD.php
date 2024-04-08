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
?>


<div class="bck-2"> </div>
<div class="container-2">
<?php 
$productId = isset($_GET['productId']) ? (int) $_GET['productId'] : 0;
if ($productId > 0) {
    $product = getProductById($productId);
    if ($product) {
        // Display the product details
        echo '<div class="product-details-2">';
        echo '<div class="product-image-2">';
        $correctedPath = "../../assets/images/" . $product['ImageURL']; // Adjust as necessary
        echo '<img src="' . htmlspecialchars($correctedPath) . '" alt="' . htmlspecialchars($product['Name']) . '" class="product-thumb-2">';
        ?>
</div>
        <div class="details-2">
        <?php
        echo '<h1 id="h1">' . htmlspecialchars($product['Name']) . '</h1>';
        echo '<p class="product-d">' . htmlspecialchars($product['Description']) . '</p>';
        echo '<p id="price">Price: $' . htmlspecialchars($product['Price']) . '</p>';
        echo '</div>'; // Close .product-details
    } else {
        echo '<p>Product not found.</p>';
    }
} else {
    echo '<p>Invalid product ID.</p>';
}
?>
</div>
<?php
include '../../components/Footer/footer.html';  
?>
    </div>

</body>
</html>
