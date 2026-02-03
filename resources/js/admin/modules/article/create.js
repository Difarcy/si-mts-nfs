import { api } from '../../../core/fetch';
import { on } from '../../../core/event';
import { $ } from '../../../core/dom';
import { initChangeDetection } from '../../modules/forms/change-detection';
import { queueToast, showToast } from '../../ui/notifications';

/**
 * Handle Article Create Interaction
 */
export function initArticleCreate() {
    const articleForm = $('#article-form');
    if (!articleForm) return;

    // Init change detection
    initChangeDetection('article-form');

    // Add data-no-submit-protection to form because we handle it manually here
    articleForm.setAttribute('data-no-submit-protection', 'true');

    // Handle form submit
    on(articleForm, 'submit', async (e) => {
        e.preventDefault();

        const submitBtn = document.querySelector('button[form="article-form"]') || articleForm.querySelector('button[type="submit"]');
        if (!submitBtn) return;

        try {
            // Matikan tombol agar tidak double klik, tapi jangan ubah teks/icon
            submitBtn.disabled = true;

            const formData = new FormData(articleForm);

            // Gunakan action form sebagai URL, jika kosong gunakan current URL
            const url = articleForm.getAttribute('action') || window.location.href;

            const response = await api.postForm(url, formData);

            if (response.success) {
                queueToast(response.message || 'Artikel berhasil disimpan!', { type: 'success', duration: 3000 });
                window.location.href = '/admin/konten/artikel';
            } else {
                showToast('Gagal: ' + (response.message || 'Terjadi kesalahan'), { type: 'error', duration: 4000 });
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
        } finally {
            submitBtn.disabled = false;
        }
    });
}
