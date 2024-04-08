// This file serves as the entry point for the frontend JavaScript code. 
// It contains initialization logic, such 
//     as setting up event listeners, 
//     making initial API calls, and 
//     rendering the initial state of the application. 

// It may also import other JavaScript modules and libraries needed for the frontend functionality.



// Navigation buttons for cards

document.addEventListener('DOMContentLoaded', function() {

    const productContainers = [...document.querySelectorAll('.product-container')];
    const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
    const preBtn = [...document.querySelectorAll('.pre-btn')];
    const numberOfCardsToShow = 5; 

    productContainers.forEach((item, i) => {
        let containerDimensions = item.getBoundingClientRect();
        let containerWidth = containerDimensions.width;

        nxtBtn[i].addEventListener('click', () => {
            item.scrollLeft += containerWidth;
        });

        preBtn[i].addEventListener('click', () => {
            item.scrollLeft -= containerWidth;
        });
    });

    // New logic to handle product card navigation if needed
    const productCards = document.querySelectorAll('.product-card');
    let currentIndex = 0;

    function showProduct(startIndex) {
        // Hide all cards first
        productCards.forEach(card => {
            card.style.display = 'none';
        });

        // Calculate the end index, make sure it does not exceed the length of productCards
        let endIndex = startIndex + numberOfCardsToShow;
        endIndex = Math.min(endIndex, productCards.length);

        // Show only the cards within the startIndex and endIndex range
        for (let i = startIndex; i < endIndex; i++) {
            productCards[i].style.display = 'block';
        }
    }

    // Add click event listeners to next and previous buttons
    nxtBtn.forEach((btn, i) => {
        btn.addEventListener('click', () => {
            let potentialNextIndex = currentIndex + numberOfCardsToShow;
            if (potentialNextIndex < productCards.length) {
                currentIndex = potentialNextIndex;
            } else {
                // Show the last set of products if there aren't enough to make a full set
                currentIndex = productCards.length - numberOfCardsToShow;
            }
            showProduct(currentIndex);
        });
    });

    preBtn.forEach((btn, i) => {
        btn.addEventListener('click', () => {
            let potentialPrevIndex = currentIndex - numberOfCardsToShow;
            if (potentialPrevIndex >= 0) {
                currentIndex = potentialPrevIndex;
            } else {
                currentIndex = 0;
            }
            showProduct(currentIndex);
        });
    });

    showProduct(currentIndex);

});

