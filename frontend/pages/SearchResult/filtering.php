<?php

// Retrieve filter values from the form submission
$category = $_GET['category'];
$minPrice = $_GET['minPrice'];
$maxPrice = $_GET['maxPrice'];
$color = $_GET['color'];

// Perform filtering logic based on the filter values
// You can modify this section to fit your specific filtering requirements
$filteredProducts = []; // Array to store filtered products

// Example filtering logic: filter products based on category
if (!empty($category)) {
    foreach ($products as $product) {
        if ($product['category'] == $category) {
            $filteredProducts[] = $product;
        }
    }
} else {
    $filteredProducts = $products; // If no category selected, show all products
}

// Example filtering logic: filter products based on price range
if (!empty($minPrice) && !empty($maxPrice)) {
    $filteredProducts = array_filter($filteredProducts, function ($product) use ($minPrice, $maxPrice) {
        return $product['price'] >= $minPrice && $product['price'] <= $maxPrice;
    });
}

// Example filtering logic: filter products based on color
if (!empty($color)) {
    $filteredProducts = array_filter($filteredProducts, function ($product) use ($color) {
        return $product['color'] == $color;
    });
}

// Display the filtered products
foreach ($filteredProducts as $product) {
    echo '<div class="product">' . $product['name'] . '</div>';
}
?>
<!-- Filter Form -->
<form id="filterForm">
    <select name="category">
        <option value="">Select Category</option>
        <!-- Category Options -->
    </select>
    <input type="number" name="minPrice" placeholder="Min Price">
    <input type="number" name="maxPrice" placeholder="Max Price">
    <select name="color">
        <option value="">Select Color</option>
        <!-- Color Options -->
        
    </select>
    <button type="submit">Filter</button>
</form>

<!-- Products Display Area -->
<div id="productsArea"></div>
