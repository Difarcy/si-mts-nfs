import { initAchievementDelete } from './delete';
import { initAchievementCreate } from './create';
import { initAchievementEdit } from './edit';
import { ListManager } from '../../core/ListManager';

/**
 * Achievement Module Entry Point
 */
export const AchievementModule = {
    init() {
        if (document.querySelector('[data-page="achievement-list"]')) {
            new ListManager({
                pageAttribute: 'achievement-list',
                listContainerId: 'achievement-list-container',
                paginationContainerId: 'achievement-pagination-container',
                onRender: () => {
                    initAchievementDelete();
                }
            });
            initAchievementDelete();
        }

        if (document.querySelector('[data-page="achievement-create"]')) {
            initAchievementCreate();
        }

        if (document.querySelector('[data-page="achievement-edit"]')) {
            initAchievementEdit();
        }
    }
};
