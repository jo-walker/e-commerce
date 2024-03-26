<!DOCTYPE html>
<html>
<head>
    <title>Page Not Found</title>
    <link rel="stylesheet" href="notFound.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
<?php include("../../components/Header/header.php"); ?>
    <h1>404!</h1>
    <p>We couldn't find the page :(( <br> <br>
                <span>Try searching instead :))</span></p>
    <input id="notfoundsearch" type="text" name="search" placeholder="Search...">
    <br>
    <hr> <!-- Add a horizontal line here -->
    <p>Alternatively, you can start browsing from the options below:</p>
    <!-- list the products here -->
    <?php include("../../components/Footer/footer.php"); ?>
</body>
</html>