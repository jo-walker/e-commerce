// This file serves as the entry point for the frontend JavaScript code. 
// It contains initialization logic, such 
//     as setting up event listeners, 
//     making initial API calls, and 
//     rendering the initial state of the application. 

// It may also import other JavaScript modules and libraries needed for the frontend functionality.



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

// Existing navigation buttons for cards logic
const productContainers = [...document.querySelectorAll('.product-container')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

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
document.addEventListener('DOMContentLoaded', function() {
    const productCards = document.querySelectorAll('.product-card');
    let currentIndex = 0;

    function showProduct(index) {
        productCards.forEach((card, i) => {
            card.style.display = i === index ? 'block' : 'none';
        });
    }

    if (nxtBtn.length && preBtn.length) {
        // Assuming you have the same number of next and previous buttons
        // And that they correspond to navigating single products within each product container
        nxtBtn.forEach((btn, i) => {
            btn.addEventListener('click', () => {
                if (currentIndex < productCards.length - 1) {
                    currentIndex++;
                    showProduct(currentIndex);
                }
            });
        });

        preBtn.forEach((btn, i) => {
            btn.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    showProduct(currentIndex);
                }
            });
        });
    }
});