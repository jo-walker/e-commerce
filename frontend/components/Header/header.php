<!-- header.php -->
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
                <form action="..\../pages\SearchResult\searchResult.php" method="get" class="search"> <!-- Make sure to include the form tags for search -->
                    <input type="text" class="search-box" placeholder="What are you looking for today?" name="searchTerm">
                    <button type="submit" class="search-btn">search</button>
                </form>
                <!-- Buttons -->
            </div>
            <a href="../../pages/Login&Logout/sign.php" class="Sign-up-button">Sign-in</a> <!-- Buttons should have an anchor tag -->
            <a href="../../pages/Register/register.php" class="Register-button">Register</a>
        </div>
    </nav>

    <!-- Navigation links -->
    <nav class="links">
        <ul class="links-container">
            <li class="link-item">
                <a href="../../pages/Home/index.php" class="link">Home</a>
            </li>
            <li class="link-item"><a href="#" class="link">Featured</a></li>
            <li class="link-item"><a href="#" class="link">Sweaters</a></li>
            <li class="link-item"><a href="#" class="link">Clothing</a></li>
            <li class="link-item"><a href="#footer" class="link">About Us</a></li>
        </ul>
    </nav>
</header>