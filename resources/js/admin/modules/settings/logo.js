import { api } from '../../../core/fetch';
import { queueToast, showToast } from '../../ui/notifications';

export function initLogoSettings() {
    const form = document.getElementById('logo-form');
    if (!form) return;

    const currentLogoImg = document.querySelector('[data-current-logo]');
    const saveBtn = document.querySelector('[form="logo-form"]');
    const fileInput = form.querySelector('input[type="file"]');
    const uploadContainer = form.querySelector('[data-component="upload-image"]');

    // Function to check if there's a new logo to upload
    const checkHasNewLogo = () => {
        if (!fileInput) return false;

        // Check if there's a new file selected
        if (fileInput.files && fileInput.files.length > 0) return true;

        // Check if preview is visible (for upload-image component)
        if (uploadContainer) {
            const previewContainer = uploadContainer.querySelector('.upload-preview-container');
            if (previewContainer && !previewContainer.classList.contains('hidden')) {
                return true;
            }
        }

        return false;
    };

    // Function to update button state
    const updateButtonState = () => {
        if (!saveBtn) return;

        const hasNewLogo = checkHasNewLogo();

        if (hasNewLogo) {
            saveBtn.disabled = false;
            saveBtn.classList.remove('cursor-not-allowed', 'opacity-50');
        } else {
            saveBtn.disabled = true;
            saveBtn.classList.add('cursor-not-allowed', 'opacity-50');
        }
    };

    // Listen to file input changes
    if (fileInput) {
        fileInput.addEventListener('change', () => {
            updateButtonState();
        });
    }

    // Listen to upload component events (when preview is removed)
    if (uploadContainer) {
        uploadContainer.addEventListener('upload:updated', () => {
            updateButtonState();
        });
    }

    // Initial state - check on page load
    updateButtonState();

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const submitBtn = saveBtn || form.querySelector('button[type="submit"]');

        try {
            if (submitBtn) {
                submitBtn.disabled = true;
                // Opsional: Ganti teks tombol saat loading
                // const originalText = submitBtn.innerHTML;
                // submitBtn.innerText = 'Menyimpan...';
            }

            const res = await api.postForm(form.action || window.location.href, formData);

            if (res.success) {
                queueToast(res.message || 'Logo berhasil diperbarui', { type: 'success', duration: 3000 });
                
                if (res.path && currentLogoImg) {
                    currentLogoImg.src = res.path;
                }
                
                // Reset upload preview if needed
                const uploadInput = form.querySelector('input[type="file"]');
                if (uploadInput) uploadInput.value = '';

                window.location.reload();
            } else {
                showToast(res.message || 'Gagal memperbarui logo', { type: 'error', duration: 4000 });
            }
        } catch (error) {
            console.error('Logo update error:', error);
            showToast('Terjadi kesalahan saat memperbarui logo: ' + (error.message || 'Unknown error'), { type: 'error', duration: 4000 });
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
            }
        }
    });
}
