function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}


const cardsContainer = document.querySelector('.reviews__cards');
const cards = document.querySelectorAll('.reviews__card');
let currentIndex = 0;

function scrollToNextCard() {
    currentIndex++;
    if (currentIndex >= cards.length) {
        currentIndex = 0; // Reset to the first card
    }
    const offset = -currentIndex * (cards[0].offsetWidth + 20); // Adjust for margin
    cardsContainer.style.transform = `translateX(${offset}px)`;
}

// Automatically scroll every 3 seconds
setInterval(scrollToNextCard, 3000);

