const shouldIgnoreForm = (form) => {
    if (!form) return true;
    if (form.hasAttribute('data-no-unsaved-warning')) return true;
    if (form.closest('[data-no-unsaved-warning]')) return true;

    const method = String(form.getAttribute('method') || form.method || '').toLowerCase();
    if (method === 'get') return true;

    const hasFields = form.querySelector('input, textarea, select');
    return !hasFields;
};

const getFormSnapshot = (form) => {
    const parts = [];
    const fields = Array.from(form.querySelectorAll('input, textarea, select'));

    fields.forEach((field) => {
        const name = field.getAttribute('name') || '';
        if (!name) return;
        if (name === '_token' || name === '_method') return;

        const type = String(field.getAttribute('type') || '').toLowerCase();
        if (type === 'file') {
            const fileSignatures = Array.from(field.files || []).map((f) => `${String(f.name || '').toLowerCase()}__${f.size}`);
            parts.push(`${name}::file::${fileSignatures.join('|')}`);

            const uploadContainer = field.closest?.('[data-component="upload-image"]');
            if (uploadContainer) {
                const baseName = name.endsWith('[]') ? name.slice(0, -2) : name;
                const existingMultiName = `${baseName}_existing[]`;
                const existingSingleName = `${baseName}_existing`;

                const existingInputs = Array.from(
                    uploadContainer.querySelectorAll(
                        `input[type="hidden"][name="${existingMultiName}"], input[type="hidden"][name="${existingSingleName}"]`,
                    ),
                ).map((el) => String(el.value || ''));
                if (existingInputs.length > 0) {
                    parts.push(`${name}::existing::${existingInputs.join('|')}`);
                }

                const removeFlag = uploadContainer.querySelector(`input[type="hidden"][name="${baseName}_remove"]`);
                if (removeFlag) {
                    parts.push(`${name}::remove::${String(removeFlag.value || '')}`);
                }

                const order = uploadContainer.querySelector(`input[type="hidden"][name="${baseName}_order"]`);
                if (order) {
                    parts.push(`${name}::order::${String(order.value || '')}`);
                }
            }

            return;
        }

        if (field.type === 'checkbox' || field.type === 'radio') {
            parts.push(`${name}::checked::${field.checked ? '1' : '0'}`);
            return;
        }

        parts.push(`${name}::value::${String(field.value ?? '')}`);
    });

    return parts.sort().join('||');
};

const getDirtyForms = () => {
    const forms = Array.from(document.querySelectorAll('form'));
    return forms
        .filter((form) => !shouldIgnoreForm(form))
        .filter((form) => {
            const initial = form.__unsavedInitialSnapshot || '';
            return getFormSnapshot(form) !== initial;
        });
};

const getPrimaryDirtyForm = () => {
    const dirty = getDirtyForms();
    if (dirty.length === 0) return null;

    const visible = dirty.find((form) => form.offsetParent !== null);
    return visible || dirty[0];
};

const getSubmitButtonForForm = (form) => {
    if (!form) return null;
    return (
        (form.id ? document.querySelector(`button[type="submit"][form="${form.id}"]`) : null) ||
        form.querySelector('button[type="submit"]') ||
        (form.id ? document.querySelector(`button[form="${form.id}"]`) : null)
    );
};

const getButtonLabel = (button) => {
    if (!button) return '';
    const span = button.querySelector('span');
    const text = (span ? span.textContent : button.textContent) || '';
    return String(text).replace(/\s+/g, ' ').trim();
};

export function initUnsavedChangesWarning() {
    if (window.__adminUnsavedChangesInit) return;
    window.__adminUnsavedChangesInit = true;

    const modal = document.getElementById('confirm-modal');
    const modalMessage = document.getElementById('modal-message');
    const cancelBtn = document.getElementById('modal-cancel-btn');
    const discardBtn = document.getElementById('modal-discard-btn');
    const saveBtn = document.getElementById('modal-save-btn');
    const saveBtnText = document.getElementById('modal-save-btn-text');

    if (!modal || !cancelBtn || !discardBtn || !saveBtn || !saveBtnText) return;

    const trackedForms = Array.from(document.querySelectorAll('form')).filter((form) => !shouldIgnoreForm(form));
    trackedForms.forEach((form) => {
        if (form.dataset.unsavedWarningInit === '1') return;
        form.dataset.unsavedWarningInit = '1';

        // DETEKSI ERROR VALIDASI SERVER (Laravel)
        // Jika form punya .is-invalid (error field) atau .alert-danger (error global),
        // berarti form ini "baru saja gagal submit". 
        // Kita anggap form ini "Dirty" (Unsaved) secara default, kecuali jika user belum mengubah apa-apa dari data lama.
        // Tapi agar lebih aman (user mau pindah/batal), kita set initial snapshot berbeda agar terdeteksi beda.
        const hasServerErrors = form.querySelector('.is-invalid, .text-red-600, .bg-red-100, .alert-danger');
        
        if (hasServerErrors) {
            // Trik: Set initial snapshot kosong agar snapshot saat ini (yang berisi data old input) dianggap "beda"
            // Jadi sistem akan menganggap form ini "Dirty" sejak awal load.
            form.__unsavedInitialSnapshot = 'force_dirty_state_due_to_error';
        } else {
            form.__unsavedInitialSnapshot = getFormSnapshot(form);
        }

        const scheduleUpdate = () => {
            clearTimeout(form.__unsavedUpdateTimer);
            form.__unsavedUpdateTimer = setTimeout(() => {
                form.__unsavedIsDirty = getFormSnapshot(form) !== (form.__unsavedInitialSnapshot || '');
            }, 150);
        };

        form.addEventListener('input', scheduleUpdate, true);
        form.addEventListener('change', scheduleUpdate, true);

        const uploadContainers = form.querySelectorAll('[data-component="upload-image"]');
        uploadContainers.forEach((container) => {
            const observer = new MutationObserver(() => scheduleUpdate());
            observer.observe(container, { childList: true, subtree: true });
        });

        form.addEventListener(
            'submit',
            (e) => {
                window.__adminUnsavedChangesSubmitting = true;

                // Safety fallback: jika dalam 10 detik halaman tidak berpindah (karena error validasi atau ajax),
                // kembalikan status submitting ke false agar warning aktif kembali.
                setTimeout(() => {
                    window.__adminUnsavedChangesSubmitting = false;
                }, 5000);
            },
            true,
        );

        // Listen in bubble phase to check if submit was prevented
        form.addEventListener('submit', (e) => {
            if (e.defaultPrevented) {
                window.__adminUnsavedChangesSubmitting = false;
            }
        });

        // Jika user kembali mengedit form (mengetik/klik), berarti submit batal/gagal
        const resetSubmitting = () => {
            if (window.__adminUnsavedChangesSubmitting) {
                window.__adminUnsavedChangesSubmitting = false;
            }
        };
        form.addEventListener('input', resetSubmitting);
        form.addEventListener('change', resetSubmitting);
        form.addEventListener('click', resetSubmitting);
    });

    let pendingNavigateTo = null;

    const setSaveButtonState = (form) => {
        const submitBtn = getSubmitButtonForForm(form);
        const label = getButtonLabel(submitBtn) || 'Simpan';
        saveBtnText.textContent = label;

        const canSubmit = !!submitBtn && !submitBtn.disabled;
        saveBtn.disabled = !canSubmit;
        if (saveBtn.disabled) {
            saveBtn.classList.add('opacity-50', 'pointer-events-none');
        } else {
            saveBtn.classList.remove('opacity-50', 'pointer-events-none');
        }

        if (modalMessage) {
            if (!submitBtn) {
                modalMessage.textContent = 'Tidak ditemukan tombol submit untuk menyimpan perubahan di halaman ini.';
            } else if (submitBtn.disabled) {
                modalMessage.textContent = 'Tombol simpan masih nonaktif. Lengkapi form terlebih dahulu, lalu coba lagi.';
            } else {
                modalMessage.textContent = 'Anda memiliki perubahan yang belum disimpan. Apakah Anda yakin ingin meninggalkan halaman ini?';
            }
        }
    };

    const openModal = () => {
        const form = getPrimaryDirtyForm();
        setSaveButtonState(form);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.documentElement.classList.add('overflow-hidden');
        document.body.classList.add('overflow-hidden');
    };

    const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.documentElement.classList.remove('overflow-hidden');
        document.body.classList.remove('overflow-hidden');
        pendingNavigateTo = null;
    };

    cancelBtn.addEventListener('click', (e) => {
        e.preventDefault();
        closeModal();
    });

    discardBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const url = pendingNavigateTo;
        closeModal();
        if (url) window.location.href = url;
    });

    saveBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const form = getPrimaryDirtyForm();
        closeModal();
        if (!form) return;

        const submitBtn = getSubmitButtonForForm(form);
        if (submitBtn && !submitBtn.disabled) {
            submitBtn.click();
            return;
        }

        if (typeof form.requestSubmit === 'function') {
            form.requestSubmit();
        }
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
    });

    document.addEventListener(
        'click',
        (e) => {
            const target = e.target instanceof Element ? e.target : e.target?.parentElement;
            const link = target?.closest?.('a[href]');
            if (!link) return;

            if (link.hasAttribute('data-no-unsaved-warning')) return;
            if (link.closest('[data-no-unsaved-warning]')) return;
            if (link.target && link.target !== '_self') return;

            const href = link.getAttribute('href') || '';
            if (!href || href === '#' || href.startsWith('javascript:')) return;
            if (href.startsWith('#')) return;

            const url = link.href;
            if (!url) return;

            if (window.__adminUnsavedChangesSubmitting) return;

            const hasDirty = getDirtyForms().length > 0;
            if (!hasDirty) return;

            e.preventDefault();
            e.stopPropagation();
            pendingNavigateTo = url;
            openModal();
        },
        true,
    );

    // intentionally no beforeunload handler
}
