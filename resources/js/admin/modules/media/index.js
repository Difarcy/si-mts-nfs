/**
 * Media Module Entry Point
 */
import { initPhotoSortable } from './photo-sortable';
import { initPhotoGallery } from './photo-gallery';

export const MediaModule = {
    init() {
        initPhotoSortable();
        initPhotoGallery();
        
        // Listen to photo update event to re-init sortable
        window.addEventListener('photo-updated', () => {
            initPhotoSortable();
        });
    }
};
