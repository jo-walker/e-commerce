//script ends the user session + redirects to the login page:

session_start();
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session
header("Location: sign.php");
exit;
