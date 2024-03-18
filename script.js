// function to open cart

// Navigation buttons for cards
const productContainers = [...document.querySelectorAll('.product-container')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

productContainers.forEach((item, i) => {
    let containerDimenstions = item.getBoundingClientRect();
    let containerWidth = containerDimenstions.width;

    nxtBtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth;
    })

    preBtn[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth;
    })
})

// cart
// Get all elements with the class name "cart-btn"
const addToCartButtons = document.querySelectorAll('.cart-btn');

// Loop through each button and attach a click event listener
addToCartButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Redirect the user to the cart page
        window.location.href = 'cart.html';
    });
});
 
// wishlist
// Get all elements with the class name "wishlist-btn"
const wishlistButtons = document.querySelectorAll('.card-btn');

// Loop through each wishlist button and attach a click event listener
wishlistButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Redirect the user to the wishlist page
        window.location.href = 'wishlist.html';
    });
});
