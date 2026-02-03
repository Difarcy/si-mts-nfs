/**
 * Photo Gallery Manager
 * Mengelola interaksi galeri foto: Load More (Infinite Scroll like), Deletion, dan AJAX loading
 */

import { api } from '../../../core/fetch';
import { on } from '../../../core/event';
import { openConfirm, showToast } from '../../ui/notifications';

export function initPhotoGallery() {
    // Container element that holds config data
    const galleryContainer = document.getElementById('photo-gallery-container');
    if (!galleryContainer) return;

    const scrollContainer = document.getElementById('photo-scroll-container');
    const loadMoreContainer = document.getElementById('photo-load-more-container');
    const loadMoreBtn = document.getElementById('btn-load-more');
    const contentContainer = document.getElementById('photo-content');
    const countInfo = document.getElementById('photo-count-info');

    // Get config from data attributes
    const config = {
        routeIndex: galleryContainer.dataset.routeIndex,
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.content,
        hasMorePages: galleryContainer.dataset.hasMorePages === 'true'
    };

    let currentPage = 1;
    let hasMorePages = config.hasMorePages;
    let isLoading = false;

    // Helper to extract clean grid items from HTML string
    const extractGridItems = (html) => {
        const temp = document.createElement('div');
        temp.innerHTML = html;
        // Find the grid container inside the response
        const grid = temp.querySelector('#photo-grid');
        return grid ? grid.innerHTML : '';
    };

    // Helper to update total count info
    const updateTotalInfo = (total) => {
        if (countInfo) {
            const currentCount = document.querySelectorAll('[data-photo-item]').length;
            countInfo.textContent = `Menampilkan ${currentCount} dari ${total} foto`;
        }
    };

    const loadPhotos = async (page) => {
        if (isLoading) return;
        isLoading = true;
        
        if (loadMoreBtn) {
            loadMoreBtn.disabled = true;
            loadMoreBtn.textContent = 'Memuat...';
        }

        try {
            const url = new URL(config.routeIndex, window.location.origin);
            url.searchParams.set('page', page);
            url.searchParams.set('per_page', 20); // Consistent per page

            const response = await fetch(url.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            
            // Note: Laravel pagination response returns HTML view if we request standard controller action
            // But we need to know if there are more pages.
            // Ideally we should return JSON with metadata + HTML, but to keep it simple with existing controller:
            // We'll check if the returned HTML is empty or significantly small.
            
            // However, to do this properly without changing controller too much, 
            // let's rely on the fact that if we get content, we append. 
            // If content is empty, we hide button.
            // BETTER: Let's assume the controller returns the view 'admin.partials.media.photo.ajax'.
            // We need to know 'total' or 'next_page_url'.
            
            // For now, let's just append. If the appended content is empty, we stop.
            const html = await response.text();
            
            if (!html.trim()) {
                hasMorePages = false;
                loadMoreContainer.classList.add('hidden');
                return;
            }

            // Parse hasMorePages from response
            const temp = document.createElement('div');
            temp.innerHTML = html;
            const meta = temp.querySelector('#pagination-meta');
            const serverHasMore = meta ? meta.dataset.hasMore === 'true' : false;

            const newItemsHtml = extractGridItems(html);
            
            if (!newItemsHtml.trim()) {
                hasMorePages = false;
                loadMoreContainer.classList.add('hidden');
            } else {
                // Append to existing grid
                const existingGrid = document.getElementById('photo-grid');
                if (existingGrid) {
                    existingGrid.insertAdjacentHTML('beforeend', newItemsHtml);
                } else {
                    // If grid doesn't exist (empty state), replace content
                    contentContainer.innerHTML = html;
                }
                
                // Update state
                currentPage = page;
                hasMorePages = serverHasMore;
                
                if (!hasMorePages) {
                    loadMoreContainer.classList.add('hidden');
                }
                
                // Dispatch custom event to re-init Sortable JS
                window.dispatchEvent(new CustomEvent('photo-updated'));
            }

        } catch (error) {
            console.error('Error fetching photos:', error);
            showToast('Gagal memuat foto.', { type: 'error', duration: 4000 });
        } finally {
            isLoading = false;
            if (loadMoreBtn) {
                loadMoreBtn.disabled = false;
                loadMoreBtn.textContent = 'Muat Lebih Banyak';
            }
        }
    };

    // Initialize Load More Visibility
    if (hasMorePages) {
         loadMoreContainer.classList.remove('hidden');
    }

    // Handle Load More Click
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', () => {
            if (hasMorePages) {
                loadPhotos(currentPage + 1);
            }
        });
    }

    // Handle Deletion
    document.addEventListener('click', async function (e) {
        const deleteBtn = e.target.closest('[data-photo-delete]');
        if (deleteBtn) {
            const id = deleteBtn.getAttribute('data-photo-id');
            const confirmed = await openConfirm({
                title: 'Konfirmasi Hapus',
                message: 'Apakah Anda yakin ingin menghapus foto ini? Data yang dihapus tidak dapat dikembalikan!',
                okText: 'Hapus',
                cancelText: 'Batal',
                variant: 'danger',
            });
            if (confirmed) {
                fetch(`${config.routeIndex}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': config.csrfToken,
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove item from DOM directly
                            const item = document.querySelector(`[data-photo-item][data-id="${id}"]`);
                            if (item) item.remove();
                            
                            // Re-init sortable just in case
                            window.dispatchEvent(new CustomEvent('photo-updated'));
                            showToast(data.message || 'Foto berhasil dihapus!', { type: 'success', duration: 3000 });
                        } else {
                            showToast(data.message || 'Gagal menghapus foto', { type: 'error', duration: 4000 });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('Terjadi kesalahan saat menghapus foto', { type: 'error', duration: 4000 });
                    });
            }
        }
    });
}
