import { initAnnouncementDelete } from './delete';
import { initAnnouncementCreate } from './create';
import { initAnnouncementEdit } from './edit';
import { ListManager } from '../../core/ListManager';

/**
 * Announcement Module Entry Point
 * 
 * Mengatur inisialisasi fitur Pengumuman.
 * - announcement-list: Mengaktifkan ListManager.
 * - announcement-create: Mengaktifkan logika create.
 * - announcement-edit: Mengaktifkan logika edit.
 */
export const AnnouncementModule = {
    init() {
        if (document.querySelector('[data-page="announcement-list"]')) {
            new ListManager({
                pageAttribute: 'announcement-list',
                listContainerId: 'announcement-list-container',
                paginationContainerId: 'announcement-pagination-container',
                onRender: () => {
                    initAnnouncementDelete();
                }
            });
            initAnnouncementDelete();
        }

        if (document.querySelector('[data-page="announcement-create"]')) {
            initAnnouncementCreate();
        }

        if (document.querySelector('[data-page="announcement-edit"]')) {
            initAnnouncementEdit();
        }
    }
};
