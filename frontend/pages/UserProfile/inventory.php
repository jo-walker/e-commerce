<?php

// adding new products, updating existing ones, and deleting products from the inventory.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Check if there's a message set
if (isset($_SESSION['message'])) {
    echo "<p>{$_SESSION['message']}</p>"; // Display the message
    echo "<script>setTimeout(() => { document.querySelector('p').remove(); }, 3000);</script>"; // Remove the message after 3 seconds
    echo "<div>" . htmlspecialchars($_GET['message']) . "</div>";
    unset($_SESSION['message']); // Clear the message
}

// Include admin check
require_once '..\..\..\database\connection.php';
require_once '..\..\..\database\utilities.php';
require_once '..\..\..\database\queries.php';

requireAdmin(); // Redirect non-admins to homepage or login page (utilities.php)

$products = join_product_table(); // to fetch all products as a table join with categories
$categories = getCategories(); // to fetch all categories
$products = getProducts(); // to fetch all products

// // Check for AJAX request to fetch product details
// if (isset($_GET['action']) && $_GET['action'] == 'fetchDetails' && isset($_GET['productId'])) {
//     header('Content-Type: application/json');
//     $productId = intval($_GET['productId']);
//     $productDetails = getProductById($productId);
//     if ($productDetails) {
//         // Optionally, include categories in the response if needed for a dropdown, etc.
//         $productDetails['categories'] = getCategories();
//         echo json_encode(['success' => true, 'product' => $productDetails]);
//     } else {
//         echo json_encode(['success' => false, 'error' => 'Product not found']);
//     }
//     exit; // Important to prevent the rest of the script from executing on an AJAX call
// }


// update stock
// if (isset($_POST['update-stock'])) {
//     // Gather and sanitize form data
//     $productID = filter_input(INPUT_POST, 'product-id', FILTER_SANITIZE_NUMBER_INT);
//     $newStock = filter_input(INPUT_POST, 'new-stock', FILTER_SANITIZE_NUMBER_INT);

//     // Call the function to update stock
//     try {
//         $result = updateStock($productID, $newStock);
//         if (!$result) {
//             throw new Exception("Failed to update stock. Please check your input and try again.");
//         }
//         echo "Stock updated successfully.";
//     } catch (Exception $e) {
//         echo "Error updating product: " . htmlspecialchars($e->getMessage());
//     }
// }
// // update price
// if(isset($_GET['productId'])) {
//     $productId = $_GET['productId'];
//     // Sanitize your input
//     $productId = filter_var($productId, FILTER_SANITIZE_NUMBER_INT);

//     // Prepare your query
//     $query = "SELECT * FROM Products WHERE ProductID = ?";
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param('i', $productId);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     $product = $result->fetch_assoc();

//     if($product) {
//         // Assume you also get categories to allow category selection
//         $categoriesQuery = "SELECT CategoryID, CategoryName FROM Categories";
//         $categoriesResult = $conn->query($categoriesQuery);
//         $categories = $categoriesResult->fetch_all(MYSQLI_ASSOC);

//         // Include category details in the response
//         $product['categories'] = $categories;

//         // Make sure to set header as JSON
//         header('Content-Type: application/json');
//         echo json_encode($product);
//     } else {
//         echo json_encode(['error' => 'Product not found']);
//     }
// } else {
//     echo json_encode(['error' => 'No product ID provided']);
// }
// if (isset($_POST['update-price'])) {
//     // Gather and sanitize form data
//     $productID = filter_input(INPUT_POST, 'product-id', FILTER_SANITIZE_NUMBER_INT);
//     $newPrice = filter_input(INPUT_POST, 'new-price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

//     // Call the function to update price
//     try {
//         $result = updatePrice($productID, $newPrice);
//         if (!$result) {
//             throw new Exception("Failed to update price. Please check your input and try again.");
   
//         }
//         echo "Price updated successfully.";
//     } catch (Exception $e) {
//         echo "Error updating product: " . htmlspecialchars($e->getMessage());
//     }
// }

// delete product
// if (isset($_POST['delete_selected_products'])) {
//     $selectedProductIDs = $_POST['delete_product_ids'] ?? [];
//     if (!empty($selectedProductIDs)) {
//         $query = "DELETE FROM Products WHERE ProductID = ?";
//         $stmt = $conn->prepare($query);
//         foreach ($selectedProductIDs as $productID) {
//             $stmt->bind_param('i', $productID);
//             $stmt->execute();
//         }
//         // Optionally, add a success message or redirect
//         echo "Selected products deleted successfully.";
//         // header('Location: inventory.php');
//     } else {
//         echo "No products selected for deletion.";
//     }
// }
?>

<html>
<head>
    <title>Inventory Management</title>
    <!-- Include necessary styles -->
    <link rel="stylesheet" href="../../assets/css/website.css">
    <script src="inventory.js"></script>
</head>
<body>
    <?php include '../../components/Header/header.php'; ?>

    <h1>Inventory Management</h1>

    <div>
        <a href="addProd.php" class="">Add New Product</a>
    </div>
    <table class="">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Product Title</th>
                <th>Category</th>
                <th>In-Stock</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><img src="<?php echo $product['ImageURL']; ?>" alt="<?php echo $product['Name']; ?>" style="width:50px;height:50px;"></td>
                <td><?php echo $product['Name']; ?></td>
                <td><?php echo $product['Description']; ?></td>
                <td><?php echo $product['CategoryID']; ?></td>
                <td><?php echo $product['StockQuantity']; ?></td>
                <td><?php echo $product['Price']; ?></td>
                <td>
                    <a href="editProd.php?ProductID=<?php echo $product['ProductID']; ?>" class="">Edit</a>
                    <a href="deleteProd.php?ProductID=<?php echo $product['ProductID']; ?>" class="" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php include '../../components/Footer/footer.html'; ?>
</body>
</html>
