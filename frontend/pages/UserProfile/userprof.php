<?php
session_start();
require '../../../database/connection.php'; 

// Redirect to login page if user is not logged in
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header("Location: ../Login&Logout/sign.php");
    exit;

} $stmt = $conn->prepare("SELECT Username, Email FROM Users WHERE UserID = ?");
if (!$stmt) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

    $userID = $_SESSION['user'];

    $stmt = $conn->prepare("SELECT Username, Email FROM Users WHERE UserID = ?");
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
        // Further details
        
    }
    // Close statement and connection if you're done using them
    $stmt->close();
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="../Register/registcss.css"> 
    <link rel="stylesheet" href="../../assets/css/styles.css">
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
                <p>Username: <?php echo htmlspecialchars($user['Username']); ?></p>
                <p>Email: <?php echo htmlspecialchars($user['Email']); ?></p>
                <?php else: ?>
                <p>Unable to fetch user data.</p>
                <?php endif; ?>
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
            
            <div id="up-account-settings">
                <h3>Account Settings</h3>
                <p><a href="../ForgotPassword/forgotpass.php">Change Password</a></p>
            </div>
        </div>
    </div>
    
</body>
</html>