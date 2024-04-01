<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '..\..\..\database\connection.php';
require_once '..\..\..\database\queries.php';
require_once '..\..\..\database\utilities.php';

// Fetch product details
$productID = isset($_GET['ProductID']) ? intval($_GET['ProductID']) : 0;
$product = getProductById($productID);

// Ensure variables for display are initialized
$feedbackMessage = "";

$categories = getCategories();

// Process form data on POST request
if (isset($_POST['update_product'])) {
    $name = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'productDescription', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'productPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $stockQuantity = filter_input(INPUT_POST, 'productStock', FILTER_SANITIZE_NUMBER_INT);
    $categoryID = filter_input(INPUT_POST, 'productCategory', FILTER_SANITIZE_NUMBER_INT);
    $imageURL = $product['ImageURL']; // Default to the existing image URL

    // Handle file upload
    if (isset($_FILES['ImageURL']) && $_FILES['ImageURL']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = "../../assets/images/"; 
        $imageFileName = "product_" . $productID . '-' . $_FILES['ImageURL']['name'];
        $uploadFilePath = $uploadDir . $imageFileName;

        // Attempt to move the uploaded file
        if (move_uploaded_file($_FILES['ImageURL']['tmp_name'], $uploadFilePath)) {
            $imageURL = "../../assets/images/" . $imageFileName; // Update with the new image path
        } else {
            $feedbackMessage = "File upload failed.";
        }
    }

    // Attempt to update the product in the database
    if (updateProduct($productID, $name, $description, $price, $stockQuantity, $categoryID, $imageURL)) {
        header('Location: inventory.php?message=' . urlencode('Product updated successfully.'));
        exit;
    } else {
        $feedbackMessage = "Failed to update product.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
<?php if (!empty($feedbackMessage)) echo "<p>$feedbackMessage</p>"; ?>
<form method="post" action="editProd.php?ProductID=<?php echo $productID; ?>" enctype="multipart/form-data">
    <!-- Form fields -->
    <label for="productName">Product Name:</label>
    <input type="text" name="productName" value="<?php echo htmlspecialchars($product['Name']); ?>" required>

    <label for="productDescription">Description:</label>
    <input type="text" name="productDescription" value="<?php echo htmlspecialchars($product['Description']); ?>" required>

    <label for="productPrice">Price:</label>
    <input type="number" step="0.01" name="productPrice" value="<?php echo htmlspecialchars($product['Price']); ?>" required>

    <label for="productStock">Stock:</label>
    <input type="number" name="productStock" value="<?php echo htmlspecialchars($product['StockQuantity']); ?>" required>

    <label for="ImageURL">Product Image:</label>
    <input type="file" id="ImageURL" name="ImageURL" accept="image/*">
    <?php if (!empty($product['ImageURL'])): ?>
        <img src="<?php echo $product['ImageURL']; ?>" alt="Product Image" style="max-width: 200px;">
    <?php endif; ?>

    <label for="productCategory">Category:</label>
    <select name="productCategory" required>
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['CategoryID']; ?>" <?php if ($category['CategoryID'] == $product['CategoryID']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($category['CategoryName']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" name="update_product">Update Product</button>
</form>
</body>
</html>
