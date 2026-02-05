/**
 * Form Upload Preview Helper
 * Menangani preview gambar pada komponen upload-image (Single & Multiple)
 */

import { openConfirm, showToast } from '../../ui/notifications';

const MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB

export function initUploadPreview() {
    const uploadContainers = document.querySelectorAll('[data-component="upload-image"]');

    uploadContainers.forEach(container => {
        if (container.dataset.uploadPreviewInit === '1') return;
        container.dataset.uploadPreviewInit = '1';

        const isMultiple = container.dataset.multiple === 'true';
        const maxFiles = parseInt(container.dataset.maxFiles || '0', 10); // 0 means no limit (or default behavior)
        const input = container.querySelector('.upload-input');
        const placeholder = container.querySelector('.upload-placeholder');

        // Mode Containers
        const singlePreviewContainer = container.querySelector('.upload-preview-container');
        const multipleGridContainer = container.querySelector('.upload-grid-container');

        // Single Mode Specific
        const singlePreviewImage = container.querySelector('.upload-preview-image');
        const singleRemoveBtn = container.querySelector('.upload-remove-btn');

        // Multiple Mode Specific
        const floatingAddBtn = container.querySelector('.upload-add-floating-btn');

        if (!input || !placeholder) return;

        const getFileKey = (file) => `${String(file.name || '').toLowerCase()}__${file.size}`;
        const getFileSignature = (file) => `${String(file.name || '').toLowerCase()}__${file.size}`;


        const getDt = () => {
            if (!container.__uploadDt) container.__uploadDt = new DataTransfer();
            return container.__uploadDt;
        };

        const setDt = (newDt) => {
            container.__uploadDt = newDt;
            input.files = newDt.files;
        };

        const syncMultipleFilesToDom = () => {
            if (!isMultiple || !multipleGridContainer) return;
            const currentDt = getDt();
            const filesByKey = new Map();
            Array.from(currentDt.files).forEach((file) => {
                filesByKey.set(getFileKey(file), file);
            });

            const newDt = new DataTransfer();
            Array.from(multipleGridContainer.querySelectorAll('[data-file-key]')).forEach((el) => {
                const key = String(el.dataset.fileKey || '');
                if (!key) return;
                const file = filesByKey.get(key);
                if (file) newDt.items.add(file);
            });

            setDt(newDt);
        };

        const updateLayoutState = () => {
            if (!isMultiple || !multipleGridContainer) return;

            const existingCount = multipleGridContainer.querySelectorAll('[data-existing-item="true"]').length;
            const newCount = multipleGridContainer.querySelectorAll('[data-file-key]').length;
            const totalCount = existingCount + newCount;

            // Toggle floating Add button
            if (floatingAddBtn) {
                if (totalCount > 0) {
                    floatingAddBtn.classList.remove('hidden');
                } else {
                    floatingAddBtn.classList.add('hidden');
                }
            }

            // Aturan Single View jika hanya ada 1 gambar agar tingginya FULL & identik dengan single-mode
            if (totalCount === 1) {
                multipleGridContainer.classList.remove('sm:grid-cols-2', 'p-4', 'gap-4');
                multipleGridContainer.classList.add('grid-cols-1', 'h-full', 'p-2', 'sm:p-3');

                const singleItem = multipleGridContainer.querySelector('[data-existing-item="true"], [data-file-key]');
                if (singleItem) {
                    singleItem.classList.remove('aspect-video', 'rounded-lg');
                    singleItem.classList.add('h-full', 'w-full', 'rounded-md');
                }
            } else if (totalCount > 1) {
                multipleGridContainer.classList.remove('h-full', 'p-2', 'sm:p-3');
                multipleGridContainer.classList.add('sm:grid-cols-2', 'p-4', 'gap-4');
                multipleGridContainer.classList.remove('grid-cols-1');

                multipleGridContainer.querySelectorAll('[data-existing-item="true"], [data-file-key]').forEach(item => {
                    item.classList.add('aspect-video', 'rounded-lg');
                    item.classList.remove('h-full', 'w-full', 'rounded-md');
                });
            }
        };

        // Jalankan awal untuk kondisi existing
        if (isMultiple) {
            updateLayoutState();

            if (floatingAddBtn) {
                floatingAddBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    input.click();
                });
            }
        }

        if (isMultiple && multipleGridContainer) {
            container.addEventListener('click', (event) => {
                const removeBtn = event.target.closest?.('.remove-item-btn');
                if (!removeBtn) return;

                event.preventDefault();
                event.stopPropagation();

                const isExisting = removeBtn.dataset.existing === 'true';
                if (isExisting) {
                    const existingItem = removeBtn.closest?.('[data-existing-item="true"]');
                    if (existingItem) existingItem.remove();
                } else {
                    const item = removeBtn.closest?.('[data-file-key]');
                    if (item) item.remove();
                    syncMultipleFilesToDom();
                }

                container.dispatchEvent(new CustomEvent('upload:updated'));

                const remainingExisting = multipleGridContainer.querySelectorAll('[data-existing-item="true"]').length;
                const remainingNew = multipleGridContainer.querySelectorAll('[data-file-key]').length;
                const currentDt = getDt();

                if (currentDt.files.length === 0 && remainingExisting === 0 && remainingNew === 0) {
                    placeholder.classList.remove('hidden');
                    multipleGridContainer.classList.add('hidden');
                    multipleGridContainer.classList.remove('grid');
                }

                updateLayoutState();
            });
        }

        // --- HANDLER: DRAG & DROP ---
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            container.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            container.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            container.addEventListener(eventName, unhighlight, false);
        });

        const label = container.querySelector('label');

        function highlight(e) {
            if (e.dataTransfer && e.dataTransfer.types && Array.from(e.dataTransfer.types).includes('Files')) {
                if (label) {
                    label.classList.add('border-yellow-400', 'bg-gray-100');
                }
                e.dataTransfer.dropEffect = 'copy';
            }
        }

        function unhighlight(e) {
            if (label) {
                label.classList.remove('border-yellow-400', 'bg-gray-100');
            }
        }

        // Handle Drop
        container.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = Array.from(dt.files);

            if (files.length === 0) return;

            if (isMultiple) {
                handleMultipleSelection(files);
            } else {
                const file = files[0];
                const newDt = new DataTransfer();
                newDt.items.add(file);
                input.files = newDt.files;
                input.dispatchEvent(new Event('change', { bubbles: true }));
                handleSingleSelection(file);
            }
        }

        // --- HANDLER: FILE SELECTION ---
        input.addEventListener('change', function (e) {
            const files = Array.from(this.files);
            if (files.length === 0) return;

            if (isMultiple) {
                // Jangan reset value di sini karena akan menghapus input.files yang sudah ada
                handleMultipleSelection(files);
            } else {
                handleSingleSelection(files[0]);
            }
        });

        // --- SUB-HANDLER: SINGLE ---
        function handleSingleSelection(file) {
            if (!singlePreviewContainer || !singlePreviewImage || !singleRemoveBtn) return;
            if (file.size > MAX_FILE_SIZE) {
                showToast(`Gagal: File "${file.name}" terlalu besar! Maksimal ukuran file adalah 10MB.`, { type: 'error', duration: 4500 });
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                singlePreviewImage.src = e.target.result;
                placeholder.classList.add('hidden');
                singlePreviewContainer.classList.remove('hidden');
                singleRemoveBtn.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        // --- SUB-HANDLER: MULTIPLE ---
        async function handleMultipleSelection(files) {
            if (!multipleGridContainer) return;

            const existingCount = multipleGridContainer.querySelectorAll('[data-existing-item="true"]').length;
            const dt = getDt();
            const currentNewCount = dt.files.length;
            const totalCurrent = existingCount + currentNewCount;

            // Batas keras keamanan (Security Hard Limit) untuk mencegah spam/lag browser
            // Jika maxFiles diset, gunakan itu sebagai patokan (misal max 6, maka batas keras 12)
            const resolvedMax = maxFiles > 0 ? maxFiles : 20;
            const hardLimit = resolvedMax * 2;

            if (files.length > hardLimit) {
                showToast(`Terdeteksi ${files.length} file. Demi keamanan dan stabilitas, sistem hanya memproses ${resolvedMax} file pertama.`, { type: 'warning', duration: 4500 });
                files = files.slice(0, resolvedMax);
            }

            // Check Max Files Limit (Specific for UX)
            if (maxFiles > 0) {
                const availableSlots = maxFiles - totalCurrent;

                if (availableSlots <= 0) {
                    showToast(`Batas maksimal total adalah ${maxFiles} gambar. Silakan hapus beberapa gambar yang ada jika ingin menggantinya.`, { type: 'warning', duration: 4500 });
                    input.value = '';
                    return;
                }

                if (files.length > availableSlots) {
                    if (totalCurrent > 0) {
                        showToast(`Batas maksimal total adalah ${maxFiles} gambar. Karena sudah ada ${totalCurrent} gambar, hanya ${availableSlots} gambar baru yang akan ditambahkan.`, { type: 'warning', duration: 4500 });
                    } else {
                        showToast(`Batas maksimal total adalah ${maxFiles} gambar. Hanya ${maxFiles} gambar pertama yang akan diproses.`, { type: 'warning', duration: 4500 });
                    }
                    files = files.slice(0, availableSlots);
                }
            }

            let duplicateCount = 0;
            let duplicateExistingCount = 0;

            const existingNames = new Set(
                Array.from(container.querySelectorAll('input[type="hidden"][name$="_existing[]"]'))
                    .map((el) => String(el.value || ''))
                    .map((path) => {
                        const normalized = path.replace(/\\/g, '/');
                        const last = normalized.split('/').pop() || '';
                        return decodeURIComponent(last);
                    })
                    .filter(Boolean)
                    .map((name) => name.toLowerCase())
            );

            const seenFileKeys = new Set(Array.from(dt.files).map(getFileKey));
            const seenSignatures = new Set(Array.from(dt.files).map(getFileSignature));
            const seenNames = new Set(Array.from(dt.files).map((f) => String(f.name || '').toLowerCase()));

            const processedFiles = [];
            files.forEach(file => {
                const nameLower = String(file.name || '').toLowerCase();
                const fileKey = getFileKey(file);
                const signature = getFileSignature(file);

                if (existingNames.has(nameLower)) {
                    duplicateExistingCount += 1;
                    return;
                }

                const isDuplicate = seenFileKeys.has(fileKey) || seenSignatures.has(signature) || seenNames.has(nameLower);
                if (isDuplicate) {
                    duplicateCount += 1;
                    return;
                }

                // Validate individual file size
                if (file.size > MAX_FILE_SIZE) {
                    showToast(`Gagal: File "${file.name}" terlalu besar! Maksimal ukuran file adalah 10MB.`, { type: 'error', duration: 4500 });
                    return;
                }

                dt.items.add(file);
                processedFiles.push({ file, fileKey, signature });

                seenFileKeys.add(fileKey);
                seenSignatures.add(signature);
                seenNames.add(nameLower);
            });

            // SINKRONISASI SEGERA: Update input.files sebelum melakukan operasi async
            setDt(dt);
            // input.value = ''; // DIHAPUS: Ini menyebabkan input.files terhapus di beberapa browser

            // Jalankan preview secara async
            const renderPromises = processedFiles.map(item =>
                renderMultiplePreview(item.file, item.fileKey, item.signature)
            );

            await Promise.all(renderPromises);

            placeholder.classList.add('hidden');
            multipleGridContainer.classList.remove('hidden');
            multipleGridContainer.classList.add('grid');

            updateLayoutState();

            container.dispatchEvent(new CustomEvent('upload:updated'));

            const duplicateTotal = duplicateCount + duplicateExistingCount;
            if (duplicateTotal > 0) {
                if (duplicateTotal === 1) {
                    showToast('Ada 1 file duplikat yang diabaikan.', { type: 'warning', duration: 3500 });
                } else {
                    showToast(`Ada ${duplicateTotal} file duplikat yang diabaikan.`, { type: 'warning', duration: 3500 });
                }
            }
        }

        function renderMultiplePreview(file, fileKey, signature) {
            return new Promise((resolve) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const previewId = `item-${Math.random().toString(36).substr(2, 9)}`;
                    const itemHtml = `
                        <div class="relative group/item aspect-video rounded-lg overflow-hidden border border-gray-200 bg-white" data-preview-id="${previewId}" data-file-key="${fileKey}" data-file-signature="${signature}" data-file-name="${String(file.name || '').replace(/"/g, '&quot;')}"  draggable="true">
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            <button type="button" class="absolute top-1 right-1 w-5 h-5 bg-red-600 text-white rounded-full flex items-center justify-center p-0 shadow-md hover:bg-red-700 transition-colors z-20 remove-item-btn">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover/item:opacity-100 transition-opacity pointer-events-none"></div>
                        </div>
                    `;
                    multipleGridContainer.insertAdjacentHTML('beforeend', itemHtml);
                    resolve();
                };
                reader.readAsDataURL(file);
            });
        }

        // --- HANDLER: REMOVE SINGLE ---
        if (singleRemoveBtn) {
            singleRemoveBtn.addEventListener('click', async (e) => {
                e.preventDefault();
                e.stopPropagation();

                if (container.dataset.confirmRemove === '1') {
                    const confirmed = await openConfirm({
                        title: container.dataset.confirmRemoveTitle || 'Konfirmasi',
                        message: container.dataset.confirmRemoveMessage || 'Hapus gambar ini?',
                        okText: container.dataset.confirmRemoveOk || 'Hapus',
                        cancelText: container.dataset.confirmRemoveCancel || 'Batal',
                        variant: container.dataset.confirmRemoveVariant || 'danger',
                    });
                    if (!confirmed) return;
                }

                input.value = '';
                singlePreviewImage.src = '';
                placeholder.classList.remove('hidden');
                singlePreviewContainer.classList.add('hidden');
                singleRemoveBtn.classList.add('hidden');
                const removeFlag = container.querySelector(`input[type="hidden"][name="${input.name}_remove"]`);
                if (removeFlag) removeFlag.value = '1';
                const existingHidden = container.querySelector(`input[type="hidden"][name="${input.name}_existing"]`);
                if (existingHidden) existingHidden.remove();
                input.dispatchEvent(new Event('change', { bubbles: true }));
                container.dispatchEvent(new CustomEvent('upload:updated'));
            });
        }
        // --- SINKRONISASI AKHIR SAAT SUBMIT ---
        const form = container.closest('form');
        if (form) {
            form.addEventListener('submit', () => {
                if (isMultiple) {
                    syncMultipleFilesToDom();
                }
            });
        }
    });
}
