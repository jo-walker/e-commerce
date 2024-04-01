<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '..\..\..\database\connection.php';
require_once '..\..\..\database\queries.php';
require_once '..\..\..\database\utilities.php';
requireAdmin(); // Redirect non-admins to homepage or login page (utilities.php)
$products = join_product_table(); // to fetch all products as a table join with categories
$categories = getCategories(); // to fetch all categories
$products = getProducts(); // to fetch all products

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data
    $Name = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
    $Description = filter_input(INPUT_POST, 'productDescription', FILTER_SANITIZE_STRING);
    $Price = filter_input(INPUT_POST, 'productPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $StockQuantity = filter_input(INPUT_POST, 'productStock', FILTER_SANITIZE_NUMBER_INT);
    $categoryID = filter_input(INPUT_POST, 'productCategory', FILTER_SANITIZE_NUMBER_INT);
    $imageURL = null;    

    // Process image upload
    if (isset($_FILES['ImageURL']) && $_FILES['ImageURL']['error'] == UPLOAD_ERR_OK) {
        // Define the path to the upload directory
        $uploadDir = "../../assets/images/"; // Adjust path as needed
        
        // Generate a unique name for the file before saving it
        $imageFileName = time() . '-' . $_FILES['ImageURL']['name']; 
        $uploadFilePath = $uploadDir . $imageFileName;
        
        // Move the file to your upload directory
        if (move_uploaded_file($_FILES['ImageURL']['tmp_name'], $uploadFilePath)) {
            // File upload succeeded
            $imageURL = $uploadFilePath; // Assuming you will save the path or URL to the database
        } else {
            // Handle failure
            echo "File upload failed.";
        }
    }

    // Insert into database
    $result = addProduct($Name, $Description, $Price, $StockQuantity, $categoryID, $imageURL);
    
    if ($result) {
        // Redirect or show a success message
        header("Location: inventory.php"); // Redirect to the inventory list
        exit;
    } else {
        // Show an error message
        echo "Error adding the product to the database.";
    }
}
?>
<html>
<head>
    <title>Add New Product</title>
    <link rel="stylesheet" href="../../assets/css/website.css">
     <!-- Include Header Component -->
     <?php include '../../components/Header/header.php'; ?>
<?php  error_reporting(E_ALL);
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

<form id="productForm" action="addProd.php" method="post" enctype="multipart/form-data">
<div class="container-pro">
        <!-- Input fields for product details -->
        <label for="productName" id="productNameLabel">Product Name:</label>
        <input type="text" id="productName" name="productName" required>
        <br>
        <label for="productDescription" id="productDescriptionLabel">Description:</label>
        <textarea id="productDescription" name="productDescription" required></textarea>
        <br>
        <label for="productPrice" id="productPriceLabel">Price:</label>
        <input type="number" id="productPrice" name="productPrice" required>
        <br>
        <label for="productStock" id="productStockLabel">Stock:</label>
        <input type="number" id="productStock" name="productStock" required>
        <br>
        <label for="productImage" id="productImageLabel">Product Image:</label>
        <input type="file" id="productImage" name="productImage" accept="image/*" required>
        <br>
        <label for="productCategory" id="productCategoryLabel">Category:</label>
        <select id="productCategory" name="productCategory" required>
            <?php
            // Fetch categories from the database
            $categories = getCategories(); // Assuming you have a function to retrieve categories
            
            // Loop through the categories and generate options
            foreach ($categories as $category) {
                echo '<option value="' . $category['CategoryID'] . '">' . $category['CategoryName'] . '</option>';
            }
            ?>
        </select>
        <!-- Add more fields as needed -->
        <input type="submit" id="addProductBtn" value="Add Product">
</div>

    </form>
</div>
</body>
</html>
