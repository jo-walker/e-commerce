<?php
session_start(); // Start the session at the beginning
require '..\..\..\database\connection.php'; // database config file

if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
    // Fetch user from the database
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $password = $_POST["password"]; // Password will be hashed, no need to sanitize
    
    // validation
    if (empty($name) || empty($password)) {
        // Consider redirecting back to the login page with an error message
        die("Please fill in all required fields.");
    } 

    $sql = "SELECT * FROM Users WHERE Username = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $name);

        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user["Password"])) {

            //storing necessary user info in the session
            // Check user is in correct role after successful login
            $_SESSION["user"] = [
                'id' => $user["UserID"], // store user id for further db operations 
                'username' => $user['Username'], 
                'role' => $user['Role']]; // store user role for role-based access control
                
                // Redirect to the home page
                header("Location: ../Home/index.php?status=success");
                exit();
                
            } else {
            $_SESSION['error'] = "Username or password is incorrect.";
            header("Location: sign.php");
            exit();
            }
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    $conn->close();
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Register/registcss.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <title>Sign In</title>
    <?php include '../../components/Header/header.php'; ?>
</head>
<body>

<?php if (isset($_SESSION['error'])): ?>
    <p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>

    <div class="container">
        <div class="header">
        </div>
    <form action="sign.php" method="post" id="signInForm">
        <h2>Sign In</h2>
        <div class="input-group">
            <label for="name">User Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" autocomplete="new-password" required>
        </div>
        <div class="input-group">
            <button type="submit" name="sign-in">Sign in</button>
        </div>
        <div class="input-group">
            <a href="../ForgotPassword/forgotpass.php">Forgot Password?</a>
        </div>
        <div class="have-account">
            <p>Don't have an account? <a href="../Register/register.php">Register here</a></p>
        </div>
    </form>
    <?php include '../../components/Footer/footer.html'; ?>
</body>
</html>