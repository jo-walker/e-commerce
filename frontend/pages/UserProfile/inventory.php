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
?>

<html>
<head>
    <title>Inventory Management</title>
    <!-- Include necessary styles -->
    <link rel="stylesheet" href="../../assets/css/website.css">
    <script src="../../../backend/inventory.js"></script>
</head>
<body>
    <?php include '../../components/Header/header.php'; ?>

    <h1 class="manage">Inventory Management</h1>

    <div>
        <a href="addProd.php" class=""><button class="add-product-btn">Add New Product</button>
</a>
    </div>
    <div class="container-inventory">
    <table class="inventory">
        <thead>
            <tr>
                <th id="tr" class="photo-i">Photo</th>
                <th id="tr" class="title-i">Title</th>
                <th id="tr" class="description-i">Description</th>
                <th id="tr" class="cat-i">Category</th>
                <th id="tr" class="stock-i">In-Stock</th>
                <th id="tr" class="price-i">Price</th>
                <th id="tr" class="color-i">Color</th>
                <th id="tr" class="actions-i">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr id ="captions">
                <td><img src="<?php echo $product['ImageURL']; ?>" alt="<?php echo $product['Name']; ?>" style="width:50px;height:50px;"></td>
                <td><?php echo $product['Name']; ?></td>
                <td><?php echo $product['Description']; ?></td>
                <td ><?php echo $product['CategoryID']; ?></td>
                <td><?php echo $product['StockQuantity']; ?></td>
                <td><?php echo $product['Price']; ?></td>
                <td><?php echo $product['Color']; ?></td>
                <td>
                    <a href="editProd.php?ProductID=<?php echo $product['ProductID']; ?>" class="edit-b">Edit</a>
                    <a href="deleteProd.php?ProductID=<?php echo $product['ProductID']; ?>" class="dlt-b" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

<?php include '../../components/Footer/footer.html'; ?>
</body>
</html>
