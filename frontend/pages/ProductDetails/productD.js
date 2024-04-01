// Get product ID from URL or another source
var productId = getProductIdFromURL(); // Implement this function as per your requirement

// AJAX request to fetch product details
$.ajax({
    url: 'queries.php',
    type: 'GET',
    data: { action: 'getProductById', id: productId },
    success: function(response) {
        // Handle the response data (e.g., populate product detail page)
        // Example:
        $('#productTitle').text(response.name);
        $('#productDescription').text(response.description);
        $('#productPrice').text('$' + response.price);
        $('#productImage').attr('src', response.imageURL);
        // Populate other product details as needed
    }
});
function getProductIdFromURL() {
    const params = new URLSearchParams(window.location.search);
    return params.get('productId'); // Make sure 'productId' matches the query parameter name in your URL
}
