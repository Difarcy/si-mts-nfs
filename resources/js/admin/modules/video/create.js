import { api } from '../../../core/fetch';
import { on } from '../../../core/event';
import { $ } from '../../../core/dom';
import { initChangeDetection } from '../../modules/forms/change-detection';
import { queueToast, showToast } from '../../ui/notifications';

/**
 * Handle Video Create Interaction
 */
export function initVideoCreate() {
    const videoForm = $('#video-form');
    if (!videoForm) return;

    // Init change detection
    initChangeDetection('video-form');

    // Add data-no-submit-protection to form because we handle it manually here
    videoForm.setAttribute('data-no-submit-protection', 'true');

    // Handle form submit
    on(videoForm, 'submit', async (e) => {
        e.preventDefault();

        const submitBtn = document.querySelector('button[form="video-form"]') || videoForm.querySelector('button[type="submit"]');
        if (!submitBtn) return;

        try {
            submitBtn.disabled = true;

            const formData = new FormData(videoForm);
            const url = videoForm.getAttribute('action') || window.location.href;

            const response = await api.postForm(url, formData);

            if (response.success) {
                queueToast(response.message || 'Video berhasil disimpan!', { type: 'success', duration: 3000 });
                window.location.href = '/admin/media/video';
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
