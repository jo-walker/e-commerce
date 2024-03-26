<?php 
include '../../../database/connection.php';
include '../../Header/header.php';
include '../../../database/queries.php';

// Get the search term from URL parameters
$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : ''; ?>

<!-- Search Form -->
<form action="searchResult.php" method="get">
    <input type="text" name="searchTerm" placeholder="Search for products..." value="<?php echo htmlspecialchars($searchTerm); ?>">
    <button type="submit">Search</button>
</form>
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

<?php include '../../Footer/footer.php'; ?>