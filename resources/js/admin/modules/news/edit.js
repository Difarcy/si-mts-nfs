import { initChangeDetection } from '../../modules/forms/change-detection';
import { queueToast, showToast } from '../../ui/notifications';

/**
 * Berita Edit Page Handler
 * 
 * Mengelola form update berita via AJAX.
 * Mirip dengan create.js, menangani validasi, error handling, dan redirect.
 */
export function initNewsEdit() {
    const newsEditForm = document.getElementById('news-edit-form');
    if (!newsEditForm) return;

    // Init change detection
    initChangeDetection('news-edit-form');

    // Add data-no-submit-protection to form because we handle it manually here
    newsEditForm.setAttribute('data-no-submit-protection', 'true');

    newsEditForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitBtn = document.querySelector('button[form="news-edit-form"]') || newsEditForm.querySelector('button[type="submit"]');
        if (!submitBtn) return;

        try {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');

            const formData = new FormData(newsEditForm);
            const url = newsEditForm.getAttribute('action') || window.location.href;

            const { api } = await import('../../../core/fetch');
            const response = await api.postForm(url, formData);

            if (response.success) {
                queueToast(response.message || 'Berita berhasil diperbarui!', { type: 'success', duration: 3000 });
                window.location.href = '/admin/konten/berita';
            } else {
                showToast('Gagal: ' + (response.message || 'Terjadi kesalahan'), { type: 'error', duration: 4000 });
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            }
        } catch (error) {
            console.error('Submit Error:', error);

            if (error.status === 422 && error.data?.errors) {
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
