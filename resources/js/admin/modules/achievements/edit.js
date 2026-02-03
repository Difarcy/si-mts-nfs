import { initChangeDetection } from '../../modules/forms/change-detection';
import { queueToast, showToast } from '../../ui/notifications';

/**
 * Achievement Edit Page Handler
 */
export function initAchievementEdit() {
    const achievementEditForm = document.getElementById('achievement-edit-form');
    if (!achievementEditForm) return;

    // Init change detection
    initChangeDetection('achievement-edit-form');

    // Add data-no-submit-protection to form because we handle it manually here
    achievementEditForm.setAttribute('data-no-submit-protection', 'true');

    // Handle form submit
    achievementEditForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitBtn = document.querySelector('button[form="achievement-edit-form"]') || achievementEditForm.querySelector('button[type="submit"]');
        if (!submitBtn) return;

        try {
            submitBtn.disabled = true;

            const formData = new FormData(achievementEditForm);
            const url = achievementEditForm.getAttribute('action') || window.location.href;

            const { api } = await import('../../../core/fetch');
            const response = await api.postForm(url, formData);

            if (response.success) {
                queueToast(response.message || 'Prestasi berhasil diperbarui!', { type: 'success', duration: 3000 });
                window.location.href = '/admin/konten/prestasi-siswa';
            } else {
                showToast('Gagal: ' + (response.message || 'Terjadi kesalahan'), { type: 'error', duration: 4000 });
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
        } finally {
            submitBtn.disabled = false;
        }
    });
}
