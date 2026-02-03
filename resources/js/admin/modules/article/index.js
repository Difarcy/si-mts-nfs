import { initArticleCreate } from './create';
import { initArticleEdit } from './edit';
import { initArticleDelete } from './delete';
import { ListManager } from '../../core/ListManager';

/**
 * Article Module Entry Point
 * 
 * Mengatur inisialisasi fitur Artikel.
 * - article-list: Mengaktifkan ListManager.
 * - article-create: Mengaktifkan logika create.
 * - article-edit: Mengaktifkan logika edit.
 */
export const ArticleModule = {
    init() {
        // List Page
        if (document.querySelector('[data-page="article-list"]')) {
            new ListManager({
                pageAttribute: 'article-list',
                listContainerId: 'article-list-container',
                paginationContainerId: 'article-pagination-container',
                onRender: () => {
                    initArticleDelete();
                }
            });
            initArticleDelete();
        }

        if (document.querySelector('[data-page="article-create"]')) {
            initArticleCreate();
        }

        if (document.querySelector('[data-page="article-edit"]')) {
            initArticleEdit();
        }
    }
};
