import { ListManager } from '../../core/ListManager';
import { initVideoDelete } from './delete';
import { initVideoPreview } from './preview';
import { initVideoCreate } from './create';
import { initVideoEdit } from './edit';

export const VideoModule = {
    init() {
        if (document.querySelector('[data-page="video-list"]')) {
            new ListManager({
                pageAttribute: 'video-list',
                listContainerId: 'video-list-container',
                paginationContainerId: 'video-pagination-container',
                onRender: () => {
                    initVideoDelete();
                    initVideoPreview();
                }
            });

            initVideoDelete();
            initVideoPreview();
        }

        if (document.querySelector('[data-page="video-create"]')) {
            initVideoCreate();
        }

        if (document.querySelector('[data-page="video-edit"]')) {
            initVideoEdit();
        }
    }
};
