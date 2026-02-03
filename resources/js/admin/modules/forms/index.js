import { initUploadPreview } from './upload-preview';
import { initUploadSortable } from './upload-sortable';
import { initChangeDetection } from './change-detection';
import { initPreviewImageModal } from '../media/preview-image';
import { initFilePicker } from './file-picker';
import { initSubmitProtection } from './submit-protection';
import { initUnsavedChangesWarning } from './unsaved-warning';

/**
 * Forms Module Entry Point
 */
export const FormsModule = {
    init() {
        initUploadPreview();
        initUploadSortable();
        initChangeDetection();
        initPreviewImageModal();
        initFilePicker();
        initSubmitProtection();
        initUnsavedChangesWarning();
    }
};
