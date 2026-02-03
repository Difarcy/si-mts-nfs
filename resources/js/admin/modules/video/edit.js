import { api } from '../../../core/fetch';
import { on } from '../../../core/event';
import { $ } from '../../../core/dom';
import { initChangeDetection } from '../../modules/forms/change-detection';
import { queueToast, showToast } from '../../ui/notifications';

/**
 * Handle Video Edit Interaction
 */
export function initVideoEdit() {
    const videoForm = $('#video-edit-form');
    if (!videoForm) {
        console.error('Video Edit Form not found!');
        return;
    }

    console.log('Video Edit Module Initialized');

    // Init change detection
    initChangeDetection('video-edit-form');

    // Add data-no-submit-protection to form because we handle it manually here
    videoForm.setAttribute('data-no-submit-protection', 'true');

    // Handle form submit
    on(videoForm, 'submit', async (e) => {
        console.log('Video Edit Form Submitting...');
        e.preventDefault();

        const submitBtn = document.querySelector('button[form="video-edit-form"]') || videoForm.querySelector('button[type="submit"]');
        if (!submitBtn) {
            console.error('Submit button not found!');
            return;
        }

        try {
            submitBtn.disabled = true;
            // Add loading state text if needed, or just keep disabled
            
            const formData = new FormData(videoForm);
            
            // Log for debugging
            console.log('Submitting data to:', videoForm.getAttribute('action'));

            const url = videoForm.getAttribute('action') || window.location.href;
            const response = await api.postForm(url, formData);

            console.log('Response:', response);

            if (response.success) {
                queueToast(response.message || 'Video berhasil diperbarui!', { type: 'success', duration: 3000 });
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
