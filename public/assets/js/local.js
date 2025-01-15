let currentSlide = 0;

function moveSlide(direction) {
    const carousel = document.querySelector('.carousel');
    const cardWidth = document.querySelector('.client-card').offsetWidth + 20; // card width + margin

    // Total number of slides (6 cards)
    const totalSlides = document.querySelectorAll('.client-card').length;

    // Move slide
    currentSlide += direction;

    // Prevent going out of bounds
    if (currentSlide < 0) {
        currentSlide = totalSlides - 3; // Wrap back to show the last set of cards
    } else if (currentSlide > totalSlides - 3) {
        currentSlide = 0; // Wrap back to the first set
    }

    // Apply transformation
    carousel.style.transform = `translateX(-${currentSlide * cardWidth}px)`;
}
