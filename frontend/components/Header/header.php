<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}require '..\..\..\database\connection.php'; // database config file

?>
<header id="header">
    <nav class="navbar">
        <div class="nav">
            <!-- Logo -->
            <div class="logo">
                <img src="../../assets/images/logo.png" alt="Logo of the website">
            </div>
            <a href="../UserProfile/userprof.php" class="user" alt="user-Image"></a>
            <a href="cart.html" class="shopping-cart" alt="cart-Image"></a>
            <a href="wishlist.html" class="heart" alt="heart-Image"></a>
            <!-- Search Option -->
            <div class="nav-items">
                <form action="..\..\pages\SearchResult\searchResult.php" method="get" class="search"> <!--to include the form tags for search -->
                    <input type="text" class="search-box" placeholder="What are you looking for today?" name="searchTerm">
                    <button type="submit" class="search-btn" id="search-btn">search</button>
                </form>
                <!-- Buttons -->
            </div>
             <!-- Check if user is logged in or not to display the buttons  -->
            <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
                <a href="../../pages/Login&Logout/sign.php" class="Sign-up-button">Sign-in</a>
                <a href="../../pages/Register/register.php" class="Register-button">Register</a>
            <?php else: ?>
                <a href="../../pages/Login&Logout/logout.php" class="Sign-up-button">Logout</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Navigation links -->
    <nav class="links">
        <ul class="links-container">
            <li class="link-item">
                <a href="../../pages/Home/index.php" class="link">Home</a>
            </li>
            <li class="link-item"><a href="../../pages/Home/index.php?view=categories" class="link">All Categories</a></li>
            <li class="link-item"><a href="../../pages/Home/index.php?view=products" class="link">All Products</a></li>
            <li class="link-item"><a href="#footer" class="link">About Us</a></li>
        </ul>
    </nav>
</header>