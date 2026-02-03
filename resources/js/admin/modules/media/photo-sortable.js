/**
 * Photo Gallery Sortable
 * Menangani drag and drop untuk mengatur urutan foto yang sudah di-upload
 */

import { api } from '../../../core/fetch';
import { showToast } from '../../ui/notifications';

export function initPhotoSortable() {
    const photoGrid = document.getElementById('photo-grid');
    if (!photoGrid) return;

    // Prevent duplicate initialization
    if (photoGrid.dataset.sortableInitialized === 'true') {
        return;
    }

    let draggedItem = null;

    const getPhotoItem = (element) => element?.closest?.('[data-photo-item]');

    photoGrid.addEventListener('dragstart', (e) => {
        const item = getPhotoItem(e.target);
        if (!item) return;

        draggedItem = item;
        e.dataTransfer.effectAllowed = 'move';

        // Ghost image styling
        setTimeout(() => {
            item.classList.add('opacity-40', 'scale-95', 'border-green-500', 'z-50');
        }, 0);
    });

    photoGrid.addEventListener('dragend', () => {
        if (draggedItem) {
            draggedItem.classList.remove('opacity-40', 'scale-95', 'border-green-500', 'z-50');
        }
        draggedItem = null;
    });

    // Gunakan dragenter untuk interaksi yang lebih agresif/sensitif
    photoGrid.addEventListener('dragenter', (e) => {
        if (!draggedItem) return;
        e.preventDefault();

        const overItem = getPhotoItem(e.target);
        if (!overItem || overItem === draggedItem) return;

        // Langsung tukar posisi saat cursor masuk area elemen (tanpa menunggu 50%)
        // Logika sederhana: Swap dengan elemen yang di-hover
        
        // Cek apakah overItem sebelum atau sesudah draggedItem di DOM
        // Jika draggedItem index < overItem index -> draggedItem dipindah ke setelah overItem
        // Jika draggedItem index > overItem index -> draggedItem dipindah ke sebelum overItem
        
        const items = Array.from(photoGrid.children);
        const draggedIndex = items.indexOf(draggedItem);
        const overIndex = items.indexOf(overItem);

        if (draggedIndex < overIndex) {
            overItem.after(draggedItem);
        } else {
            overItem.before(draggedItem);
        }
    });

    photoGrid.addEventListener('dragover', (e) => {
        if (!draggedItem) return;
        e.preventDefault(); // Wajib ada agar bisa drop
        e.dataTransfer.dropEffect = 'move';
        // Logic perpindahan dipindah ke dragenter agar lebih sensitif
    });

    photoGrid.addEventListener('drop', async (e) => {
        if (!draggedItem) return;
        e.preventDefault();

        // Save the new order to database
        await savePhotoOrder();
    });

    async function savePhotoOrder() {
        const items = Array.from(photoGrid.querySelectorAll('[data-photo-item]'));
        const ids = items.map(item => item.dataset.id);

        try {
            const response = await api.post('/admin/media/foto/sort', { ids });

            if (response.success) {
                // Optional: show subtle success toast
                console.log('Urutan berhasil disimpan');
            } else {
                showToast('Gagal menyimpan urutan gambar: ' + (response.message || 'Error tidak diketahui'), { type: 'error', duration: 4000 });
            }
        } catch (error) {
            console.error('Error saving photo order:', error);
            showToast('Terjadi kesalahan saat menyimpan urutan gambar', { type: 'error', duration: 4000 });
        }
    }

    // Mark as initialized
    photoGrid.dataset.sortableInitialized = 'true';
}
