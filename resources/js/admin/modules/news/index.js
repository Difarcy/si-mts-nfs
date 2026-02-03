import { initNewsCreate } from './create';
import { initNewsEdit } from './edit';
import { initNewsDelete } from './delete';
import { ListManager } from '../../core/ListManager';

/**
 * News Module Entry Point
 * 
 * Mengatur inisialisasi fitur Berita berdasarkan atribut data-page pada halaman.
 * - news-list: Mengaktifkan ListManager untuk pagination & search, serta delete handler.
 * - news-create: Mengaktifkan logika form tambah berita.
 * - news-edit: Mengaktifkan logika form edit berita.
 */
export const NewsModule = {
    init() {
        // List Page
        if (document.querySelector('[data-page="news-list"]')) {
            new ListManager({
                pageAttribute: 'news-list',
                listContainerId: 'news-list-container',
                paginationContainerId: 'news-pagination-container',
                onRender: () => {
                    initNewsDelete(); // Re-init delete buttons after AJAX
                }
            });
            initNewsDelete(); // Initial init
        }

        if (document.querySelector('[data-page="news-create"]')) {
            initNewsCreate();
        }

        if (document.querySelector('[data-page="news-edit"]')) {
            initNewsEdit();
        }
    }
};
