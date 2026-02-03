/**
 * change-detection.js
 *
 * Tujuan utama:
 * - Mengatur state tombol submit (Publish/Simpan) berdasarkan kelengkapan form.
 * - Mendukung mode Draft: tombol "Simpan" aktif hanya jika minimal ada 1 input/file terisi.
 * - Mendukung hide section tertentu saat Draft dengan atribut data-hide-on-draft="true".
 */

/**
 * Cek apakah sebuah element sedang "terlihat" secara UI.
 * Dipakai untuk mengabaikan field yang tidak tampil (misalnya hidden/collapse),
 * supaya tidak ikut mempengaruhi validasi tombol.
 */
const isVisible = (element) => {
    if (!element) return false;
    const style = window.getComputedStyle(element);
    if (style.display === 'none' || style.visibility === 'hidden' || style.opacity === '0') return false;
    if (element.closest('[hidden]')) return false;
    if (element.offsetParent === null && style.position !== 'fixed') return false;
    return true;
};

/**
 * Versi "isVisible" khusus untuk validasi field.
 * Untuk input file yang disembunyikan (class hidden), validasinya tetap dianggap visible
 * selama container upload-image-nya terlihat.
 */
const isFieldVisibleForValidation = (field) => {
    if (!field) return false;
    if (field.type === 'file' && field.classList.contains('upload-input')) {
        const uploadContainer = field.closest('[data-component="upload-image"]');
        return isVisible(uploadContainer);
    }
    return isVisible(field);
};

/**
 * Cari tombol submit yang terhubung dengan form.
 * Diprioritaskan tombol dengan atribut form="form-id" agar tetap bekerja walau tombol di luar tag <form>.
 */
const getSubmitButtonForForm = (form) => {
    if (!form?.id) return null;
    return (
        document.querySelector(`button[type="submit"][form="${form.id}"]`) ||
        form.querySelector('button[type="submit"]') ||
        document.querySelector(`button[form="${form.id}"]`)
    );
};

/**
 * Set disabled/enabled tombol + mengatur class visualnya.
 * - disabled: tambah opacity + non-clickable
 * - enabled: hapus class tersebut
 */
const setButtonDisabled = (button, disabled) => {
    if (!button) return;
    button.disabled = !!disabled;
    if (disabled) {
        button.classList.add('opacity-50', 'pointer-events-none');
    } else {
        button.classList.remove('opacity-50', 'pointer-events-none');
    }
};

/**
 * Set label tombol.
 * Tombol kita biasanya punya <span> (karena komponen button menggunakan slot icon + text),
 * jadi utamakan ubah span text, fallback ke button.textContent.
 */
const setButtonLabel = (button, label) => {
    if (!button) return;
    const span = button.querySelector('span');
    if (span) {
        span.textContent = label;
        return;
    }
    button.textContent = label;
};

const getFormSnapshot = (form) => {
    const parts = [];

    const fields = Array.from(form.querySelectorAll('input, textarea, select'));
    fields.forEach((field) => {
        const name = field.getAttribute('name') || '';
        if (!name) return;

        const type = (field.getAttribute('type') || '').toLowerCase();
        if (name === '_token' || name === '_method') return;

        if (type === 'file') {
            const fileSignatures = Array.from(field.files || []).map((f) => `${String(f.name || '').toLowerCase()}__${f.size}`);
            parts.push(`${name}::file::${fileSignatures.join('|')}`);

            const uploadContainer = field.closest('[data-component="upload-image"]');
            if (uploadContainer) {
                const previewContainer = uploadContainer.querySelector('.upload-preview-container');
                if (previewContainer) {
                    parts.push(`${name}::previewVisible::${previewContainer.classList.contains('hidden') ? '0' : '1'}`);
                }
                const previewImage = uploadContainer.querySelector('.upload-preview-container .upload-preview-image');
                if (previewImage) {
                    parts.push(`${name}::previewSrc::${String(previewImage.getAttribute('src') || '')}`);
                }
                const baseName = name.endsWith('[]') ? name.slice(0, -2) : name;
                const existingMultiName = `${baseName}_existing[]`;
                const existingSingleName = `${baseName}_existing`;
                const existingInputs = Array.from(uploadContainer.querySelectorAll(`input[type="hidden"][name="${existingMultiName}"], input[type="hidden"][name="${existingSingleName}"]`)).map((el) => String(el.value || ''));
                if (existingInputs.length > 0) {
                    parts.push(`${name}::existing::${existingInputs.join('|')}`);
                }
                const removeFlag = uploadContainer.querySelector(`input[type="hidden"][name="${baseName}_remove"]`);
                if (removeFlag) {
                    parts.push(`${name}::remove::${String(removeFlag.value || '')}`);
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

/**
 * Rule Draft:
 * Tombol Simpan hanya boleh enable jika minimal ada "isi".
 * Yang dianggap isi:
 * - Minimal satu input/textarea berisi (selain field teknis seperti _token/_method/status).
 * - ATAU ada file baru yang dipilih pada input[type=file].
 */
const getDraftHasAnyContent = (form) => {
    const textFields = Array.from(form.querySelectorAll('input, textarea'));
    const hasText = textFields.some((field) => {
        if (!isFieldVisibleForValidation(field)) return false;
        const type = (field.getAttribute('type') || '').toLowerCase();
        if (type === 'hidden' || type === 'checkbox' || type === 'radio' || type === 'file' || type === 'submit' || type === 'button') return false;
        const name = (field.getAttribute('name') || '').toLowerCase();
        if (name === '_token' || name === '_method') return false;
        if (name === 'status') return false;
        return String(field.value || '').trim() !== '';
    });

    const hasNewFile = Array.from(form.querySelectorAll('input[type="file"]')).some((field) => {
        if (!isFieldVisibleForValidation(field)) return false;
        return field.files && field.files.length > 0;
    });

    return hasText || hasNewFile;
};

/**
 * Terapkan mode Draft / non-Draft pada form.
 * - Sembunyikan tanda bintang (*) pada label required (data-required-indicator="true")
 * - Saat draft, aktifkan form.noValidate supaya HTML5 validation tidak memblok submit.
 * - Sembunyikan section tertentu yang tidak relevan saat draft (data-hide-on-draft="true"),
 *   sekaligus reset nilainya supaya tidak ikut terkirim.
 */
const applyDraftMode = (form, isDraft) => {
    const requiredIndicators = form.querySelectorAll('[data-required-indicator="true"]');
    requiredIndicators.forEach((el) => {
        if (isDraft) el.classList.add('hidden');
        else el.classList.remove('hidden');
    });
    form.noValidate = !!isDraft;

    const draftHiddenBlocks = form.querySelectorAll('[data-hide-on-draft="true"]');
    draftHiddenBlocks.forEach((block) => {
        if (isDraft) block.classList.add('hidden');
        else block.classList.remove('hidden');

        if (!isDraft) return;

        const checkboxes = block.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach((input) => {
            if (!input.checked) return;
            input.checked = false;
            input.dispatchEvent(new Event('change', { bubbles: true }));
        });

        const clearableInputs = block.querySelectorAll('input[type="date"], input[type="time"], input[type="text"], textarea');
        clearableInputs.forEach((input) => {
            if (String(input.value || '') === '') return;
            input.value = '';
            input.dispatchEvent(new Event('input', { bubbles: true }));
            input.dispatchEvent(new Event('change', { bubbles: true }));
        });
    });
};

/**
 * Validasi nilai sebuah field.
 * - Field yang tidak terlihat dianggap "OK" (tidak menghalangi tombol).
 * - File: valid jika ada file baru, atau ada preview/existing item (edit form).
 * - Checkbox/radio: valid jika checked.
 * - Select/text/textarea: valid jika value tidak kosong.
 */
const getFieldValueOk = (field, form) => {
    if (field.type === 'checkbox' || field.type === 'radio') {
        if (!isFieldVisibleForValidation(field)) return true;
        return field.checked;
    }

    if (field.type === 'file') {
        if (!isFieldVisibleForValidation(field)) return true;
        if (field.files && field.files.length > 0) return true;

        const uploadContainer = field.closest('[data-component="upload-image"]');
        if (!uploadContainer) return false;

        const baseName = (field.getAttribute('name') || '').endsWith('[]')
            ? (field.getAttribute('name') || '').slice(0, -2)
            : (field.getAttribute('name') || '');
        const removeFlag = baseName ? uploadContainer.querySelector(`input[type="hidden"][name="${baseName}_remove"]`) : null;
        if (removeFlag && String(removeFlag.value || '') === '1') return false;

        const singlePreview = uploadContainer.querySelector('.upload-preview-container');
        if (singlePreview && !singlePreview.classList.contains('hidden')) return true;

        const grid = uploadContainer.querySelector('.upload-grid-container');
        if (grid && grid.querySelectorAll('[data-existing-item="true"]').length > 0) return true;

        const name = field.getAttribute('name') || '';
        if (name.endsWith('[]')) return false;
        const existingKeySingle = `${name}_existing`;
        if (form.querySelectorAll(`input[type="hidden"][name="${existingKeySingle}"]`).length > 0) return true;

        return false;
    }

    if (field.tagName === 'SELECT') {
        if (!isFieldVisibleForValidation(field)) return true;
        return String(field.value || '').trim() !== '';
    }

    if (!isFieldVisibleForValidation(field)) return true;
    return String(field.value || '').trim() !== '';
};

/**
 * Ambil daftar field yang dianggap "wajib" untuk mode Publish.
 * Patokannya:
 * - Atribut HTML [required]
 * - atau data-required="true" (khusus input file dari upload-image component)
 */
const getRequiredFields = (form) => {
    const required = Array.from(form.querySelectorAll('[required], [data-required="true"]'));
    return required.filter((field) => {
        const name = field.getAttribute('name') || '';
        if (name === 'published_date' || name === 'published_time') return true;
        return true;
    });
};

/**
 * Inisialisasi change detection untuk 1 form.
 * - Hanya aktif jika ada select[name=status] (publish/draft).
 * - Memasang listener input/change agar tombol selalu mengikuti kondisi form.
 * - Memasang MutationObserver pada upload-image supaya tombol update saat preview berubah.
 */
const initFormChangeDetection = (form) => {
    if (form.dataset.changeDetectionInit === '1') return;
    form.dataset.changeDetectionInit = '1';

    const statusSelect = form.querySelector('select[name="status"]');
    if (!statusSelect) return;

    const submitBtn = getSubmitButtonForForm(form);
    if (!submitBtn) return;

    const originalLabel = (submitBtn.querySelector('span')?.textContent || submitBtn.textContent || '').trim();
    if (!submitBtn.dataset.originalLabel) submitBtn.dataset.originalLabel = originalLabel || 'Publish';

    const initialStatus = String(statusSelect.value || '').toLowerCase();
    const isDraftLike = initialStatus === 'draft' || initialStatus === 'nonaktif';
    applyDraftMode(form, isDraftLike);
    form.dataset.changeDetectionLastStatus = initialStatus;
    form.__initialSnapshot = getFormSnapshot(form);

    /**
     * scheduleUpdate:
     * Menggunakan debounce (delay 300ms) untuk mengurangi beban validasi berat.
     * Validasi tidak perlu berjalan setiap frame (16ms) saat user mengetik cepat.
     */
    let debounceTimer;
    const scheduleUpdate = () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            updateButtonState();
        }, 300);
    };

    /**
     * updateButtonState:
     * 1) Cek status (draft/publish)
     * 2) Jika draft: label "Simpan" + enable hanya bila ada isi minimal 1 field/file
     * 3) Jika publish: label kembali ke original + enable hanya bila semua field required OK
     */
    const updateButtonState = () => {
        const status = String(statusSelect.value || '').toLowerCase();
        if (form.dataset.changeDetectionLastStatus !== status) {
            const isDraftLike = status === 'draft' || status === 'nonaktif';
            applyDraftMode(form, isDraftLike);
            form.dataset.changeDetectionLastStatus = status;
        }

        const isDirty = getFormSnapshot(form) !== (form.__initialSnapshot || '');

        if (status === 'draft' || status === 'nonaktif') {
            setButtonLabel(submitBtn, status === 'nonaktif' ? 'Simpan' : 'Simpan'); // Both use Simpan
            const canSave = getDraftHasAnyContent(form);
            setButtonDisabled(submitBtn, !(canSave && isDirty));
            return;
        }

        setButtonLabel(submitBtn, submitBtn.dataset.originalLabel || 'Publish');

        const requiredFields = getRequiredFields(form).filter((field) => {
            if (field.hasAttribute('required') || field.dataset.required === 'true') {
                return isFieldVisibleForValidation(field);
            }
            // Khusus penjadwalan: Jika checkbox 'is_scheduled' dicentang, maka 'published_date' dan 'published_time' wajib
            const name = field.getAttribute('name') || '';
            if (name === 'published_date' || name === 'published_time') {
                const scheduleCheckbox = form.querySelector('input[name="is_scheduled"]');
                if (scheduleCheckbox && scheduleCheckbox.checked) {
                    return true;
                }
            }
            return false;
        });

        const allOk = requiredFields.every((field) => getFieldValueOk(field, form));
        setButtonDisabled(submitBtn, !(allOk && isDirty));
    };

    const inputHandler = () => scheduleUpdate();
    form.addEventListener('input', inputHandler, true);
    form.addEventListener('change', inputHandler, true);

    /**
     * Observer untuk komponen upload-image:
     * Ketika DOM preview berubah (mis. tambah/hapus gambar), tombol harus dihitung ulang.
     * Observer dibuat ringan (tanpa observe attributes) untuk menjaga performa.
     */
    const uploadContainers = form.querySelectorAll('[data-component="upload-image"]');
    uploadContainers.forEach((container) => {
        const observer = new MutationObserver(() => scheduleUpdate());
        observer.observe(container, { childList: true, subtree: true });
    });

    updateButtonState();
};

/**
 * Entry point modul:
 * Jalankan change detection untuk semua form yang punya id.
 * (Namun hanya form yang memiliki select[name=status] yang akan aktif).
 */
export function initChangeDetection() {
    const forms = Array.from(document.querySelectorAll('form[id]'));
    forms.forEach(initFormChangeDetection);
}
