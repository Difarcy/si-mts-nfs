/**
 * Handle sticky header behavior
 */
export default function initHeaderScroll() {
    const headerContainer = document.getElementById('main-header-container');

    if (!headerContainer) return;

    window.addEventListener('scroll', () => {
        const currentScrollY = window.scrollY;

        if (currentScrollY > 50) {
            // Kita bisa menambahkan shadow atau perubahan style lain saat sedang scroll
            headerContainer.classList.add('shadow-xl');
        } else {
            headerContainer.classList.remove('shadow-xl');
        }
    }, { passive: true });
}
