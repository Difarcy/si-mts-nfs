import { openConfirm, queueToast, showToast } from '../../ui/notifications';

export function initVideoDelete() {
    const deleteButtons = document.querySelectorAll('[data-video-delete]');

    deleteButtons.forEach(button => {
        if (button.dataset.videoDeleteInit === '1') return;
        button.dataset.videoDeleteInit = '1';

        button.addEventListener('click', async function (e) {
            e.preventDefault();

            const videoId = this.dataset.videoId;
            const videoTitle = this.dataset.videoTitle || 'video ini';

            const confirmed = await openConfirm({
                title: 'Konfirmasi Hapus',
                message: `Apakah Anda yakin ingin menghapus "${videoTitle}"? Data yang dihapus tidak dapat dikembalikan!`,
                okText: 'Hapus',
                cancelText: 'Batal',
                variant: 'danger',
            });
            if (!confirmed) return;

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (!csrfToken) throw new Error('CSRF token not found');

                button.disabled = true;
                button.style.opacity = '0.5';
                button.style.cursor = 'not-allowed';

                const response = await fetch(`/admin/media/video/${videoId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    queueToast(result.message || 'Video berhasil dihapus!', { type: 'success', duration: 3000 });
                    window.location.reload();
                    return;
                }

                throw new Error(result.message || 'Gagal menghapus video');
            } catch (error) {
                console.error('Error deleting video:', error);
                showToast('Terjadi kesalahan: ' + error.message, { type: 'error', duration: 4000 });

                button.disabled = false;
                button.style.opacity = '1';
                button.style.cursor = 'pointer';
            }
        });
    });
}
