<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/website.css">
    <script src="../../index.js" defer></script>
    <script src="home.js" defer></script>
    <title>Luna Ashwood</title>
    <!-- Include Header Component -->
    <?php include '../../components/Header/header.php'; ?>
</head>
<body>
    <!-- Include Header Component -->
    <!-- <include src="../../components/Header/header.html"></include> -->
    <header id="header">
        <nav class="navbar">
            <div class="nav">
                <!-- Logo -->
                <div class="logo">
                <img src="../../assets/images/logo.png" alt="Logo of the website">
                </div>
                <a href="user.html" class="user" alt="user-Image"></a>
                <a href="cart.html" class="shopping-cart" alt="cart-Image"></a>
                <a href="wishlist.html" class="heart" alt="heart-Image"></a>
                <!-- Search Option  -->
                <div class="nav-items">
                    <div class="search">
                        <input type="text" class="search-box" placeholder="What are you looking for today?">
                        <button type="submit" class="search-btn">search</button>
                    </div>
                    <!-- Buttons -->
                </div>
                <a href="../Login/sign.html" class="Sign-up-button" role="buton">Sign-up</a>
                <a href="../Register/register.php" class="Register-button" role="button">Register</a>
            </div>
            </div>
        </nav>
    
        <!-- Navigation links -->
        <nav class="links">
            <ul class="links-container">
                <li class="link-item">
                    <a href="index.php" class="link">Home</a>
                </li>
                <li class="link-item"><a href="#" class="link">Featured</a></li>
                <li class="link-item"><a href="#" class="link">Sweaters</a></li>
                <li class="link-item"><a href="#" class="link">Clothing</a></li>
                <li class="link-item"><a href="#footer" class="link">About Us</a></li>
            </ul>
        </nav>
        <!-- Background div -->
        <div class="main-section">
            <div class="background">
                <p class="sub-heading"> Fashion that Inspires Confidence </p>
            </div>
        </header>
    <main>


        <!-- Product section -->
        <section class="product">
            <h2 class="product-category">Best selling items</h2>
            <hr id="hr">

            <!-- Button to bring it to the first product  -->
            <div class="pre-nxt-btn">
                <button class="pre-btn"><img src="../../assets/images/arrow.jpg" alt="pre-button"></button>
                <!-- Button to bring user to the next product -->
                <button class="nxt-btn"><img src="../../assets/images/arrow.jpg" alt="next-button"></button>
            </div>

            <!-- product cards -->
            <div class="product-container">
            <?php
                include '../../../database/queries.php'; // Make sure path is correct.
                $products = getProducts(); // Fetch all products.
                foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                    <span class="discount-tag">50% off</span> <!-- If applicable -->
                            <img src="<?php echo htmlspecialchars($product['ImagePath']); ?>" alt="Product Image" class="product-thumb">
                            <button class="card-btn">Wishlist</button>
                            <button class="cart-btn">Add to cart</button>
                        </div>
                        <div class="product-info">
                            <h2 class="product-brand"><?php echo htmlspecialchars($product['Brand']); ?></h2>
                            <p class="product-description"><?php echo htmlspecialchars($product['Description']); ?></p>
                            <span class="price">$<?php echo htmlspecialchars($product['Price']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
            <!-- Product cards using product-card.html-->
            <div class="product-container">
                <!-- Include Product Card -->
                <include src="../../components/Product/product-card.html"></include>
            </div>
        </section>
    </main>

    <!-- Include Footer Component -->
<?php include '../../components/Footer/footer.html'; ?>
</body>

</html>
