/**
 * CSRF Token Handler
 * Menangani CSRF token untuk semua request AJAX
 */

export function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
}

export function setupCsrfToken() {
    const token = getCsrfToken();

    // Setup untuk axios jika tersedia
    if (window.axios) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
    }

    // Setup untuk fetch
    window.csrfToken = token;
}

// Auto setup saat file di-import
setupCsrfToken();
