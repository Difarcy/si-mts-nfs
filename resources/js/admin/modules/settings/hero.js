import { SimpleChangeDetection } from '../forms/simple-change-detection';
import { api } from '../../../core/fetch';
import { queueToast, showToast } from '../../ui/notifications';

export function initHeroSettings() {
    const form = document.getElementById('hero-form');
    if (!form) return;

    // Initialize Simple Change Detection
    const changeDetection = new SimpleChangeDetection(form, {
        submitButtonSelector: '[form="hero-form"]',
        confirmNavigation: false
    });
    
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitBtn = document.querySelector('[form="hero-form"]') || form.querySelector('button[type="submit"]');
        
        try {
            // Disable button without changing text/spinner
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            }

            const formData = new FormData(form);
            const res = await api.postForm(form.action || window.location.href, formData);

            if (res.success) {
                // Reset Change Detection state (new "clean" state)
                changeDetection.reset(); 

                queueToast(res.message || 'Pengaturan Hero berhasil diperbarui', { type: 'success', duration: 3000 });
                window.location.reload();
            } else {
                showToast(res.message || 'Gagal memperbarui pengaturan Hero', { type: 'error', duration: 4000 });
            }
        } catch (error) {
            console.error('Hero update error:', error);
            showToast('Terjadi kesalahan: ' + (error.message || 'Unknown error'), { type: 'error', duration: 4000 });
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false; // Will be re-disabled by change detection if no changes, but here we reload anyway
                submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            }
        }
    });
}
