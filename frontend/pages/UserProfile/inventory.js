document.addEventListener('DOMContentLoaded', function() {
    // Event listeners and initializations
});

function manageInventory() {
    var action = document.getElementById("actionSelect").value;
    document.getElementById("addProductForm").style.display = action === "addProduct" ? "block" : "none";
    document.getElementById("updateProductForm").style.display = action === "updateProduct" ? "block" : "none";
    document.getElementById("deleteProductForm").style.display = action === "deleteProduct" ? "block" : "none";
}

// Ensure the correct form is shown when the page loads
window.onload = manageInventory;

function loadProductDetails(productID) {
    if (!productID) {
        console.log('No product ID provided'); // Log a message for debugging purposes (optional)
        document.getElementById('productDetailsUpdateForm').innerHTML = 'Please select a product.'; // Display a message to the user (optional)
        return;
    }
    // console.log(productId); // Log the product ID for debugging purposes (optional)
    fetch(`productDetailsFetch.php?action=fetchDetails&productID=${productID}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse the JSON response into a JavaScript object
        })
        .then(data => { // Process the JSON data object returned by the previous step

            console.log(data); // Log the response data
            if (data.success) {
                // Populate form fields here
            } else {
                console.error('Failed to load product details:', data.error);
                document.getElementById('productDetailsUpdateForm').innerHTML = 'Error loading product details.';
            }
        })
        .catch(error => { // Handle any errors from the previous steps

            console.error('Error fetching product details:', error);
            document.getElementById('productDetailsUpdateForm').innerHTML = 'Error fetching product details.';
        });
}