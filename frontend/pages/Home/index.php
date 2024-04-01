<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/website.css">
    <!-- <link rel="stylesheet" href="../../assets/css/styles.css"> -->
    <script src="../index.js"></script>
    <title>Luna Ashwood</title>
    <!-- Include Header Component -->
    <?php include '../../components/Header/header.php'; ?>
<?php  error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
</head>
<body>
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
                            <img src="<?php echo htmlspecialchars($product['ImageURL']); ?>" alt="Product Image" class="product-thumb"> <!-- TO-DO: Image path -->
                            <button class="card-btn">Wishlist</button>
                            <button class="cart-btn">Add to cart</button>
                            echo '<a href="..\ProductDetails\productD.js?productId=' . htmlspecialchars($product['ProductID']) . '">View Product</a>';
                        </div>
                        <div class="product-info">
                            <!-- <h2 class="product-brand"><?php echo htmlspecialchars($product['Brand']); ?></h2> -->
                            <!-- <p class="product-description"><?php echo htmlspecialchars($product['Description']); ?></p> -->
                            <span class="price">$<?php echo htmlspecialchars($product['Price']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
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
