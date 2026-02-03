import { SimpleChangeDetection } from '../forms/simple-change-detection';
import { api } from '../../../core/fetch';
import { queueToast, showToast } from '../../ui/notifications';

export function initSocialMediaSettings() {
    const form = document.getElementById('social-media-form');
    if (!form) return;

    const changeDetection = new SimpleChangeDetection(form, {
        submitButtonSelector: '[form="social-media-form"]',
        confirmNavigation: false
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitBtn = document.querySelector('[form="social-media-form"]') || form.querySelector('button[type="submit"]');

        try {
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            }

            const formData = new FormData(form);
            const res = await api.postForm(form.action || window.location.href, formData);

            if (res.success) {
                changeDetection.reset();
                queueToast(res.message || 'Media sosial berhasil diperbarui', { type: 'success', duration: 3000 });
                window.location.reload();
            } else {
                showToast(res.message || 'Gagal memperbarui media sosial', { type: 'error', duration: 4000 });
            }
        } catch (error) {
            console.error('Media sosial update error:', error);
            showToast('Terjadi kesalahan: ' + (error.message || 'Unknown error'), { type: 'error', duration: 4000 });
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            }
        }
    });
}
