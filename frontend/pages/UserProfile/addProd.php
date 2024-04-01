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
</head>
<body>
    <form action="addProd.php" method="post" enctype="multipart/form-data">
        <!-- Input fields for product details -->
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required>
        <br>
        <label for="productDescription">Description:</label>
        <textarea id="productDescription" name="productDescription" required></textarea>
        <br>
        <label for="productPrice">Price:</label>
        <input type="number" id="productPrice" name="productPrice" required>
        <br>
        <label for="productStock">Stock:</label>
        <input type="number" id="productStock" name="productStock" required>
        <br>
        <label for="productImage">Product Image:</label>
        <input type="file" id="productImage" name="productImage" accept="image/*" required>
        <br>
        <label for="productCategory">Category:</label>
        <select id="productCategory" name="productCategory" required>
            <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['CategoryID']; ?>"><?php echo $category['CategoryName']; ?></option>
            <?php endforeach; ?>
        </select>
        <!-- Add more fields as needed -->

        <input type="submit" value="Add Product">
    </form>
</body>
</html>
