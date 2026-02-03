import { openConfirm, queueToast, showToast } from '../../ui/notifications';

export function initNewsDelete() {
    // Find all delete buttons in the news list
    const deleteButtons = document.querySelectorAll('[data-news-delete]');

    deleteButtons.forEach(button => {
        if (button.dataset.newsDeleteInit === '1') return;
        button.dataset.newsDeleteInit = '1';

        button.addEventListener('click', async function (e) {
            e.preventDefault();

            const newsId = this.dataset.newsId;
            const newsTitle = this.dataset.newsTitle || 'berita ini';

            const confirmed = await openConfirm({
                title: 'Konfirmasi Hapus',
                message: `Apakah Anda yakin ingin menghapus "${newsTitle}"? Data yang dihapus tidak dapat dikembalikan!`,
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
                const response = await fetch(`/admin/konten/berita/${newsId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    queueToast(result.message || 'Berita berhasil dihapus!', { type: 'success', duration: 3000 });
                    window.location.reload();
                } else {
                    throw new Error(result.message || 'Gagal menghapus berita');
                }

            } catch (error) {
                console.error('Error deleting news:', error);
                showToast('Terjadi kesalahan: ' + error.message, { type: 'error', duration: 4000 });

                // Restore button state
                button.disabled = false;
                button.style.opacity = '1';
                button.style.cursor = 'pointer';
            }
        });
    });
}
