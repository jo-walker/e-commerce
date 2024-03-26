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
                <button type="submit" class="Sign-up-button" role="button">Sign-up</button>
                <button type="submit" class="Register-button" role="button">Register</button>
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
            <h2 class="product-category">Best selling items
                <hr id="hr">
            </h2>

            <!-- Button to bring it to the first product  -->
            <div class="pre-nxt-btn">
                <button class="pre-btn"><img src="../../assets/images/arrow.jpg" alt="pre-button"></button>
                <!-- Button to bring user to the next product -->
                <button class="nxt-btn"><img src="../../assets/images/arrow.jpg" alt="next-button"></button>
            </div>
            <!-- Product cards
   <main>
        <section class="product">
            <h2 class="product-category">Best selling
                <hr id="hr">
            </h2>

            <!-- Button to bring it to the first product  -->
            <div class="pre-nxt-btn">

                <button class="pre-btn"><img src="../../assets/images/arrow.jpg" alt="pre-button"></button>
                <!-- Button to bring user to the next product -->
                <button class="nxt-btn"><img src="../../assets/images/arrow.jpg" alt="next-button"></button>
            </div>
            <!-- product cards -->
            <div class="product-container">
                <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">50% off</span>
                        <img src="../../assets/images/card1.png" class="product-thumb" alt="picture">
                        <button class="card-btn">Whislist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>

                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">American Eagle</h2>
                        <p class="description">A cozy sweatshirt perfect for chilly evenings.</p>
                        <span class="price">$20</span><span class="actual-price">$40</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">50% off</span>
                        <img src="../../assets/images/card2.png" class="product-thumb" alt="">
                        <button class="card-btn">Wishlist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Forever 21</h2>
                        <p class="description"> White sweatshirt with blue patterns for women's.</p>
                        <span class="price">$20</span><span class="actual-price">$60</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="../../assets/images/card3.avif" class="product-thumb" alt="">
                        <button class="card-btn">Wishlist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">H&M</h2>
                        <p class="description">A Brown casual Hoodie for mens.</p>
                        <span class="price">$50</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">40% off</span>
                        <img src="../../assets/images/card4.png" class="product-thumb" alt="">
                        <button class="card-btn">Wishlist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">h&m</h2>
                        <p class="description">Men solid white drawstring pocket detailed thermal line hoodie. </p>
                        <span class="price">$50</span><span class="actual-price">$80</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">20% off</span>
                        <img src="../../assets/images/card5.png" class="product-thumb" alt="">
                        <button class="card-btn">Wishlist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Puma</h2>
                        <p class="description">Loosefit mens casual yellow hoodie.</p>
                        <span class="price">$20</span><span class="actual-price">$40</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">50% off</span>
                        <img src="../../assets/images/card6.png" class="product-thumb" alt="">
                        <button class="card-btn">Wishlist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">MANFINITY HOMME</h2>
                        <p class="description">Manfinity homme mens formal blue shirt with white check box.</p>
                        <span class="price">$20</span><span class="actual-price">$40</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">50% off</span>
                        <img src="../../assets/images/card7.png" class="product-thumb" alt="">
                        <button class="card-btn">Wishlist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Shein</h2>
                        <p class="description">Shein drawstring waist hooded coat.</p>
                        <span class="price">$20</span><span class="actual-price">$40</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">50% off</span>
                        <img src="../../assets/images/card8.webp" class="product-thumb" alt="">
                        <button class="card-btn">Wishlist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">h&m</h2>
                        <p class="description">Men's 1pc solid lapel coller long sleeve jacket </p>
                        <span class="price">$20</span><span class="actual-price">$40</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">50% off</span>
                        <img src="../../assets/images/card9.webp" class="product-thumb" alt="">
                        <button class="card-btn">Wishlist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">MANFINITY HOMME</h2>
                        <p class="description">Mens shadow colors short sleeve shirt.</p>
                        <span class="price">$20</span><span class="actual-price">$40</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">50% off</span>
                        <img src="../../assets/images/card10.png" class="product-thumb" alt="">
                        <button class="card-btn">Wishlist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">American Eagle</h2>
                        <p class="description">Womens short sleeve light pink cardigan.</p>
                        <span class="price">$20</span><span class="actual-price">$40</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">50% off</span>
                        <img src="../../assets/images/card11.png" class="product-thumb" alt="">
                        <button class="card-btn">Wishlist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Shein</h2>
                        <p class="description">Solid blue single button blazer and pants. </p>
                        <span class="price">$20</span><span class="actual-price">$40</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">50% off</span>
                        <img src="../../assets/images/card12.png" class="product-thumb" alt="">
                        <button class="card-btn">Wishlist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Forever 21</h2>
                        <p class="description">A solid plain white hoodie for women's.</p>
                        <span class="price">$20</span><span class="actual-price">$40</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">50% off</span>
                        <img src="../../assets/images/card13.png" class="product-thumb" alt="">
                        <button class="card-btn">Wishlist</button>
                        <button class="cart-btn" id="addToCartBtn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">h&m</h2>
                        <p class="description">A bottom wear black casual pants.</p>
                        <span class="price">$20</span><span class="actual-price">$40</span>
                    </div>
                </div>

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
