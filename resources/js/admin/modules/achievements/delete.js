import { openConfirm, queueToast, showToast } from '../../ui/notifications';

export function initAchievementDelete() {
    // Find all delete buttons in the achievement list
    const deleteButtons = document.querySelectorAll('[data-achievement-delete]');

    deleteButtons.forEach(button => {
        if (button.dataset.achievementDeleteInit === '1') return;
        button.dataset.achievementDeleteInit = '1';

        button.addEventListener('click', async function (e) {
            e.preventDefault();

            const achievementId = this.dataset.achievementId;
            const achievementTitle = this.dataset.achievementTitle || 'prestasi ini';

            const confirmed = await openConfirm({
                title: 'Konfirmasi Hapus',
                message: `Apakah Anda yakin ingin menghapus "${achievementTitle}"? Data yang dihapus tidak dapat dikembalikan!`,
                okText: 'Hapus',
                cancelText: 'Batal',
                variant: 'danger',
            });

            if (!confirmed) return;

            try {
                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                if (!csrfToken) {
                    throw new Error('CSRF token not found');
                }

                // Show loading state
                button.disabled = true;
                button.style.opacity = '0.5';
                button.style.cursor = 'not-allowed';

                // Send delete request
                const response = await fetch(`/admin/konten/prestasi-siswa/${achievementId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    queueToast(result.message || 'Prestasi berhasil dihapus!', { type: 'success', duration: 3000 });
                    window.location.reload();
                } else {
                    throw new Error(result.message || 'Gagal menghapus prestasi');
                }

            } catch (error) {
                console.error('Error deleting achievement:', error);
                showToast('Terjadi kesalahan: ' + error.message, { type: 'error', duration: 4000 });

                // Restore button state
                button.disabled = false;
                button.style.opacity = '1';
                button.style.cursor = 'pointer';
            }
        });
    });
}
