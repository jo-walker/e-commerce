<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="../Register/registcss.css"> 
</head>
<body data-page="userprof">

    <div class="up-profile-container">
        <div class="up-sidebar">
            <h2>User Profile</h2>
            <nav>
                <ul>
                    <li><a href="userprof.html">Personal Info</a></li>
                    <li><a href="../Home/index.html">Home</a></li>
                    <li><a href="../Cart/cart.html">Cart</a></li>
                    <li><a href="../Checkout/checkout.html">Checkout</a></li>
                </ul>
            </nav>
        </div>
        
        <div class="up-main-content">
            <div id="up-personal-info">
                <h3>Personal Info</h3>
                <p>Name: Jane Doe</p>
                <p>Email: jane.doe@example.com</p>
            </div>
           
            <div id="up-order-history">
                <h3>Order History</h3>
                <ul>
                    <li>Order #1234</li>
                    <li>Order #5678</li>
                    <li>Order #91011</li>
                </ul>
            </div>
            
            <div id="up-saved-addresses">
                <h3>Saved Addresses</h3>
                <ul>
                    <li>123 Main St, City, Country</li>
                    <li>456 Another St, City, Country</li>
                </ul>
            </div>
            
            <div id="up-payment-methods">
                <h3>Payment Methods</h3>
                <p>Visa ending in 1234</p>
                <p>Mastercard ending in 5678</p>
            </div>
            
            <div id="up-account-settings">
                <h3>Account Settings</h3>
                <p><a href="forgotpass.html">Change Password</a></p>
            </div>
        </div>
    </div>
    
</body>
</html>
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    $stmt = $conn->prepare("SELECT Name, Email FROM Users WHERE UserID = ?");
    $stmt->bind_param("i", $_SESSION['userid']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Display user details
        echo "Name: " . htmlspecialchars($user['Name']);
        // Further details
    }
} else {
    // Redirect to login page
}
