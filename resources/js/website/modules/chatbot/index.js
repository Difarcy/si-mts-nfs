import { api } from '../../../core/fetch';
import { $, $$, createElement } from '../../../core/dom';
import { on } from '../../../core/event';
import { showToast } from '../../ui/notifications';

const escapeHtml = (value) => {
    return String(value ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
};

const scrollToBottom = (container) => {
    if (!container) return;
    container.scrollTop = container.scrollHeight;
};

const renderMessage = (messagesEl, { role, content }) => {
    const safe = escapeHtml(content);

    if (role === 'user') {
        const wrapper = createElement('div', {
            className: 'flex justify-end animate-slide-in flex-shrink-0',
            dataset: { messageType: 'chat' },
        });
        wrapper.innerHTML = `
            <div class="max-w-[85%] bg-teal-600 text-white px-4 py-3 rounded-lg rounded-tr-none shadow-sm">
                <p class="text-sm leading-relaxed whitespace-pre-wrap">${safe}</p>
            </div>
        `;
        messagesEl.appendChild(wrapper);
        return;
    }

    const wrapper = createElement('div', {
        className: 'flex flex-col gap-1.5 animate-slide-in flex-shrink-0',
        dataset: { messageType: 'chat' },
    });
    wrapper.innerHTML = `
        <div class="flex items-center gap-2">
            <span class="text-base font-bold text-slate-900">Nafa</span>
        </div>
        <div class="w-full bg-gray-100 border border-gray-200 p-4 rounded-lg rounded-tl-none shadow-sm">
            <p class="text-sm leading-relaxed text-gray-900 whitespace-pre-wrap">${safe}</p>
        </div>
    `;
    messagesEl.appendChild(wrapper);
};

export function initChatbot() {
    const container = $('#chatbot-container');
    if (!container) return;

    const endpoint = container.getAttribute('data-endpoint') || '/chatbot';

    const toggleBtn = $('#chatbot-toggle-btn');
    const windowEl = $('#chatbot-window');
    const minimizeBtn = $('#chatbot-minimize-btn');
    const clearBtn = $('#chatbot-clear-btn');
    const messagesEl = $('#chatbot-messages');
    const typingEl = $('#chatbot-typing');
    const form = $('#chatbot-form');
    const input = $('#chatbot-input');
    const sendBtn = $('#chatbot-send-btn');

    if (!toggleBtn || !windowEl || !minimizeBtn || !messagesEl || !form || !input || !sendBtn || !typingEl) return;

    const STORAGE_KEY = 'chatbot_history';
    let history = [];
    let inFlight = false;

    const updateClearButton = () => {
        const hasChat = history.length > 0;
        if (!clearBtn) return;
        clearBtn.classList.toggle('hidden', !hasChat);
    };

    // Load history from localStorage
    try {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved) {
            history = JSON.parse(saved);
            // Render saved messages
            history.forEach((msg) => renderMessage(messagesEl, msg));
            
            // Scroll to bottom after loading
            setTimeout(() => scrollToBottom(messagesEl), 100);
            
            // Pastikan tombol clear muncul jika ada history
            updateClearButton();
        }
    } catch (e) {
        console.error('Gagal memuat history chat', e);
    }

    const saveHistory = () => {
        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(history));
        } catch (e) {
            console.error('Gagal menyimpan history chat', e);
        }
    };

    const setOpen = (open) => {
        if (open) {
            windowEl.classList.remove('hidden');
            windowEl.classList.add('flex');
            window.requestAnimationFrame(() => scrollToBottom(messagesEl));
            // Tambahan timeout untuk memastikan layout sudah beres
            setTimeout(() => scrollToBottom(messagesEl), 50);
            input.focus();
            return;
        }

        windowEl.classList.add('hidden');
        windowEl.classList.remove('flex');
    };

    const setTyping = (show) => {
        if (show) {
            typingEl.classList.remove('hidden');
            typingEl.classList.add('flex');
            messagesEl.appendChild(typingEl); // Pindahkan ke paling bawah
            scrollToBottom(messagesEl);
        } else {
            typingEl.classList.add('hidden');
            typingEl.classList.remove('flex');
        }
    };

    const setSending = (sending) => {
        inFlight = sending;
        sendBtn.disabled = sending;
        input.disabled = sending;
        if (!sending) input.focus();
    };

    on(toggleBtn, 'click', () => {
        const isHidden = windowEl.classList.contains('hidden');
        setOpen(isHidden);
    });

    on(minimizeBtn, 'click', () => setOpen(false));

    if (clearBtn) {
        on(clearBtn, 'click', () => {
            history.length = 0; // Kosongkan array in-place
            try {
                localStorage.removeItem(STORAGE_KEY); // Hapus dari storage
            } catch (e) {
                console.error('Gagal menghapus history', e);
            }
            
            // Hapus elemen chat dari DOM (kecuali welcome message)
            const chatBubbles = messagesEl.querySelectorAll('[data-message-type="chat"]');
            chatBubbles.forEach(el => el.remove());
            
            updateClearButton();
            input.value = '';
            setTyping(false);
            setSending(false);
        });
    }

    on(messagesEl, 'click', '.chatbot-suggestion', (e) => {
        const value = e.target?.closest('.chatbot-suggestion')?.getAttribute('data-message') || '';
        if (!value) return;
        input.value = value;
        form.dispatchEvent(new Event('submit', { cancelable: true }));
    });

    on(input, 'keydown', (e) => {
        if (e.key !== 'Enter') return;
        if (e.shiftKey) return;
        e.preventDefault();
        form.dispatchEvent(new Event('submit', { cancelable: true }));
    });

    on(form, 'submit', async (e) => {
        e.preventDefault();
        if (inFlight) return;

        const message = input.value.trim();
        if (!message) return;

        setSending(true);
        setTyping(false);

        renderMessage(messagesEl, { role: 'user', content: message });
        scrollToBottom(messagesEl);

        history.push({ role: 'user', content: message });
        saveHistory(); // Simpan chat baru
        updateClearButton();
        input.value = '';

        try {
            setTyping(true);

            const payload = {
                message,
                messages: history.slice(-10),
            };

            const response = await api.post(endpoint, payload);
            const reply = String(response?.reply || '').trim();

            setTyping(false);

            if (!reply) {
                showToast('Nafa tidak memberi jawaban. Coba lagi ya.', { type: 'error', duration: 3500 });
                setSending(false);
                return;
            }

            renderMessage(messagesEl, { role: 'assistant', content: reply });
            history.push({ role: 'assistant', content: reply });
            saveHistory(); // Simpan balasan bot
            updateClearButton();
            scrollToBottom(messagesEl);
        } catch (error) {
            setTyping(false);
            const message = error?.data?.reply || error?.data?.message || error?.message || 'Terjadi kesalahan';
            showToast(message, { type: 'error', duration: 4500 });
        } finally {
            setSending(false);
        }
    });
}
