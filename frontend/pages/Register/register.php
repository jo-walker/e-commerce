<!DOCTYPE html
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="registcss.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/website.css">
    <title>Registration Form</title>
    <?php include '../../components/Header/header.php'; ?>
</head>
<body>
    <form action="register.php" method="post" id="registrationForm">
        <h2>User Registration</h2>
        <div class="input-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="input-group">
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" name="confirm-password" id="confirm-password" required>
        </div>
        <div class="input-group">
            <label>Gender:</label>
            <input type="radio" name="gender" value="Male" id="male" required> Male
            <input type="radio" name="gender" value="Female" id="female"> Female
        </div>
        <div class="input-group">
            <button type="submit" name="register">Register</button>
        </div>
        <div class="have-account">
            <p>Already have an Account ?<a href="../Login/sign.html"> Sign in</a></p>
        </div>

    </form>
    
</body>
</html>