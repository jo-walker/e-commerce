<?php
session_start();

if ($_SESSION["user"]["role"] != "admin") {
    header('Location: ../../pages/Login&Logout/sign.php'); // or show an unauthorized access message
    exit;
}
require '../../../database/connection.php';

// Admin-specific functionality goes here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/website.css">
</head>
<body>
    <?php include '../Header/header.php'; ?>
    <main>
        <section id="overview">
            <!-- Inventory Overview Dashboard -->
            <!-- Purpose: Provides a quick overview or dashboard summary of inventory statistics (e.g., total items, categories, items low in stock).
            Design Elements: Graphs, charts, and counters to visually represent the inventory data. -->
            <h2>Inventory Overview</h2>
            <!-- Placeholder for dynamic dashboard content -->
            <p>Dashboard content here...</p>
        </section>
        
        <section id="search-filter">
            <!-- Search and Filter Form -->
            <!-- Purpose: Allows admins to quickly find items using search criteria (e.g., name, category, stock status).
            Design Elements: Search bar, dropdown filters for categories, stock levels, etc.     -->
            <h2>Search and Filter</h2>
            <form method="POST">
                <input type="text" name="searchQuery" placeholder="Search...">
                <label for="category">Category:</label>
                <select name="category">
                    <option value="">Select Category</option>
                    <!-- Dynamically populate categories -->
                    <option value="category1">Category 1</option>
                    <option value="category2">Category 2</option>
                    <option value="category3">Category 3</option>
                    
                </select>
                <button type="submit">Search</button>
            </form>

        </section>

        <section id="inventory-list">
            <!-- List of Inventory Items -->
            <!-- Purpose: Displays a list of all inventory items with essential details (e.g., item name, category, quantity, price).
            Design Elements: Table format with columns for each relevant detail. Consider pagination or infinite scrolling for long lists. -->
            <h2>Inventory List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamically populate inventory items -->
                </tbody>
            </table>
        </section>

        <!-- Add/Edit Item Modal or Form
        Purpose: Allows admins to add new items or edit existing items in the inventory.
        Design Elements: A modal or separate page with a form to input item details such as name, category, price, quantity, and a description. Include file upload functionality for item images.

        Purpose: Provides the ability to perform actions on individual or selected group of items.
        Design Elements: Buttons or links for actions like Edit, Delete, and Add to the inventory. Use icons for a cleaner look. -->

    </main>

    <?php include '../Footer/footer.html'; ?>
</body>
</html>
