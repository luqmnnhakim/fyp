// Select DOM elements
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('nav-menu');

// Toggle the 'active' class when the hamburger is clicked
hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    navMenu.classList.toggle('active');
});
