const STORAGE_KEY = '__admin_next_toast__';

const ensureHost = () => {
    const modal = document.getElementById('public-notification-modal');
    const content = document.getElementById('public-notification-content');
    if (!modal || !content) return null;
    return { modal, content };
};

let hideTimerId = null;
let cleanupTimerId = null;
let showFrameId = null;

const clearToastTimers = () => {
    if (hideTimerId) window.clearTimeout(hideTimerId);
    if (cleanupTimerId) window.clearTimeout(cleanupTimerId);
    if (showFrameId) window.cancelAnimationFrame(showFrameId);
    hideTimerId = null;
    cleanupTimerId = null;
    showFrameId = null;
};

export const queueToast = (message, options = {}) => {
    const text = String(message || '').trim();
    if (!text) return;

    const payload = {
        message: text,
        type: options.type || 'success',
        duration: typeof options.duration === 'number' ? options.duration : 3000,
    };

    try {
        sessionStorage.setItem(STORAGE_KEY, JSON.stringify(payload));
    } catch {
        
    }
};

const consumeQueuedToast = () => {
    try {
        const raw = sessionStorage.getItem(STORAGE_KEY);
        if (!raw) return null;
        sessionStorage.removeItem(STORAGE_KEY);
        return JSON.parse(raw);
    } catch {
        return null;
    }
};

export const showToast = (message, options = {}) => {
    const text = String(message || '').trim();
    if (!text) return;

    const host = ensureHost();
    if (!host) return;

    const type = options.type || 'success';
    const duration = typeof options.duration === 'number' ? options.duration : 3000;

    clearToastTimers();

    const { modal, content } = host;

    const variant =
        type === 'error'
            ? 'bg-red-600 text-white'
            : type === 'warning'
                ? 'bg-yellow-500 text-white'
                : 'bg-green-700 text-white';

    const safeText = text
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');

    const html = `
        <div class="w-full flex justify-center px-3 pt-3">
            <div class="w-fit max-w-[calc(100vw-2rem)] rounded-lg shadow-lg ${variant}">
                <div class="px-4 py-3 text-sm font-semibold whitespace-normal break-words">${safeText}</div>
            </div>
        </div>
    `;

    content.innerHTML = html;
    modal.classList.remove('hidden');

    content.classList.remove('opacity-100', 'translate-y-0');
    content.classList.add('opacity-0', '-translate-y-3');

    showFrameId = window.requestAnimationFrame(() => {
        content.classList.remove('opacity-0', '-translate-y-3');
        content.classList.add('opacity-100', 'translate-y-0');
    });

    const hideDelay = Math.max(800, duration);
    hideTimerId = window.setTimeout(() => {
        content.classList.remove('opacity-100', 'translate-y-0');
        content.classList.add('opacity-0', '-translate-y-3');
    }, hideDelay);

    cleanupTimerId = window.setTimeout(() => {
        modal.classList.add('hidden');
        content.innerHTML = '';
    }, hideDelay + 350);
};

export const initToast = () => {
    const queued = consumeQueuedToast();
    if (queued?.message) {
        showToast(queued.message, { type: queued.type || 'success', duration: queued.duration || 3000 });
        return;
    }

    const flashError = document.querySelector('[data-flash-error]');
    const flashErrorMessage = flashError?.textContent?.trim();
    if (flashErrorMessage) {
        showToast(flashErrorMessage, { type: 'error', duration: 3500 });
        return;
    }

    const flashStatus = document.querySelector('[data-flash-status]');
    const flashStatusMessage = flashStatus?.textContent?.trim();
    if (!flashStatusMessage) return;
    showToast(flashStatusMessage, { type: 'success', duration: 3000 });
};

const getConfirmEls = () => {
    const modal = document.getElementById('action-confirm-modal');
    const title = document.getElementById('action-confirm-title');
    const message = document.getElementById('action-confirm-message');
    const cancelBtn = document.getElementById('action-confirm-cancel-btn');
    const okBtn = document.getElementById('action-confirm-ok-btn');
    if (!modal || !title || !message || !cancelBtn || !okBtn) return null;
    return { modal, title, message, cancelBtn, okBtn };
};

const applyVariant = (button, variant) => {
    button.classList.remove(
        'bg-red-600',
        'hover:bg-red-700',
        'bg-green-700',
        'hover:bg-green-800',
        'bg-yellow-500',
        'hover:bg-yellow-600',
    );

    if (variant === 'primary') {
        button.classList.add('bg-green-700', 'hover:bg-green-800');
        return;
    }

    if (variant === 'warning') {
        button.classList.add('bg-yellow-500', 'hover:bg-yellow-600');
        return;
    }

    button.classList.add('bg-red-600', 'hover:bg-red-700');
};

export const openConfirm = (options = {}) => {
    const els = getConfirmEls();
    if (!els) return Promise.resolve(false);

    const { modal, title, message, cancelBtn, okBtn } = els;

    title.textContent = String(options.title || 'Konfirmasi');
    message.textContent = String(options.message || 'Apakah Anda yakin?');
    okBtn.textContent = String(options.okText || 'Ya');
    cancelBtn.textContent = String(options.cancelText || 'Batal');
    applyVariant(okBtn, options.variant || 'danger');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.documentElement.classList.add('overflow-hidden');
    document.body.classList.add('overflow-hidden');

    return new Promise((resolve) => {
        const close = (value) => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.documentElement.classList.remove('overflow-hidden');
            document.body.classList.remove('overflow-hidden');
            resolve(value);
        };

        const onCancel = (e) => {
            e?.preventDefault?.();
            close(false);
        };

        const onOk = (e) => {
            e?.preventDefault?.();
            close(true);
        };

        const onBackdrop = (e) => {
            if (e.target === modal) close(false);
        };

        const onKeydown = (e) => {
            if (e.key === 'Escape') close(false);
        };

        cancelBtn.addEventListener('click', onCancel, { once: true });
        okBtn.addEventListener('click', onOk, { once: true });
        modal.addEventListener('click', onBackdrop, { once: true });
        document.addEventListener('keydown', onKeydown, { once: true });
    });
};

export const initConfirmDelegation = () => {
    if (window.__adminConfirmDelegationInit) return;
    window.__adminConfirmDelegationInit = true;

    document.addEventListener(
        'click',
        async (e) => {
            const target = e.target instanceof Element ? e.target : e.target?.parentElement;
            const el = target?.closest?.('[data-confirm]');
            if (!el) return;

            if (el.dataset.confirmBypass === '1') {
                delete el.dataset.confirmBypass;
                return;
            }

            const message = el.getAttribute('data-confirm') || '';
            const title = el.getAttribute('data-confirm-title') || '';
            const okText = el.getAttribute('data-confirm-ok') || '';
            const cancelText = el.getAttribute('data-confirm-cancel') || '';
            const variant = el.getAttribute('data-confirm-variant') || 'danger';

            e.preventDefault();
            e.stopPropagation();

            const confirmed = await openConfirm({
                title: title || 'Konfirmasi',
                message: message || 'Apakah Anda yakin?',
                okText: okText || 'Ya',
                cancelText: cancelText || 'Batal',
                variant,
            });

            if (!confirmed) return;

            const submitSelector = el.getAttribute('data-confirm-submit');
            if (submitSelector) {
                const form = document.querySelector(submitSelector);
                form?.requestSubmit?.();
                return;
            }

            const form = el.closest('form');
            if (form) {
                form.requestSubmit?.();
                return;
            }

            if (el.tagName === 'A' && el.getAttribute('href')) {
                window.location.href = el.getAttribute('href');
                return;
            }

            el.dataset.confirmBypass = '1';
            el.click();
        },
        true,
    );
};

export const initSubmitConfirm = () => {
    if (window.__adminSubmitConfirmInit) return;
    window.__adminSubmitConfirmInit = true;

    document.addEventListener(
        'submit',
        async (e) => {
            const form = e.target;
            if (!(form instanceof HTMLFormElement)) return;

            const message = form.getAttribute('data-submit-confirm');
            if (!message) return;

            if (form.dataset.submitConfirmBypass === '1') {
                delete form.dataset.submitConfirmBypass;
                return;
            }

            e.preventDefault();
            e.stopPropagation();

            const submitter = e.submitter instanceof HTMLElement ? e.submitter : null;
            const inferredOkText =
                submitter?.getAttribute('data-confirm-ok') ||
                submitter?.getAttribute('data-submit-confirm-ok') ||
                submitter?.textContent?.trim() ||
                (document.activeElement instanceof HTMLElement ? document.activeElement.textContent?.trim() : '') ||
                '';

            const confirmed = await openConfirm({
                title: form.getAttribute('data-submit-confirm-title') || 'Konfirmasi',
                message,
                okText: form.getAttribute('data-submit-confirm-ok') || inferredOkText || 'Simpan',
                cancelText: form.getAttribute('data-submit-confirm-cancel') || 'Batal',
                variant: form.getAttribute('data-submit-confirm-variant') || 'primary',
            });

            if (!confirmed) return;

            form.dataset.submitConfirmBypass = '1';
            form.requestSubmit();
        },
        true,
    );
};

export const initNotifications = () => {
    initConfirmDelegation();
    initSubmitConfirm();
    initToast();
};
