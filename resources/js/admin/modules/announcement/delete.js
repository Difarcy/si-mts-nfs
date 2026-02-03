import { openConfirm, queueToast, showToast } from '../../ui/notifications';

export function initAnnouncementDelete() {
    // Find all delete buttons in the announcement list
    const deleteButtons = document.querySelectorAll('[data-announcement-delete]');

    deleteButtons.forEach(button => {
        if (button.dataset.announcementDeleteInit === '1') return;
        button.dataset.announcementDeleteInit = '1';

        button.addEventListener('click', async function (e) {
            e.preventDefault();

            const announcementId = this.dataset.announcementId;
            const announcementTitle = this.dataset.announcementTitle || 'pengumuman ini';

            const confirmed = await openConfirm({
                title: 'Konfirmasi Hapus',
                message: `Apakah Anda yakin ingin menghapus "${announcementTitle}"? Data yang dihapus tidak dapat dikembalikan!`,
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
                const response = await fetch(`/admin/konten/pengumuman/${announcementId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    queueToast(result.message || 'Pengumuman berhasil dihapus!', { type: 'success', duration: 3000 });
                    window.location.reload();
                } else {
                    throw new Error(result.message || 'Gagal menghapus pengumuman');
                }

            } catch (error) {
                console.error('Error deleting announcement:', error);
                showToast('Terjadi kesalahan: ' + error.message, { type: 'error', duration: 4000 });

                // Restore button state
                button.disabled = false;
                button.style.opacity = '1';
                button.style.cursor = 'pointer';
            }
        });
    });
}
