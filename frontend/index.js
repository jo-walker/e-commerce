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