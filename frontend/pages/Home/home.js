// Fetch and insert the header and footer using JavaScript
fetch('../../components/Header/header.html')
    .then(response => response.text())
    .then(html => document.getElementById('header').innerHTML = html);

fetch('../../components/Footer/footer.html')
    .then(response => response.text())
    .then(html => document.getElementById('footer').innerHTML = html);

    
// AJAX request to fetch product card data
$.ajax({
    url: 'queries.php',
    url: '../../../database/queries.php', // http://localhost/ecommerce/backend/queries.php' or 'http://example.com/backend/queries.php'
    type: 'GET',
    data: { action: 'getProductCards' },
    success: function(response) {
        // Handle the response data (e.g., generate product cards dynamically)
        // Example:
        response.forEach(function(product) {
            // Generate product card HTML dynamically and append it to the DOM
        });
    }
});
// compare this snippet from frontend/components/Product/productPopulation.js: