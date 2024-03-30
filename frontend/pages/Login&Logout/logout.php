<?php 
// Turn on error reporting for debugging purposes
error_reporting(E_ALL); // Report all PHP errors 
ini_set('display_errors', 1); // Display all PHP errors

echo "Logging out...<br>";
// session_start, session_unset, session_destroy, and redirect commands follow

session_start(); // Start the session to access session variables 
unset($_SESSION['user']); // Remove the user session variable to log out
// session_unset(); // Remove all session variables to log out
session_regenerate_id(true); // Generate a new session ID to prevent session fixation attacks 

// Unset all of the session variables. 
if (ini_get("session.use_cookies")) { // Check if cookies are used in the session 
    $params = session_get_cookie_params(); // Get the session cookie parameters 
    setcookie(session_name(), '', time() - 42000, // Set the session cookie to expire in the past 
        $params["path"], $params["domain"], // Set the cookie parameters for the session cookie 
        $params["secure"], $params["httponly"] // Set the cookie parameters for security
    );
}

session_destroy(); // Destroy the session to log out 
header("Location: ../Home/index.php"); // Redirect to the home page after logging out 
exit;
?>