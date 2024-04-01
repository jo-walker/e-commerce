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
    $color = filter_input(INPUT_POST, 'productColor', FILTER_SANITIZE_STRING);

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
    if (updateProduct($productID, $name, $description, $price, $stockQuantity, $categoryID, $imageURL, $color)) {
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
<link rel="stylesheet" href="../../assets/css/website.css">
     <!-- Include Header Component -->
     <?php include '../../components/Header/header.php'; ?>
<?php  
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>    
</head>
<body>
<div class="profile-container">
        <div class="sidebar">
        <nav class="usernav">
            <h2 id="h1">Profile</h2>
                <ul>
                    <li><a href="userprof.php" id="li">Personal Info</a></li>
                    <?php if (isAdmin()): ?>
                                    <li><a href="inventory.php" id="li">Manage Inventory</a></li>
                    <?php endif; ?>                       
                    <li><a href="../Home/index.php" id="li">Home</a></li>
                    <li><a href="../Cart/cart.html" id="li">Cart</a></li>
                    <li><a href="../Checkout/checkout.html"id="li">Checkout</a></li>
                </ul>
            </nav>
        </div>
<?php if (!empty($feedbackMessage)) echo "<p>$feedbackMessage</p>"; ?>
<form id="productForm" method="post" action="editProd.php?ProductID=<?php echo $productID; ?>" enctype="multipart/form-data">
    <!-- Form fields -->
    <label for="productName"  id="productNameLabel">Product Name:</label>
    <input type="text" name="productName"  id="productName" value="<?php echo htmlspecialchars($product['Name']); ?>" >

    <label for="productDescription" id="productDescriptionLabel">Description:</label>
    <input type="text" name="productDescription"  id="productDescription" value="<?php echo htmlspecialchars($product['Description']); ?>" >

    <label for="productPrice" id="productDescriptionLabel">Price:</label>
    <input type="number" step="0.01" name="productPrice" id="productPrice" value="<?php echo htmlspecialchars($product['Price']); ?>" >

    <label for="productStock" id="productDescriptionLabel">Stock:</label>
    <input type="number" name="productStock" id="productStock" value="<?php echo htmlspecialchars($product['StockQuantity']); ?>" >

    <label for="ImageURL" id="productDescriptionLabel">Product Image:</label>
    <input type="file" id="ImageURL"  name="ImageURL" accept="image/*">
    <?php if (!empty($product['ImageURL'])): ?>
        <img src="<?php echo $product['ImageURL']; ?>" alt="Product Image" style="max-width: 200px;">
    <?php endif; ?>

    <label for="productCategory" id="productDescriptionLabel">Category:</label>
    <select name="productCategory" required>
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['CategoryID']; ?>" <?php if ($category['CategoryID'] == $product['CategoryID']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($category['CategoryName']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    
    <label for="productColor" id="productDescriptionLabel">Color:</label>
    <input type="text" name="productColor" id="productColor" value="<?php echo htmlspecialchars($product['Color']);?>">

    <button type="submit" id="addProductBtn" name="update_product">Update Product</button>
</form>
</body>
</html>