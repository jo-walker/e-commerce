// Sample product data (replace this with your actual data)
const products = [
    { 
        id: 1,
        title: "Product 1",
        description: "Description of Product 1",
        price: 20.00,
        specs: ["Specification 1", "Specification 2"]
    },
    // Add more product objects here
];

// Function to populate product details
function populateProductDetails(product) {
    const productDetailContainer = document.querySelector('.product-detail');

    // Populate product details HTML template with product data
    productDetailContainer.innerHTML = `
        <h2 class="product-title">${product.title}</h2>
        <p class="product-description">${product.description}</p>
        <span class="product-price">$${product.price.toFixed(2)}</span>
        <ul class="product-specs">
            ${product.specs.map(spec => `<li>${spec}</li>`).join('')}
        </ul>
    `;
}

// Function to populate product cards
function populateProductCards(products) {
    const productContainer = document.querySelector('.product-container');

    // Clear existing content
    productContainer.innerHTML = '';

    // Iterate over each product and populate product cards
    products.forEach(product => {
        const productCard = document.createElement('div');
        productCard.classList.add('product-card');
        productCard.innerHTML = `
            <div class="product-image">
                <img src="path_to_image" alt="Product Image">
            </div>
            <div class="product-info">
                <h2 class="product-title">${product.title}</h2>
                <p class="product-description">${product.description}</p>
                <span class="product-price">$${product.price.toFixed(2)}</span>
                <button class="add-to-cart">Add to Cart</button>
            </div>
        `;
        productContainer.appendChild(productCard);
    });
}

// Call functions to populate product details and product cards
populateProductDetails(products[0]); // Populate product details for the first product
populateProductCards(products); // Populate product cards for all products
