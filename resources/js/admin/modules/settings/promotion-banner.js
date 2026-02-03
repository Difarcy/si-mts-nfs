import { api } from '../../../core/fetch';
import { queueToast, showToast } from '../../ui/notifications';

export function initPromotionBannerSettings() {
    const form = document.getElementById('promotion-banner-form');
    if (!form) return;

    const saveBtn = document.querySelector('[form="promotion-banner-form"]');
    const fileInput = form.querySelector('input[type="file"]');
    const uploadContainer = form.querySelector('[data-component="upload-image"]');

    const checkHasNewBanner = () => {
        if (!fileInput) return false;
        if (fileInput.files && fileInput.files.length > 0) return true;

        if (uploadContainer) {
            const previewContainer = uploadContainer.querySelector('.upload-preview-container');
            if (previewContainer && !previewContainer.classList.contains('hidden')) {
                return true;
            }
        }

        return false;
    };

    const updateButtonState = () => {
        if (!saveBtn) return;

        const hasNew = checkHasNewBanner();
        if (hasNew) {
            saveBtn.disabled = false;
            saveBtn.classList.remove('cursor-not-allowed', 'opacity-50');
        } else {
            saveBtn.disabled = true;
            saveBtn.classList.add('cursor-not-allowed', 'opacity-50');
        }
    };

    if (fileInput) {
        fileInput.addEventListener('change', updateButtonState);
    }

    if (uploadContainer) {
        uploadContainer.addEventListener('upload:updated', updateButtonState);
    }

    updateButtonState();

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const submitBtn = saveBtn || form.querySelector('button[type="submit"]');

        try {
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            }

            const res = await api.postForm(form.action || window.location.href, formData);

            if (res.success) {
                queueToast(res.message || 'Banner promosi berhasil diperbarui', { type: 'success', duration: 3000 });
                window.location.reload();
            } else {
                showToast(res.message || 'Gagal memperbarui banner promosi', { type: 'error', duration: 4000 });
            }
        } catch (error) {
            console.error('Promotion banner update error:', error);
            showToast('Terjadi kesalahan saat memperbarui banner promosi: ' + (error.message || 'Unknown error'), { type: 'error', duration: 4000 });
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            }
        }
    });
}
