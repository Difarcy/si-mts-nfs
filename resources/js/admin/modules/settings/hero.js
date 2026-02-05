import { SimpleChangeDetection } from '../forms/simple-change-detection';
import { api } from '../../../core/fetch';
import { queueToast, showToast } from '../../ui/notifications';

export function initHeroSettings() {
    const form = document.getElementById('hero-form');
    if (!form) return;

    const sloganEl = form.querySelector('[name="deskripsi"]');

    const countLines = (text) => {
        const v = String(text || '').replace(/\r\n/g, '\n').replace(/\r/g, '\n');
        return v.length ? v.split('\n').length : 0;
    };

    const countSentences = (text) => {
        const normalized = String(text || '').trim().replace(/\s+/g, ' ');
        if (!normalized) return 0;
        return normalized
            .split(/[.!?]+/)
            .map(s => s.trim())
            .filter(Boolean).length;
    };

    const validateSlogan = () => {
        if (!sloganEl) return true;
        const v = String(sloganEl.value || '').trim();
        if (!v) return true;

        const lines = countLines(v);
        const sentences = countSentences(v);

        if (lines > 3 || sentences > 2) {
            showToast('Moto / Slogan maksimal 2 kalimat atau 3 baris.', { type: 'error', duration: 4000 });
            sloganEl.focus();
            return false;
        }

        return true;
    };

    if (sloganEl) {
        sloganEl.addEventListener('keydown', (e) => {
            if (e.key !== 'Enter') return;
            if (e.shiftKey || e.altKey || e.ctrlKey || e.metaKey) return;
            const current = String(sloganEl.value || '');
            const lines = countLines(current);
            if (lines >= 3) {
                e.preventDefault();
                showToast('Moto / Slogan maksimal 3 baris.', { type: 'warning', duration: 2500 });
            }
        });
    }

    // Initialize Simple Change Detection
    const changeDetection = new SimpleChangeDetection(form, {
        submitButtonSelector: '[form="hero-form"]',
        confirmNavigation: false
    });
    
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (!validateSlogan()) return;

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
