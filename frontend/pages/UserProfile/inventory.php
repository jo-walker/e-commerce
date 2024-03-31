<?php
// adding new products, updating existing ones, and deleting products from the inventory.

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include admin check
require '..\..\..\database\connection.php';
require '..\..\..\database\utilities.php';
require_once '..\..\..\database\queries.php';

requireAdmin(); // Redirect non-admins to homepage or login page

// git 
// update stock
if (isset($_POST['update-stock'])) {
    // Gather and sanitize form data
    $productID = filter_input(INPUT_POST, 'product-id', FILTER_SANITIZE_NUMBER_INT);
    $newStock = filter_input(INPUT_POST, 'new-stock', FILTER_SANITIZE_NUMBER_INT);

    // Call the function to update stock
    try {
        $result = updateStock($productID, $newStock);
        if (!$result) {
            throw new Exception("Failed to update stock. Please check your input and try again.");
        }
        echo "Stock updated successfully.";
    } catch (Exception $e) {
        echo "Error updating product: " . htmlspecialchars($e->getMessage());
    }
}
// update price
if (isset($_POST['update-price'])) {
    // Gather and sanitize form data
    $productID = filter_input(INPUT_POST, 'product-id', FILTER_SANITIZE_NUMBER_INT);
    $newPrice = filter_input(INPUT_POST, 'new-price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Call the function to update price
    try {
        $result = updatePrice($productID, $newPrice);
        if (!$result) {
            throw new Exception("Failed to update price. Please check your input and try again.");
   
        }
        echo "Price updated successfully.";
    } catch (Exception $e) {
        echo "Error updating product: " . htmlspecialchars($e->getMessage());
    }
}
?>

<html>
<head>
    <title>Inventory Management</title>
    <!-- Include necessary styles -->
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/website.css">
</head>
<body>
    <h1>Inventory Management</h1>
    <!-- Add inventory management functionalities here -->

    <!-- add product  -->
    <!-- <form action="inventory.php" method="post">
        <h2>Add Product</h2>
        <div class="input-group">
            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="input-group">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" required>
        </div>
        <div class="input-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" required>
        </div>
        <div class="input-group">
            <label for="stock">Stock Quantity:</label>
            <input type="number" name="stock" id="stock" required>
        </div>
        <div class="input-group">
            <?php $categories = getCategories(); ?>

            <label for="category">Category:</label>
            <select name="category" id="category" required> 
                <?php foreach ($categories as $category): ?> 
                    <option value="<?php echo htmlspecialchars($category['CategoryID']); ?>">
                        <?php echo htmlspecialchars($category['CategoryName']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </div>
        <div class="input-group">
            <label for="image">Image URL:</label>
            <input type="text" name="image" id="image" required>
        </div>
        <div class="input-group">
            <button type="submit" name="add-product">Add Product</button>
        </div> -->

        <!-- update product -->
        <h2>Update Product</h2>
        <div class="input-group">
            <label for="product-id">Product ID:</label>
            <input type="number" name="product-id" id="product-id" required>
        </div>
        <div class="input-group">
            <label for="new-stock">New Stock Quantity:</label>
            <input type="number" name="new-stock" id="new-stock" required>
        </div>
        <div class="input-group">
            <button type="submit" name="update-stock">Update Stock</button>
        </div>
        <div class="input-group">
            <label for="new-price">New Price:</label>
            <input type="number" name="new-price" id="new-price" required>
        </div>
        <div class="input-group">
            <button type="submit" name="update-price">Update Price</button>
        </div>

    </form>
</body>
</html>
