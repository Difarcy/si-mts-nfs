const STORAGE_KEY = '__website_next_toast__';

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

