import { initAgendaDelete } from './delete';
import { initAgendaCreate } from './create';
import { initAgendaEdit } from './edit';
import { ListManager } from '../../core/ListManager';

/**
 * Agenda Module Entry Point
 * 
 * Mengatur inisialisasi fitur Agenda.
 * - agenda-list: Mengaktifkan ListManager.
 * - agenda-create: Mengaktifkan logika create.
 * - agenda-edit: Mengaktifkan logika edit.
 */
export const AgendaModule = {
    init() {
        if (document.querySelector('[data-page="agenda-list"]')) {
            new ListManager({
                pageAttribute: 'agenda-list',
                listContainerId: 'agenda-list-container',
                paginationContainerId: 'agenda-pagination-container',
                onRender: () => {
                    initAgendaDelete();
                }
            });
            initAgendaDelete();
        }

        if (document.querySelector('[data-page="agenda-create"]')) {
            initAgendaCreate();
        }

        if (document.querySelector('[data-page="agenda-edit"]')) {
            initAgendaEdit();
        }
    }
};
