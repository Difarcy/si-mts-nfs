export function initUploadSortable() {
    const uploadContainers = document.querySelectorAll('[data-component="upload-image"][data-multiple="true"]');

    uploadContainers.forEach(container => {
        if (container.dataset.uploadSortableInit === '1') return;
        container.dataset.uploadSortableInit = '1';

        const grid = container.querySelector('.upload-grid-container');
        const input = container.querySelector('.upload-input');
        if (!grid || !input) return;

        let draggedItem = null;

        const getSortableItem = (element) => element?.closest?.('[data-sortable-item="true"]') || element?.closest?.('[data-file-key]');

        const syncFilesOrderToDom = () => {
            const currentDt = container.__uploadDt;

            // 1. Sync input.files (for NEW files)
            if (currentDt) {
                const filesByKey = new Map();
                Array.from(currentDt.files).forEach(file => {
                    const key = `${String(file.name || '').toLowerCase()}__${file.size}`;
                    filesByKey.set(key, file);
                });

                const newDt = new DataTransfer();
                Array.from(grid.querySelectorAll('[data-file-key]')).forEach(child => {
                    const key = child.getAttribute('data-file-key');
                    if (!key) return;
                    const file = filesByKey.get(key);
                    if (file) newDt.items.add(file);
                });

                container.__uploadDt = newDt;
                input.files = newDt.files;
            }

            // 2. Sync Hidden Order Input (for ALL files - Existing + New)
            const orderInput = container.querySelector('.upload-order-input');
            if (orderInput) {
                const order = [];
                Array.from(grid.children).forEach(child => {
                    if (child.dataset.existingItem === 'true') {
                        const hiddenVal = child.querySelector('input[type="hidden"]')?.value;
                        if (hiddenVal) {
                            order.push(`existing:${hiddenVal}`);
                        }
                    } else if (child.dataset.fileKey) {
                        const fileName = child.dataset.fileName;
                        if (fileName) {
                            order.push(`new:${fileName}`);
                        }
                    }
                });
                orderInput.value = JSON.stringify(order);
            }
        };

        container.addEventListener('upload:updated', () => {
            syncFilesOrderToDom();
        });

        grid.addEventListener('dragstart', (e) => {
            const item = getSortableItem(e.target);
            if (!item) return;
            draggedItem = item;
            e.dataTransfer.effectAllowed = 'move';

            // Delay adding class to avoid showing it in the ghost image
            setTimeout(() => {
                item.classList.add('opacity-40', 'scale-95', 'border-yellow-400', 'z-50');
            }, 0);
        });

        grid.addEventListener('dragend', () => {
            if (draggedItem) {
                draggedItem.classList.remove('opacity-40', 'scale-95', 'border-yellow-400', 'z-50');
            }
            draggedItem = null;
        });

        grid.addEventListener('dragover', (e) => {
            if (!draggedItem) return;
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';

            const overItem = getSortableItem(e.target);
            if (!overItem || overItem === draggedItem) return;

            // Hyper-sensitive: Langsung pindah saat kursor masuk area item lain
            const items = Array.from(grid.children);
            if (items.indexOf(draggedItem) < items.indexOf(overItem)) {
                overItem.after(draggedItem);
            } else {
                overItem.before(draggedItem);
            }
        });

        grid.addEventListener('drop', (e) => {
            if (!draggedItem) return;
            e.preventDefault();
            syncFilesOrderToDom();
        });
    });
}
