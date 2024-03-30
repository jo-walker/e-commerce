<?php
ob_start(); // Start output buffering

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require '..\..\..\database\connection.php'; // database config file
require '..\..\..\database\queries.php'; // database queries file
require 'deleteAccount.php'; // delete account file

$stmt = $conn->prepare("SELECT Username, Email, CreatedAt, LastLogin FROM Users WHERE UserID = ?");
if (!$stmt) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

$userID = $_SESSION['user']['id'];

$stmt = $conn->prepare("SELECT Username, Email, CreatedAt, LastLogin FROM Users WHERE UserID = ?");
error_reporting(E_ALL);
ini_set("display_errors", 1);
$stmt->bind_param("i", $userID);

$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    // Display user details
    echo "Username: " . htmlspecialchars($user['Username']);
    echo "Email: " . htmlspecialchars($user['Email']);
    echo "CreatedAt: " . htmlspecialchars($user['CreatedAt']);
    echo "Last login: " . htmlspecialchars($user['LastLogin']);
    echo '<a href="../ForgotPassword/forgotpass.php">Change Password</a>';
    // Further details might be added here
}

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-info'])) {
    // Assume $conn is your database connection from the connection.php file
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Validate inputs...
    if (empty($username) || empty($email)) {
        die("Please fill in all required fields.");
    }
    
    // Prepare SQL statement
    $updateStmt = $conn->prepare("UPDATE Users SET Username = ?, Email = ? WHERE UserID = ?");
    $updateStmt->bind_param("ssi", $username, $email, $userID);

    // Delete account
    // if (isset($_POST['delete-account'])) {
    //     $deleteStmt = $conn->prepare("DELETE FROM Users WHERE UserID = ?");
    //     $deleteStmt->bind_param("i", $userID);
    //     if ($deleteStmt->execute()) {
    //         echo "Account deleted successfully.";
    //         // Redirect to the home page
    //         header("Location: ../Home/index.php");
    //         exit();
    //     } else {
    //         echo "Error deleting account: " . $conn->error;
    //     }
    //     $deleteStmt->close();
    // }

    // Execute and check if successful
    if ($updateStmt->execute()) {
        echo "Information updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    $updateStmt->close();
}

// Close statement and connection if you're done using them
$stmt->close();
$conn->close();
ob_end_clean(); // Clean the output buffer
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="../Register/registcss.css"> 
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/website.css">
</head>
<?php include '../../components/Header/header.php';?>
<body data-page="userprof">

    <div class="up-profile-container">
        <div class="up-sidebar">
            <h2>User Profile</h2>
            <nav>
                <ul>
                    <li><a href="userprof.php">Personal Info</a></li>
                    <li><a href="../Home/index.php">Home</a></li>
                    <li><a href="../Cart/cart.html">Cart</a></li>
                    <li><a href="../Checkout/checkout.html">Checkout</a></li>
                </ul>
            </nav>
        </div>
        
        <div class="up-main-content">
            <div id="up-personal-info">
                <h3>Personal Info</h3>
                <?php if ($user): ?>
                <p>Username: <span id="display-username"><?php echo htmlspecialchars($user['Username']); ?></span></p>
                <p>Email: <span id="display-email"><?php echo htmlspecialchars($user['Email']); ?></span></p>
                <p>Created At: <?php echo htmlspecialchars($user['CreatedAt']); ?></p>
                <p>Last Login: <?php echo htmlspecialchars($user['LastLogin']); ?></p>
                
                <?php else: ?>
                <p>Unable to fetch user data.</p>
                <?php endif; ?>

                <button id="edit-info-btn">Edit</button>

            </div>

            <!-- Hidden form for editing user info -->
            <div id="edit-personal-info" style="display: none;">
                <h3>Edit Personal Info</h3>
                <div class="info-form">
                <form id="edit-info-form" method="POST" action="userprof.php">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['Username']); ?>" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
                    
                    <button type="submit" name="update-info">Update Info</button>

                    <!-- change password -->
                    <label for="password">Change Password:</label>
                    <p><a href="../ForgotPassword/forgotpass.php">Change Password</a></p>

                    <!-- Delete Account Button -->
                    <form action="deleteAccount.php" method="post" onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
    <input type="hidden" name="userID" value="<?php echo htmlspecialchars($userID); ?>">
    <button type="submit" name="delete-account">Delete Account</button>
</form>

                    <button type="button" id="cancel-edit-btn">Cancel</button>
                </form>
                </div>
            </div>
            <div id="up-order-history">
                <h3>Order History</h3>
                <!-- dummy order data -->
                <ul>
                    <li>Order #1234</li>
                    <li>Order #5678</li>
                    <li>Order #91011</li>
                </ul>
            </div>
            
            <div id="up-saved-addresses">
                <h3>Saved Addresses</h3>
                <!-- dummy address data -->
                <ul>
                    <li>123 Main St, City, Country</li>
                    <li>456 Another St, City, Country</li>
                </ul>
            </div>
            
            <div id="up-payment-methods">
                <h3>Payment Methods</h3>
                <!-- dummy payment data -->
                <p>Visa ending in 1234</p>
                <p>Mastercard ending in 5678</p>
            </div>            
        </div>
    </div>
    <script>
        // JavaScript for toggling the edit form
        document.getElementById('edit-info-btn').addEventListener('click', function() {
            // Copy display info to form inputs
            document.getElementById('username').value = document.getElementById('display-username').textContent;
            document.getElementById('email').value = document.getElementById('display-email').textContent;
            // ... copy other info ...

            // Toggle display visibility 
            document.getElementById('up-personal-info').style.display = 'none';
            document.getElementById('edit-personal-info').style.display = 'block';
        });


        document.getElementById('cancel-edit-btn').addEventListener('click', function() {
            document.getElementById('edit-personal-info').style.display = 'none'; // Hide edit form
            document.getElementById('up-personal-info').style.display = 'block'; // Show display div
        });
        
    </script>
</body>
</html>