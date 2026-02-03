import { api } from '../../../core/fetch';
import { queueToast, showToast } from '../../ui/notifications';

export function initBannerSettings() {
    const form = document.getElementById('banner-form');
    if (!form) return;

    const saveBtn = document.querySelector('[form="banner-form"]');
    const uploadContainer = form.querySelector('[data-component="upload-image"]');
    
    // Check if there are changes (files selected or order changed or items removed)
    // For simplicity in this "Settings" context, we might enable button if there's any content
    // But ideally we track dirty state. For now, let's enable it if there are files.
    
    const updateButtonState = () => {
        if (!saveBtn) return;
        
        // In multi-upload, we check if there are any existing images OR any new files selected
        // The upload-image component manages hidden inputs for existing files
        const hasExisting = form.querySelectorAll('input[name="banner_existing[]"]').length > 0;
        const fileInput = form.querySelector('input[type="file"]');
        const hasNew = fileInput && fileInput.files && fileInput.files.length > 0;
        
        // Cek apakah ada perubahan status
        // Karena ini multi-upload sortable, agak sulit melacak state awal vs akhir secara presisi
        // tanpa menyimpan state awal. Tapi user minta tombol tidak auto-enable saat hover.
        // MutationObserver mungkin terlalu sensitif (misal hover effect nambah class).
        
        // Kita enable tombol HANYA jika:
        // 1. Ada file baru dipilih (hasNew)
        // 2. Event 'upload:updated' dipicu (artinya ada penghapusan atau reorder yang valid)
        
        // Default disable, enable via event listeners only
        // saveBtn.disabled = true;
        // saveBtn.classList.add('cursor-not-allowed', 'opacity-50');
    };

    // Initial State Capture
    let initialOrder = [];
    const getCurrentOrder = () => {
        const items = uploadContainer ? uploadContainer.querySelectorAll('input[name="banner_existing[]"]') : [];
        return Array.from(items).map(input => input.value);
    };

    // Helper to check changes
    const checkChanges = () => {
        if (!saveBtn) return;

        const currentOrder = getCurrentOrder();
        const fileInput = form.querySelector('input[type="file"]');
        const hasNew = fileInput && fileInput.files && fileInput.files.length > 0;
        
        // Compare current order with initial order
        const isOrderChanged = JSON.stringify(currentOrder) !== JSON.stringify(initialOrder);
        
        if (hasNew || isOrderChanged) {
            saveBtn.disabled = false;
            saveBtn.classList.remove('cursor-not-allowed', 'opacity-50');
        } else {
            saveBtn.disabled = true;
            saveBtn.classList.add('cursor-not-allowed', 'opacity-50');
        }
    };

    // Listen to changes
    if (uploadContainer) {
        // Capture initial order immediately
        initialOrder = getCurrentOrder();

        // 'upload:updated' is fired by custom JS when file list changes (add/remove/sort)
        uploadContainer.addEventListener('upload:updated', checkChanges);
        
        // 'change' on input file
        uploadContainer.addEventListener('change', checkChanges);
        
        // Listen for drag-and-drop sort events specifically
        uploadContainer.addEventListener('dragend', () => {
            // Small delay to allow DOM to update
            setTimeout(checkChanges, 100);
        });
    }
    
    // Initial state - Disable by default until change detected
    if (saveBtn) {
        saveBtn.disabled = true;
        saveBtn.classList.add('cursor-not-allowed', 'opacity-50');
    }

    // Handle Submit
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const submitBtn = saveBtn || form.querySelector('button[type="submit"]');
        let originalText = '';

        try {
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            }

            const res = await api.postForm(form.action || window.location.href, formData);

            if (res.success) {
                if (res.redirect) {
                    queueToast(res.message || 'Banner berhasil diperbarui', { type: 'success', duration: 3000 });
                    window.location.href = res.redirect;
                } else {
                    queueToast(res.message || 'Banner berhasil diperbarui', { type: 'success', duration: 3000 });
                    window.location.reload();
                }
            } else {
                showToast(res.message || 'Gagal memperbarui banner', { type: 'error', duration: 4000 });
            }
        } catch (error) {
            console.error('Banner update error:', error);
            showToast('Terjadi kesalahan saat memperbarui banner: ' + (error.message || 'Unknown error'), { type: 'error', duration: 4000 });
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            }
        }
    });
}
