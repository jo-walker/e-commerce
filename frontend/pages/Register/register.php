<?php
// Start by including the database configuration file
require '..\..\..\database\connection.php'; // database config file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"]; // Password will be hashed, no need to sanitize
    $confirmPassword = $_POST["confirm-password"];

    // Basic validation
    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        die("Please fill in all required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    if ($password !== $confirmPassword) {
        die("Passwords do not match.");
    }

    // Hash the password - never store plain text passwords
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute SQL statement - use placeholders to prevent SQL injection
    $sql = "INSERT INTO Users (Username, Email, Password) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Success! Redirect to login page, or a success message page
            header("Location: ../Login&Logout/sign.php?status=success"); // redirection URL
            exit();
        } else {
            // Check for duplicate entry or other errors
            if ($conn->errno == 1062) { // 1062 is the error code for duplicate entry
                echo "This email is already registered.";
            } else {
                echo "Error: " . $conn->error;
            }
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/website.css">
    <title>Registration Form</title>
    <?php include '../../components/Header/header.php'; ?>
    <?php include '../../../database/connection.php'; ?>
</head>
<body>
    <div id="background-2">
    <form action="register.php" method="post" id="registrationForm">
        
        <div class="container2">
        <h2 id="head">User Registration</h2>
        <div class="input-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" autocomplete="new-password" required>
        </div>
        <div class="input-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" name="confirm-password" id="confirm-password" autocomplete="new-password" required>
        </div>
        <div class="input-group">
            <button type="submit" name="register" id="button-us">Register</button>
        </div>
        <div class="have-account">
            <p>Already have an Account ?<a href="../Login&Logout/sign.php" id="regihere"> Sign in</a></p>
        </div>
        </div>

    </form>
    <?php include '../../components/Footer/footer.html'; ?>
 </div>
</body>
</html>
