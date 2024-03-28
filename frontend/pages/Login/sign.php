<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Register/registcss.css"> 
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/website.css">
    <title>Sign In</title>
    <?php include '../../components/Header/header.php'; ?>
</head>
<body>
    <form action="signin.php" type="post">
    <h2>Sign In</h2>
        <div class="input-group">
            <label for="name">User Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
       
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        
        <div class="input-group">
            <button type="submit" name="sign-in">Sign in</button>
        </div>

        <div class="input-group">
            <a href="../ForgotPassword/forgotpass.html">Forgot Password?</a>
        </div>
    </form>

    <?php include '../../components/Footer/footer.html'; ?>
</body>
</html>