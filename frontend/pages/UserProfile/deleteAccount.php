<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require '../../../database/connection.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_POST['delete-account'])) {
    // Redirect to login or error page if user is not logged in or if delete request is not set
    header("Location: ../Login&Logout/login.php");
    // Perform necessary actions before deleting the user's account
    // e.g., deleting user-generated content, logging out the user, etc.

    $userID = $_SESSION['user']['id']; // Use the user ID from the session

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM Users WHERE UserID = ?");
    $stmt->bind_param("i", $userID);

    // Execute and check if successful
    if ($stmt->execute()) {
        echo "Account deleted successfully.";

        // Perform post-deletion cleanup
        $_SESSION['loggedin'] = false; // Set the session status to logged out
        unset($_SESSION['user']); // Remove the user session variable
        session_destroy(); // Destroy the session
        // Redirect to the home page or login page
        header("Location: ../Home/index.php");
        exit;
    } else {
        echo "Error deleting account: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>
