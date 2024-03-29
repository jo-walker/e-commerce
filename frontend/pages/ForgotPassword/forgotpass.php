<!-- sending a reset link via exif_thumbnail -->
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../../../../composer/vendor/autoload.php'; // Adjust path as needed

if (isset($_POST['reset-request-submit'])) {
    require '../../../database/connection.php'; // Adjust path as needed

    $userEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // // Check if email exists in the database
    // $sql = "SELECT * FROM Users WHERE Email = ?";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("s", $userEmail);
    // $stmt->execute();
    // $result = $stmt->get_result();
    // $user = $result->fetch_assoc();

    if (!$userEmail) {
        echo "No account found with that email.";
        exit;
    }

    // Initialize the PHPMailer object
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'bb1184aa9adc0f';
        $mail->Password = '942739c2f5da9e';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;

        //Recipients
        $mail->setFrom('noreply@lanewood.com', 'Lane Wood Mailer');
        $mail->addAddress($userEmail); // Add a recipient

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Reset your password';
        $mail->Body    = 'We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email. Here is your password reset link: http://localhost/e-commerce/frontend/pages/ForgotPassword/forgotpass.php?token=' . $token;

        $mail->send();
        echo 'Reset link sent to your email.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    } 
}    elseif (isset($_GET['token'])) {
        // If a token is present in the URL
        $token = $_GET['token'];
        echo "Token received: " . htmlspecialchars($token);
        // Logic to handle the token, e.g., showing a password reset form
    
    // Redirect or inform the user
    // Your existing logic for handling form submission...
    // After all operations (e.g., sending the email), you can redirect or inform the user:
    // header('Location: resetPass.php');
} else {
    // // This is a catch-all else, indicating the page was accessed without form submission or a token.
    // header('Location: forgotpass.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Register/registcss.css"> 
    <title>Forgot Password</title>
</head>
<body>
    <div class="container">
        
        <form action="forgotpass.php" method="post">
            <h2>Forgot Password</h2>
            <p>Please enter your email address. You will receive a link to create a new password via email.</p>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            
            <div class="input-group">
                <button type="submit" name="reset-request-submit">Send Reset Link</button>
            </div>
        </form>
    </div>
</body>
</html>