import { api } from '../../../core/fetch';
import { on } from '../../../core/event';
import { $ } from '../../../core/dom';
import { initChangeDetection } from '../../modules/forms/change-detection';
import { queueToast, showToast } from '../../ui/notifications';

/**
 * Handle Berita Create Interaction
 * 
 * Mengelola form pembuatan berita baru via AJAX.
 * Menangani validasi response, error handling (422), dan redirect setelah sukses.
 * Menggunakan `data-no-submit-protection` untuk handle manual state tombol submit.
 */
export function initNewsCreate() {
    // We do NOT attach submit listener here anymore.
    // The submit-protection.js module handles the disabled state globally.
    // For AJAX submissions, we rely on the standard form submission or check if we need to manually handle it.
    
    // In this case, since we want to handle the response JSON and redirect manually,
    // we keep the listener but ensure it works with the global protection.
    
    const newsForm = $('#news-form');
    if (!newsForm) return;

    // Init change detection
    initChangeDetection('news-form');

    // Add data-no-submit-protection to form because we handle it manually here
    newsForm.setAttribute('data-no-submit-protection', 'true');

    // Handle form submit
    on(newsForm, 'submit', async (e) => {
        e.preventDefault();

        const submitBtn = document.querySelector('button[form="news-form"]') || newsForm.querySelector('button[type="submit"]');
        if (!submitBtn) return;

        try {
            // Matikan tombol agar tidak double klik, tapi jangan ubah teks/icon
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');

            const formData = new FormData(newsForm);

            // Gunakan action form sebagai URL, jika kosong gunakan current URL
            const url = newsForm.getAttribute('action') || window.location.href;

            const response = await api.postForm(url, formData);

            if (response.success) {
                queueToast(response.message || 'Berita berhasil disimpan!', { type: 'success', duration: 3000 });
                window.location.href = '/admin/konten/berita';
            } else {
                showToast('Gagal: ' + (response.message || 'Terjadi kesalahan'), { type: 'error', duration: 4000 });
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            }

        } catch (error) {
            console.error('Submit Error:', error);

            if (error.status === 422 && error.data.errors) {
                const errors = error.data.errors;
                const first = Object.values(errors)[0]?.[0];
                showToast(first || 'Harap periksa kembali form.', { type: 'error', duration: 4500 });
            } else {
                showToast('Gagal: ' + (error.data?.message || error.message), { type: 'error', duration: 4500 });
            }
            
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
        }
    });
}
