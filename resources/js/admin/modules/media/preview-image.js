export function initPreviewImageModal() {
    if (window.__adminPreviewImageModalInit) return;
    window.__adminPreviewImageModalInit = true;

    const modal = document.querySelector('[data-image-preview-modal]');
    const modalContent = document.querySelector('[data-image-preview-content]');
    const closeBtn = document.querySelector('[data-image-preview-close]');
    const previewImage = document.getElementById('previewImage');

    if (!modal || !modalContent || !closeBtn || !previewImage) return;

    const open = (src) => {
        if (!src) return;
        previewImage.src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.documentElement.classList.add('overflow-hidden');
        document.body.classList.add('overflow-hidden');
    };

    const close = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        previewImage.src = '';
        document.documentElement.classList.remove('overflow-hidden');
        document.body.classList.remove('overflow-hidden');
    };

    closeBtn.addEventListener('click', (e) => {
        e.preventDefault();
        close();
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) close();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) close();
    });

    document.addEventListener(
        'pointerdown',
        (e) => {
            const trigger = e.target?.closest?.('[data-image-preview-trigger]');
            if (!trigger) return;
            e.preventDefault();
            e.stopPropagation();
        },
        true,
    );

    document.addEventListener(
        'dragstart',
        (e) => {
            const trigger = e.target?.closest?.('[data-image-preview-trigger]');
            if (!trigger) return;
            e.preventDefault();
            e.stopPropagation();
        },
        true,
    );

    document.addEventListener('click', (e) => {
        if (!e.target) return;

        const trigger = e.target.closest?.('[data-image-preview-trigger]');
        if (trigger) {
            const src = trigger.getAttribute('data-image-preview-src') || trigger.getAttribute('data-preview-src');
            if (!src) return;
            e.preventDefault();
            e.stopPropagation();
            open(src);
            return;
        }

        const img = e.target.closest?.('[data-component="upload-image"] img');
        if (!img) return;

        const removeBtn = e.target.closest?.('.remove-item-btn, .upload-remove-btn');
        if (removeBtn) return;

        if (modal.contains(img)) return;

        const inSinglePreview = !!img.closest?.('.upload-preview-container');
        const inMultiplePreview = !!img.closest?.('.upload-grid-container');
        if (!inSinglePreview && !inMultiplePreview) return;

        const src = img.getAttribute('src');
        if (!src) return;

        e.preventDefault();
        e.stopPropagation();
        open(src);
    });
}
