<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    require_once '..\..\..\database\connection.php';
    require_once '..\..\..\database\queries.php';
    require_once '..\..\..\database\utilities.php';
    $products = join_product_table(); // to fetch all products as a table join with categories
    $categories = getCategories(); // to fetch all categories
    $products = getProducts(); // to fetch all products
    requireAdmin(); // Redirect non-admins to homepage or login page (utilities.php)

// Check for a valid ProductID in the query string
if (isset($_GET['ProductID'])) {
    $productID = intval($_GET['ProductID']);
    // Attempt to delete the product
    if (deleteProduct($productID)) {
        // If successful, redirect with a success message
        header('Location: inventory.php?message=' . urlencode('Product deleted successfully.'));
    } else {
        // If it fails, redirect with an error message
        header('Location: inventory.php?message=' . urlencode('Failed to delete product.'));
    }
} else {
    // Redirect with a message if the ProductID wasn't set
    header('Location: inventory.php?message=' . urlencode('Missing Product ID.'));
}
exit();
?>