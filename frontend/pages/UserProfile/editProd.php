<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    require_once '..\..\..\database\connection.php';
    require_once '..\..\..\database\queries.php';
    require_once '..\..\..\database\utilities.php';
    // requireAdmin(); // Redirect non-admins to homepage or login page (utilities.php) 

// Fetch product details
$productID = isset($_GET['ProductID']) ? intval($_GET['ProductID']) : 0;
$product = getProductById($productID);
echo "ProductID: " . $productID;

$categories = getCategories();

// Check if the product exists
var_dump($_POST);
var_dump($_FILES);

// Process form data on POST request
if (isset($_POST['update_product'])) {
    $Name = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
    $Description = filter_input(INPUT_POST, 'productDescription', FILTER_SANITIZE_STRING);
    $Price = filter_input(INPUT_POST, 'productPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $StockQuantity = filter_input(INPUT_POST, 'productStock', FILTER_SANITIZE_NUMBER_INT);
    $CategoryID = filter_input(INPUT_POST, 'productCategory', FILTER_SANITIZE_NUMBER_INT);
    $ImageURL = null;

    // Handle file upload
    if (isset($_FILES['ImageURL']) && $_FILES['ImageURL']['error'] == UPLOAD_ERR_OK) {
        // Define the path to the upload directory
        $uploadDir = "../../assets/images/"; 
        
        // Generate a unique name for the file before saving it
        $imageFileName = "product_" . $productID . '-' . $_FILES['ImageURL']['name'];
        $uploadFilePath = $uploadDir . $imageFileName;

        if (file_exists($uploadFilePath)) {
            unlink($uploadFilePath); // Delete the old file
        }
        move_uploaded_file($_FILES['ImageURL']['tmp_name'], $uploadFilePath);
        
        // Move the file to your upload directory
        if (move_uploaded_file($_FILES['ImageURL']['tmp_name'], $uploadFilePath)) {
            // File upload succeeded
            $ImageURL = $uploadFilePath; // Assuming you will save the path or URL to the database
        } else {
            // Handle failure
            echo "File upload failed.";
        }
    }

    // Call the updateProduct function
    $updateProduct = updateProduct($productID, $Name, $Description, $Price, $StockQuantity, $CategoryID, $ImageURL);
    if ($updateProduct) {
        header('Location: inventory.php?message=' . urlencode('Product updated successfully.'));
        exit;
    } else {
        error_log("Update query failed: " . $conn->error);
        echo "Update query failed: " . $conn->error; // Only for debugging, remove or handle gracefully in production
    
        header('Location: editProd.php?productID=' . $productID . '&message=' . urlencode('Failed to update product.'));
        exit;
        
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
<form method="post" action="editProd.php?productID=<?php echo $productID; ?>" enctype="multipart/form-data">
    <!-- Updated form fields -->
    <label for="productName">Product Name:</label>
    <input type="text" name="productName" value="<?php echo htmlspecialchars($product['Name']); ?>">

    <label for="productDescription">Description:</label>
    <input type="text" name="productDescription" value="<?php echo htmlspecialchars($product['Description']); ?>">

    <label for="productPrice">Price:</label>
    <input type="number" name="productPrice" value="<?php echo htmlspecialchars($product['Price']); ?>">

    <label for="productStock">Stock:</label>
    <input type="number" name="productStock" value="<?php echo htmlspecialchars($product['StockQuantity']); ?>">

    <label for="ImageURL">Product Image:</label>
    <input type="file" id="ImageURL" name='ImageURL' accept="image/*" required>
    <img src="<?php echo $product['ImageURL']; ?>" alt="Product Image" style="max-width: 200px;">

    <label for="productCategory">Category:</label>
    <select name="productCategory">
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