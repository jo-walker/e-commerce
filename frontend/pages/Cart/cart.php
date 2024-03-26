<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/website.css">
  <script src="script.js" defer></script>
  <title>Shopping Cart</title>
</head>

<body>
  <header>
  <!-- Background div -->
  <nav class="navbar">
    <div class="nav">
      <!-- Logo -->
      <div class="logo">
        <img src="../../assets/images/logo.png" alt="Logo of the website">
      </div>
      <a href="../UserProfile/userprof.html" class="user" alt="user-Image"></a>
      <a href="cart.html" class="shopping-cart" alt="cart-Image"></a>
      <a href="wishlist.html" class="heart" alt="heart-Image"></a>
      <!-- Search Option  -->
      <div id="space"></div>
      <h1 id="my-cart">My cart</h1>
      <button class="wishlist-button"><a href="wishlist.html">Add to Wishlist</a></button>
      <button class="track-button">Track Order</button>
    </div>
  </nav>
</header>
  <!-- Navigation links -->
  <nav class="links">
    <ul class="links-container">
      <li class="link-item">

        <a href="../Home/index.html" class="link">Home</a>
      </li>
      <li class="link-item"><a href="#" class="link">Featured</a></li>
      <li class="link-item"><a href="#" class="link">Sweaters</a></li>
      <li class="link-item"><a href="#" class="link">Clothing</a></li>
      <li class="link-item"><a href="#footer" class="link">About Us</a></li>
    </ul>
  </nav>
  <div class="cart-background">
    <header>

    </header>
    <!-- Main Content -->
  <main class="main-content">
    <!-- Cart items -->
    <div class="cart-items">
      <!-- Cart item 1 -->
      <div class="cart-item">
        <img src="../../assets/images/item1.jpg" alt="Item 1">
        <div class="item-details">
          <h2>Item Name</h2>
          <p>Price: $XX.XX</p>
          <button class="remove-btn">Remove</button>
        </div>
      </div>
      <!-- Cart item 2 -->
      <div class="cart-item">
        <img src="../../assets/images/item2.jpg" alt="Item 2">
        <div class="item-details">
          <h2>Item Name</h2>
          <p>Price: $XX.XX</p>
          <button class="remove-btn">Remove</button>
        </div>
      </div>
    </div>
<div class="container">
    <!-- Cart summary -->
    <div class="cart-summary">
      <h2 id="summery">Cart Summary</h2>
      <p id="total-items">Total Items: XX</p>
      <p id="total-price">Total Price: $XXX.XX</p>
      <button class="checkout-btn">Proceed to Checkout</button>
    </div>
    </div>
  </main>

  </div>
<?php include '../../components/Footer/footer.html'; ?>
</body>

</html>