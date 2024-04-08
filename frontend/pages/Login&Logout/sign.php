<?php
ob_start(); // Start output buffering
session_start(); // Start the session

require '..\..\..\database\connection.php'; // Database connection file

session_regenerate_id(true); // Regenerate session ID to prevent session fixation attacks

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $password = $_POST["password"]; // Assuming password sanitization/hashing occurs later

    // Simple validation
    if (empty($name) || empty($password)) {
        // Set error message and redirect back to the form
        $_SESSION['error'] = "Please fill in all required fields.";
        header("Location: sign.php");
        exit();
    }

    $sql = "SELECT * FROM Users WHERE Username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user["Password"])) {
            // Correct login
            $_SESSION['loggedin'] = true;
            $_SESSION["user"] = ['id' => $user["UserID"], 'username' => $user['Username'], 'role' => $user['Role']];
            header("Location: ../Home/index.php?status=success");
            exit();
        } else {
            // Login failed
            $_SESSION['error'] = "Username or password is incorrect.";
            header("Location: sign.php");
            exit();
        }
    } else {
        // Database error
        echo "Database error: " . $conn->error;
    }
    $conn->close();
}
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/website.css">
    <script src="..\..\..\backend\signinValidation.js" type="text/javascript" defer></script>
    <title>Sign In</title>
    <?php include '../../components/Header/header.php'; ?>
</head>
<body>
<?php if (isset($_SESSION['error'])): ?>
    <p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>
<div class="signForm">
    <form id="sign-in-form" action="sign.php" method="post">
        <div class="container">
        <h2 id ="head">Sign In</h2>
        <div class="input-group">
            <label for="name">User Name</label>
            <!-- <input type="text" name="name" id="name" > -->
            <input type="text" name="name" id="name" autocomplete="username">
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" autocomplete="password">
        </div>
        <div class="input-group">
            <button type="submit" id="hiddenSubmitButton" name="sign-in" >Sign in</button> 
            <!-- id="button-us" -->
        </div>
        <div class="input-group">
            <a href="../ForgotPassword/forgotpass.php" id="ForgotPassword" >Forgot Password?</a>
        </div>
        <div class="have-account">
            <p>Don't have an account? <a href="../Register/register.php" id ="regihere">Register here</a></p>
        </div>
        <?php if (isset($_SESSION['error'])): ?>
    <p class="error"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
    <?php unset($_SESSION['error']); // Clear the error message after displaying ?>
<?php endif; ?>

        </div>

    </form>
    <?php include '../../components/Footer/footer.html'; ?>

</body>
</html>