/**
 * Banner Slider
 * Handles the main hero banner slider with auto-play
 */

export default function initBannerSlider() {
    const sliderContainer = document.querySelector('[data-banner-slider]');
    if (!sliderContainer) return;

    const slides = sliderContainer.querySelectorAll('[data-banner-slide]');
    const indicators = sliderContainer.querySelectorAll('[data-banner-dot]');
    
    if (slides.length <= 1) return; // No need to slide if only 1 image

    let currentIndex = 0;
    let timer = null;
    const interval = 3000; // 3 seconds (sedikit lebih cepat)

    // Function to show specific slide
    const showSlide = (index) => {
        // Normalize index
        if (index >= slides.length) index = 0;
        if (index < 0) index = slides.length - 1;
        
        currentIndex = index;

        // Update slides
        slides.forEach((slide, i) => {
            if (i === currentIndex) {
                slide.style.transform = 'translateX(0)';
                slide.classList.add('z-10');
                slide.classList.remove('z-0');
            } else if (i < currentIndex) {
                slide.style.transform = 'translateX(-100%)';
                slide.classList.remove('z-10');
                slide.classList.add('z-0');
            } else {
                slide.style.transform = 'translateX(100%)';
                slide.classList.remove('z-10');
                slide.classList.add('z-0');
            }
        });

        // Update indicators
        indicators.forEach((dot, i) => {
            if (i === currentIndex) {
                dot.classList.add('bg-white');
                dot.classList.remove('bg-white/50', 'hover:bg-white/80');
            } else {
                dot.classList.remove('bg-white');
                dot.classList.add('bg-white/50', 'hover:bg-white/80');
            }
        });
    };

    // Auto play function
    const startAutoPlay = () => {
        stopAutoPlay(); // Clear existing timer
        timer = setInterval(() => {
            showSlide(currentIndex + 1);
        }, interval);
    };

    const stopAutoPlay = () => {
        if (timer) clearInterval(timer);
    };

    // Event Listeners for Indicators
    indicators.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            // Don't stop auto play on interaction, just reset timer (implicit in startAutoPlay call if we called it)
            // But requirement says "don't stop on hover", usually click resets timer.
            startAutoPlay(); 
        });
    });

    // Initialize
    startAutoPlay();

    // DISABLED: Pause on hover as requested
    // sliderContainer.addEventListener('mouseenter', stopAutoPlay);
    // sliderContainer.addEventListener('mouseleave', startAutoPlay);
}
