<!-- Define functions or classes to handle database queries. -->
<?php

// Include the database connection
include 'connection.php';

// database queries as a customer
// retrieve all products
function getProducts() {
    global $conn;
    $sql = "SELECT * FROM Products";
    $result = $conn->query($sql);
    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        error_log("Database query failed: " . $conn->error); // Log error to PHP error log
        return []; // Return an empty array as a safe default
    }
}

// retrieve a single product by id
function getProductById($id) {
    global $conn;
    $sql = "SELECT * FROM products WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Error handling: Prepare failed
        return null;
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($product = $result->fetch_assoc()) {
        return $product;
    } else {
        return null; // Return null if no product is found
    }}

// Function to generate HTML for a single product
function displayProduct($productID) {
    $product = getProductById($productID);
    if ($product) {
        //  'product-details.php' is  product details page -> it expects a 'productID' query parameter.
        $productDetailsUrl = "product-details.php?productID=" . htmlspecialchars($productID);

        $html = '<a href="' . $productDetailsUrl . '" class="product-card-link">';

        $html = '<div class="product-card">';
        $html .= '<div class="product-image">';
        $html .= '<img src="' . htmlspecialchars($product['ImagePath']) . '" alt="' . htmlspecialchars($product['Name']) . '">';
        $html .= '</div>'; // Close product-image
        $html .= '<div class="product-info">';
        $html .= '<h3>' . htmlspecialchars($product['Name']) . '</h3>';
        $html .= '<p>' . htmlspecialchars($product['Description']) . '</p>';
        $html .= '<p>Price: $' . htmlspecialchars($product['Price']) . '</p>';
        $html .= '<p>Stock: ' . htmlspecialchars($product['StockQuantity']) . '</p>';
        $html .= '<p>Category: ' . htmlspecialchars($product['CategoryID']) . '</p>';
        $html .= '</div>'; // Close product-info
        $html .= '</div>'; // Close product-card
        $html .= '</a>'; // Close product-card-link

        return $html;
    } else {
        return '<p>Product not found.</p>';
    }
}

// search for products by name or description
function searchProducts($searchTerm) {
    global $conn;
    $searchTerm = '%' . $searchTerm . '%';
    $sql = "SELECT * FROM Products WHERE Name LIKE ? OR Description LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $searchTerm, $searchTerm); // 'ss' denotes two string parameters
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// filter products by category
function filterProducts($categoryID) {
    global $conn;
    $sql = "SELECT * FROM Products WHERE CategoryID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoryID); // CategoryID is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// view details of a product
function viewProduct($productID) {
    global $conn;
    $sql = "SELECT * FROM Products WHERE ProductID = $productID";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// both admin and customer queries
// list all categories for filtering (clientside) or editing (admin)
function getCategories() {
    global $conn;
    $sql = "SELECT * FROM Categories";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
function getCategoriesFilter() {
    global $conn;
    // Adjusted SQL to join with the categories table and fetch distinct category names
    $sql = "SELECT DISTINCT c.CategoryName 
            FROM products p
            JOIN categories c ON p.categoryID = c.CategoryID 
            ORDER BY c.CategoryName";
    
    $result = $conn->query($sql);
    if ($result === false) {
        // Adding error handling to provide more insight in case of a query failure
        die("Error executing query: " . $conn->error);
    }
    
    $categories = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['CategoryName']; // Fetching the category name
    }
    return $categories;
}

//get all colors
function getColorOptions() {
    global $conn;
    $sql = "SELECT DISTINCT color FROM products ORDER BY color";
    $result = $conn->query($sql);
    $colors = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $colors[] = $row['color'];
    }
    return $colors;
}
// search products with filters (category, price range, color)
function searchProductsFiltered($searchTerm, $category = '', $minPrice = '', $maxPrice = '', $color = '') {
    global $conn;
    
    // Start the SQL query
    $sql = "SELECT * FROM products WHERE Name LIKE ?";

    // Initialize an array to hold parameters for the prepared statement
    $params = ["%$searchTerm%"];
    $types = "s"; // Types of the parameters: s = string

    // Add conditions based on the filters
    if (!empty($category)) {
        $sql .= " AND categoryID = ?";
        $params[] = $category;
        $types .= "s"; // Assuming categoryID is a string; change if it's an integer
    }
    if (!empty($minPrice)) {
        $sql .= " AND Price >= ?";
        $params[] = $minPrice;
        $types .= "d"; // d = double (floating point numbers)
    }
    if (!empty($maxPrice)) {
        $sql .= " AND Price <= ?";
        $params[] = $maxPrice;
        $types .= "d";
    }
    if (!empty($color)) {
        $sql .= " AND color = ?";
        $params[] = $color;
        $types .= "s";
    }

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Dynamically bind parameters
    $stmt->bind_param($types, ...$params);

    $stmt->execute();
    $result = $stmt->get_result();
    
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    $stmt->close();

    return $products;
}

// add a new user
function addUser($name, $password, $email, $role) {
    global $conn;
    $sql = "INSERT INTO Users (Username, Password, Email, Role)
    VALUES ('$name', '$password', '$email', '$role')";
    $result = $conn->query($sql);
    return $result;
}
// update an existing user information
function updateUser($userID, $name, $password, $email, $role) {
    global $conn;
    $sql = "UPDATE Users
    SET Username = '$name', Password = '$password', Email = '$email', Role = '$role'
    WHERE UserID = $userID";
    $result = $conn->query($sql);
    return $result;
}
// delete a user
function deleteUser($userID) {
    global $conn;
    $sql = "DELETE FROM Users WHERE UserID = $userID";
    $result = $conn->query($sql);
    return $result;
}
// database queries as an admin

// add a new product
function addProduct($name, $description, $price, $stockQuantity, $categoryID, $imageURL, $color) {
    global $conn;  
    $result = false; 
    $conn->autocommit(FALSE); // Turn off auto-commit to manage transactions manually

    try {
        // prepare the sql statement
        $sql = "INSERT INTO Products (Name, Description, Price, StockQuantity, CategoryID, ImageURL, Color)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception($conn->error);
        }

        // bind the parameters and execute the statement
        $stmt->bind_param("ssdiss", $name, $description, $price, $stockQuantity, $categoryID, $imageURL, $color);

        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception("Execute error: " . $stmt->error);
        }

        // Commit the transaction
        if (!$conn->commit()) {
            throw new Exception("Commit failed: " . $conn->error);
        }
        $result = true; // Indicate success
        echo "Product added successfully."; // Feedback
    } catch (Exception $e) {
        $conn->rollback(); // Roll back the transaction on error
        error_log($e->getMessage()); // Log the error
        echo "Error adding the product: " . $e->getMessage(); // Provide error feedback
    } finally {
        $stmt->close(); // Ensure the statement is closed
        $conn->autocommit(TRUE); // Turn auto-commit back on
    }
    
    return $result; // Return true on success, false on failure
}

// update an existing product
function updateProduct($ProductID, $Name, $Description, $Price, $StockQuantity, $CategoryID, $ImageURL, $Color) {
    global $conn;
    $sql = "UPDATE Products SET Name = ?, Description = ?, Price = ?, StockQuantity = ?, CategoryID = ?, ImageURL = ? , Color = ? WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Error handling
        error_log("Prepare failed: " . $conn->error);
        return false;
    }
    if (!$stmt->bind_param("ssdisssi", $Name, $Description, $Price, $StockQuantity, $CategoryID, $ImageURL, $Color, $ProductID)) {
        // Error handling
        error_log("Bind failed: " . $stmt->error);
        return false;
    }
    if (!$stmt->execute()) {
        // Error handling
        error_log("Execute failed: " . $stmt->error);
        return false;
    }
    $stmt->close();
    return true;
}



// update stock fcn
function updateStock($productID, $newStock) {
    global $conn;
    $sql = "UPDATE Products SET StockQuantity = ? WHERE ProductID = ?";
    $stmt = $conn->prepare($sql); // Prepare the SQL statement for execution 
    if ($stmt) { // Check if the statement was prepared successfully 
        $stmt->bind_param("ii", $newStock, $productID); // Bind the parameters to the SQL statement 
        return $stmt->execute(); // Execute the SQL statement if the parameters were bound successfully
    } else {
        return false;
    }
}
// update price fcn
function updatePrice($productID, $newPrice) {
    global $conn;
    $sql = "UPDATE Products SET Price = ? WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $newPrice, $productID);
    if (!$stmt->execute()) {
        return false;
    }
    return true;
}

// delete a product
function deleteProduct($productID) {
    global $conn;
    $sql = "DELETE FROM Products WHERE ProductID = $productID";
    $result = $conn->query($sql);
    return $result;
}

// query to join the products and categories tables
function join_product_table(){
    global $conn;
    $sql = "SELECT p.ProductID, p.Name, p.Description, p.Price, p.StockQuantity, p.CategoryID, p.ImageURL, 
    c.CategoryName AS categoryName 
    FROM products p 
    LEFT JOIN categories c 
    ON c.CategoryID = p.CategoryID 
    ORDER BY p.ProductID ASC";

    $conn->query($sql);
    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if(!$result) {
        // Handle error - notify the administrator, log to a file, show an error screen, etc.
        die("SQL error: " . $conn->error);
    }
    
    // Fetch all rows as an associative array
    $products = $result->fetch_all(MYSQLI_ASSOC);
    
    return $products;
  }
?>