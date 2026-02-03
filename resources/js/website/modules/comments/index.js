import { api } from '../../../core/fetch';
import { on } from '../../../core/event';
import { showToast } from '../../ui/notifications';

export function initCommentForms() {
    initCommentSubmission();
    initCommentInteractions();
}

function initCommentSubmission() {
    const forms = Array.from(document.querySelectorAll('form[data-comment-form="true"]'));
    if (forms.length === 0) return;

    forms.forEach((commentForm) => {
        on(commentForm, 'submit', async (e) => {
            e.preventDefault();

            const submitBtn = commentForm.querySelector('button[type="submit"]') || commentForm.querySelector('button');
            if (!submitBtn) return;

            try {
                submitBtn.disabled = true;

                const isReplyForm = Boolean(commentForm.closest('#reply-modal'));

                const formData = new FormData(commentForm);
                const url = commentForm.getAttribute('action') || window.location.href;

                const response = await api.postForm(url, formData);

                if (response.success) {
                    showToast(response.message || 'Pesan berhasil dikirim. Komentar menunggu persetujuan admin.', { type: 'success', duration: 3500 });
                    commentForm.reset();
                    // Close modal if it's a reply form
                    if (commentForm.closest('#reply-modal')) {
                        closeReplyModal();
                    }
                } else {
                    showToast('Gagal: ' + (response.message || 'Terjadi kesalahan'), { type: 'error', duration: 4500 });
                }
            } catch (error) {
                if (error.status === 422 && error.data?.errors) {
                    const errors = error.data.errors;
                    const first = Object.values(errors)[0]?.[0];
                    showToast(first || 'Harap periksa kembali form.', { type: 'error', duration: 4500 });
                } else {
                    showToast('Gagal: ' + (error.data?.message || error.message), { type: 'error', duration: 4500 });
                }
            } finally {
                submitBtn.disabled = false;
            }
        });
    });
}

function initCommentInteractions() {
    const commentsSection = document.getElementById('comments-section');
    if (!commentsSection) return;

    // Delegate click events
    commentsSection.addEventListener('click', (e) => {
        const target = e.target.closest('[data-action]');
        if (!target) return;

        const action = target.dataset.action;

        switch (action) {
            case 'reply-comment':
                startReply(target);
                break;
            case 'like-comment':
                likeComment(target);
                break;
            case 'close-reply-modal':
                closeReplyModal();
                break;
            case 'toggle-replies':
                toggleReplies(target);
                break;
        }
    });

    // Handle close modal on backdrop click
    const replyModal = document.getElementById('reply-modal');
    if (replyModal) {
        replyModal.addEventListener('click', (e) => {
            if (e.target === replyModal) {
                closeReplyModal();
            }
        });
    }
}

function toggleReplies(btn) {
    const targetId = btn.dataset.target;
    const container = document.getElementById(targetId);
    if (!container) return;

    // Show the hidden replies
    container.classList.remove('hidden');

    // Hide the button permanently for this view session
    btn.classList.add('hidden');
}

function startReply(btn) {
    const threadId = btn.dataset.threadId || btn.dataset.id;
    const name = btn.dataset.name;
    const modal = document.getElementById('reply-modal');
    const panel = document.getElementById('reply-modal-panel');
    const backdrop = modal?.querySelector('[data-reply-backdrop]');
    const threadInput = document.getElementById('modal-thread-id');
    const parentInput = document.getElementById('modal-parent-id');
    const targetName = document.getElementById('modal-reply-target');

    if (!modal || !panel || !threadInput || !parentInput || !targetName) return;

    threadInput.value = threadId;
    parentInput.value = btn.dataset.id;
    targetName.textContent = name;

    modal.classList.remove('hidden');
    modal.classList.remove('pointer-events-none');
    modal.classList.add('pointer-events-auto');

    // Animation: Slide up
    requestAnimationFrame(() => {
        backdrop?.classList.remove('opacity-0');
        backdrop?.classList.add('opacity-100');
        panel.classList.remove('translate-y-full');
        panel.classList.add('translate-y-0');
    });

    // Focus on name input
    setTimeout(() => {
        const nameInput = document.getElementById('modal-nama');
        if (nameInput) nameInput.focus();
    }, 100); // Wait for animation start
}

function closeReplyModal() {
    const modal = document.getElementById('reply-modal');
    const panel = document.getElementById('reply-modal-panel');
    const backdrop = modal?.querySelector('[data-reply-backdrop]');

    if (!modal || !panel) return;

    // Animation: Slide down
    backdrop?.classList.add('opacity-0');
    backdrop?.classList.remove('opacity-100');
    panel.classList.remove('translate-y-0');
    panel.classList.add('translate-y-full');

    // Hide modal after animation
    setTimeout(() => {
        modal.classList.add('pointer-events-none');
        modal.classList.remove('pointer-events-auto');
        modal.classList.add('hidden');
    }, 300); // Match transition duration
}

async function likeComment(btn) {
    if (btn.disabled) return;
    const id = btn.dataset.id;
    if (!id) return;

    try {
        btn.disabled = true;
        const response = await fetch(`/komentar/${id}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                'Accept': 'application/json',
            }
        });

        const data = await response.json();

        if (data.success) {
            const outlineIcon = btn.querySelector('[data-icon="outline"]');
            const solidIcon = btn.querySelector('[data-icon="solid"]');
            const countSpan = btn.querySelector('.like-count');

            if (data.liked) {
                // Update button style
                btn.classList.add('text-green-700');
                btn.classList.remove('text-slate-900');

                // Show solid icon, hide outline
                outlineIcon.classList.add('hidden');
                outlineIcon.classList.remove('text-gray-400'); // Clean up

                solidIcon.classList.remove('hidden');
                solidIcon.classList.add('text-green-700', 'fill-current');
            } else {
                // Update button style
                btn.classList.remove('text-green-700');
                btn.classList.add('text-slate-900');

                // Show outline icon, hide solid
                outlineIcon.classList.remove('hidden');
                outlineIcon.classList.add('text-gray-400');

                solidIcon.classList.add('hidden');
                solidIcon.classList.remove('text-green-700', 'fill-current');
            }

            if (countSpan) {
                countSpan.textContent = data.count > 0 ? data.count : '';
            }
        }
    } catch (error) {
        console.error('Error liking comment:', error);
    } finally {
        btn.disabled = false;
    }
}
