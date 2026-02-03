import { api } from '../../../core/fetch';
import { on } from '../../../core/event';
import { ListManager } from '../../core/ListManager';
import { openConfirm, showToast } from '../../ui/notifications';

// Helper to update all unread counters (Sidebar & Stats Widget)
const updateUnreadBadges = (newCount) => {
    const safeCount = Math.max(0, Number(newCount) || 0);
    const countStr = safeCount > 99 ? '99+' : String(safeCount);

    // 1. Sidebar Badge
    const sidebarBadge = document.getElementById('sidebar-unread-comments-badge');
    if (sidebarBadge) {
        sidebarBadge.dataset.count = String(safeCount);
        sidebarBadge.textContent = countStr;

        if (safeCount === 0) {
            sidebarBadge.classList.add('hidden');
        } else {
            sidebarBadge.classList.remove('hidden');
        }
    }

    // 2. Stats Widget (Belum Dibaca)
    const statsWrapper = document.getElementById('stats-unread-wrapper');
    if (statsWrapper) {
        // Target the value element (bold text)
        const valueEl = statsWrapper.querySelector('p.font-bold');
        if (valueEl) {
            valueEl.textContent = String(safeCount);
        }
    }
};

const updateStatsWidgets = (counts) => {
    // Helper to update text content of stats card value
    const updateVal = (id, val) => {
        const wrapper = document.getElementById(id);
        if (!wrapper) return;
        const valueEl = wrapper.querySelector('p.font-bold'); // Assuming x-admin.ui.stats-card structure
        if (valueEl) valueEl.textContent = String(val);
    };

    if (typeof counts.pendingCount !== 'undefined') updateVal('stats-pending-wrapper', counts.pendingCount);
    if (typeof counts.approvedCount !== 'undefined') updateVal('stats-approved-wrapper', counts.approvedCount);
    if (typeof counts.totalCount !== 'undefined') updateVal('stats-total-wrapper', counts.totalCount);
};



export const CommentsModule = {
    init() {
        const listPage = document.querySelector('[data-page="comment-list"]');
        if (listPage) {
            this.listManager = new ListManager({
                pageAttribute: 'comment-list',
                listContainerId: 'comment-list-container',
                paginationContainerId: 'comment-pagination-container',
                onRender: () => this.bindList()
            });
        }

        const detailPage = document.querySelector('[data-page="comment-detail"]');
        if (detailPage) {
            this.bindDetail(detailPage);
        }
    },

    refreshList() {
        if (!this.listManager) return;
        const url = new URL(window.location.href);
        const page = url.searchParams.get('page') || '1';
        this.listManager.runUpdate({ page, historyMode: 'replace' });
    },

    bindList() {
        this.bindCheckboxLogic();
        this.bindRowActions();
    },

    bindDetail(detailPage) {
        const replyUrl = detailPage.getAttribute('data-reply-url');
        const threadId = detailPage.getAttribute('data-thread-id');
        const threadRootName = detailPage.getAttribute('data-thread-root-name') || '-';
        const threadContainer = detailPage.querySelector('[data-thread-container]');
        const drawer = detailPage.querySelector('[data-reply-drawer]');
        if (!replyUrl || !threadId || !threadContainer || !drawer) return;

        const backdrop = drawer.querySelector('[data-reply-backdrop]');
        const panel = drawer.querySelector('[data-reply-panel]');
        const shell = drawer.querySelector('[data-reply-shell]');
        const header = drawer.querySelector('[data-reply-header]');
        const body = drawer.querySelector('[data-reply-body]');
        const closeBtn = drawer.querySelector('[data-reply-close]');
        const minimizeBtn = drawer.querySelector('[data-reply-minimize]');
        const cancelBtn = drawer.querySelector('[data-reply-cancel]');
        const openBtn = detailPage.querySelector('[data-open-reply]');
        const replyToName = drawer.querySelector('[data-reply-to-name]');
        const textarea = drawer.querySelector('[data-reply-textarea]');
        const nameInput = drawer.querySelector('[data-reply-name]');
        const avatarInitial = drawer.querySelector('[data-reply-avatar-initial]');
        const form = drawer.querySelector('[data-reply-form]');
        const submitBtn = drawer.querySelector('[data-reply-submit]');

        const currentCommentId = detailPage.dataset.commentId || threadId;
        let activeReplyTargetId = currentCommentId;

        // replyUrl is something like: /admin/interaksi/komentar/1/reply
        // we want to be able to swap '1' with activeReplyTargetId
        const baseUrlParts = replyUrl.split('/');
        // Remove 'reply' and the ID (last two parts)
        baseUrlParts.pop(); // remove 'reply'
        baseUrlParts.pop(); // remove the ID
        const adminReplyBase = baseUrlParts.join('/');

        let isMinimized = false;

        this.bindThreadDelete(threadContainer);
        this.bindThreadApprove(threadContainer);

        const openDrawer = ({ name, id } = {}) => {
            activeReplyTargetId = id || currentCommentId;
            drawer.classList.remove('pointer-events-none');
            drawer.classList.add('pointer-events-auto');
            if (backdrop) backdrop.classList.remove('opacity-0');
            if (backdrop) backdrop.classList.add('opacity-100');
            if (panel) panel.classList.remove('translate-y-full');
            if (panel) panel.classList.add('translate-y-0');
            if (replyToName) replyToName.textContent = name || '-';
            if (body) body.classList.remove('hidden');
            isMinimized = false;
            if (shell) {
                shell.style.height = '';
                shell.style.maxHeight = '';
            }
            if (textarea) {
                textarea.focus();
            }
        };

        const closeDrawer = () => {
            activeReplyTargetId = threadId;
            if (backdrop) backdrop.classList.add('opacity-0');
            if (backdrop) backdrop.classList.remove('opacity-100');
            if (panel) panel.classList.add('translate-y-full');
            if (panel) panel.classList.remove('translate-y-0');
            drawer.classList.remove('pointer-events-auto');
            drawer.classList.add('pointer-events-none');
            if (textarea) textarea.value = '';
            if (replyToName) replyToName.textContent = '-';
            if (body) body.classList.remove('hidden');
            isMinimized = false;
            if (shell) {
                shell.style.height = '';
                shell.style.maxHeight = '';
            }
        };

        if (nameInput && avatarInitial) {
            on(nameInput, 'input', () => {
                const val = (nameInput.value || '').trim();
                avatarInitial.textContent = val ? val[0].toUpperCase() : 'A';
            });
        }

        const toggleMinimize = () => {
            if (!panel) return;
            isMinimized = !isMinimized;
            if (body) {
                if (isMinimized) body.classList.add('hidden');
                else body.classList.remove('hidden');
            }

            if (shell && header) {
                if (isMinimized) {
                    const headerHeight = header.getBoundingClientRect().height;
                    shell.style.height = `${Math.ceil(headerHeight)}px`;
                    shell.style.maxHeight = `${Math.ceil(headerHeight)}px`;
                } else {
                    shell.style.height = '';
                    shell.style.maxHeight = '';
                }
            }
        };

        if (openBtn) {
            on(openBtn, 'click', () => openDrawer({ name: threadRootName, id: currentCommentId }));
        }

        if (closeBtn) on(closeBtn, 'click', closeDrawer);
        if (minimizeBtn) on(minimizeBtn, 'click', toggleMinimize);
        if (cancelBtn) on(cancelBtn, 'click', closeDrawer);
        if (backdrop) on(backdrop, 'click', closeDrawer);

        on(document, 'keydown', (e) => {
            if (e.key !== 'Escape') return;
            closeDrawer();
        });

        on(threadContainer, 'click', async (e) => {
            const toggleBtn = e.target.closest('[data-action="toggle-admin-replies"]');
            if (toggleBtn) {
                const targetId = toggleBtn.dataset.target;
                const targetEl = document.getElementById(targetId);
                const count = toggleBtn.dataset.count || 0;
                const label = toggleBtn.querySelector('[data-label]');
                const icon = toggleBtn.querySelector('[data-icon-chevron]');

                if (targetEl) {
                    const isHidden = targetEl.classList.contains('hidden');
                    targetEl.classList.toggle('hidden');
                    if (label) label.textContent = isHidden ? 'Sembunyikan Balasan' : `Lihat ${count} Balasan`;
                    if (icon) icon.classList.toggle('rotate-180', isHidden);
                }
                return;
            }

            const replyBtn = e.target.closest('[data-comment-reply]');
            if (replyBtn) {
                const item = replyBtn.closest('[data-thread-item]');
                const name = item?.getAttribute('data-author-name') || '-';
                const id = item?.getAttribute('data-comment-id') || threadId;
                openDrawer({ name, id });
                return;
            }

            const likeBtn = e.target.closest('[data-comment-like]');
            if (!likeBtn) return;
            e.preventDefault();
            const url = likeBtn.getAttribute('data-url');
            if (!url) return;
            if (likeBtn.disabled) return;

            try {
                likeBtn.disabled = true;
                const res = await api.put(url, {});
                if (!res?.success) return;

                const wrapper = likeBtn.querySelector('.like-icon-wrapper');
                const text = likeBtn.querySelector('.like-text');
                const iconLiked = likeBtn.querySelector('.icon-liked');
                const iconUnliked = likeBtn.querySelector('.icon-unliked');

                if (res.liked) {
                    wrapper?.classList.remove('text-slate-900');
                    wrapper?.classList.add('text-green-700');

                    text?.classList.remove('text-slate-900');
                    text?.classList.add('text-green-700');

                    iconLiked?.classList.remove('hidden');
                    iconUnliked?.classList.add('hidden');
                } else {
                    wrapper?.classList.remove('text-green-700');
                    wrapper?.classList.add('text-slate-900');

                    text?.classList.remove('text-green-700');
                    text?.classList.add('text-slate-900');

                    iconLiked?.classList.add('hidden');
                    iconUnliked?.classList.remove('hidden');
                }
            } finally {
                likeBtn.disabled = false;
            }
        });

        if (form) {
            on(form, 'submit', async (e) => {
                e.preventDefault();
                if (!textarea) return;
                const isi = textarea.value.trim();
                if (!isi) return;
                const nama = (nameInput?.value || '').trim();

                const replyTarget = (replyToName?.textContent || '').trim() || '-';
                const confirmed = await openConfirm({
                    title: 'Konfirmasi',
                    message: `Kirim balasan ini untuk ${replyTarget}?`,
                    okText: 'Kirim',
                    cancelText: 'Batal',
                    variant: 'primary',
                });
                if (!confirmed) return;

                try {
                    if (submitBtn) submitBtn.disabled = true;

                    const finalUrl = `${adminReplyBase}/${activeReplyTargetId}/reply`;
                    const res = await api.post(finalUrl, { isi, nama });

                    if (!res?.success) return;

                    // Reload to show correct recursive structure
                    window.location.reload();
                } finally {
                    if (submitBtn) submitBtn.disabled = false;
                }
            });
        }
    },

    bindThreadDelete(container) {
        on(container, 'click', async (e) => {
            const btn = e.target.closest('[data-delete-thread-item]');
            if (!btn) return;
            e.preventDefault();

            if (btn.disabled || btn.classList.contains('processing')) return;
            const confirmed = await openConfirm({
                title: 'Konfirmasi Hapus',
                message: 'Hapus komentar ini?',
                okText: 'Hapus',
                cancelText: 'Batal',
                variant: 'danger',
            });
            if (!confirmed) return;

            const url = btn.getAttribute('data-url');
            const item = btn.closest('[data-thread-item]');

            try {
                btn.disabled = true;
                btn.classList.add('processing');

                if (item) item.classList.add('opacity-50', 'pointer-events-none');

                const res = await api.delete(url);
                if (res?.success) {
                    if (item) {
                        item.remove();
                    }
                } else {
                    if (item) item.classList.remove('opacity-50', 'pointer-events-none');
                }
            } catch (error) {
                console.error('Thread delete failed:', error);
                if (item) item.classList.remove('opacity-50', 'pointer-events-none');
            } finally {
                btn.disabled = false;
                btn.classList.remove('processing');
            }
        });
    },

    bindThreadApprove(container) {
        on(container, 'click', async (e) => {
            const btn = e.target.closest('[data-approve-thread-item]');
            if (!btn) return;
            e.preventDefault();

            if (btn.disabled || btn.classList.contains('processing')) return;
            const confirmed = await openConfirm({
                title: 'Konfirmasi',
                message: 'Setujui komentar ini?',
                okText: 'Setujui',
                cancelText: 'Batal',
                variant: 'primary',
            });
            if (!confirmed) return;

            const url = btn.getAttribute('data-url');
            const item = btn.closest('[data-thread-item]');

            try {
                btn.disabled = true;
                btn.classList.add('processing');

                if (item) item.classList.add('opacity-50', 'pointer-events-none');

                const res = await api.put(url, {});
                if (res?.success) {
                    if (item) {
                        item.classList.remove('opacity-50', 'pointer-events-none');
                        // Remove the check for entire thread approval if we only want single item, 
                        // but currently markAsApproved approves entire thread.
                        // If it approves entire thread, we should ideally refresh or update all pending items.
                        // For now, let's just remove the button and badge from this item.
                        const badge = item.querySelector('span.bg-amber-50');
                        if (badge) badge.remove();
                        btn.remove();
                    }
                } else {
                    if (item) item.classList.remove('opacity-50', 'pointer-events-none');
                }
            } catch (error) {
                console.error('Thread approve failed:', error);
                if (item) item.classList.remove('opacity-50', 'pointer-events-none');
            } finally {
                btn.disabled = false;
                btn.classList.remove('processing');
            }
        });
    },

    bindRowActions() {
        const actionButtons = document.querySelectorAll('.action-btn-ajax');

        actionButtons.forEach(btn => {
            if (btn.dataset.commentBound === '1') return;
            btn.dataset.commentBound = '1';

            on(btn, 'click', async (e) => {
                e.stopPropagation();
                if (btn.disabled || btn.classList.contains('processing')) return;

                const url = btn.getAttribute('data-url');
                const method = (btn.getAttribute('data-method') || 'POST').toLowerCase();
                const row = btn.closest('.comment-row');

                try {
                    btn.disabled = true;
                    btn.classList.add('processing');

                    let response;
                    if (method === 'put') response = await api.put(url, {});
                    else if (method === 'delete') response = await api.delete(url);
                    else response = await api.post(url, {});

                    if (!response?.success) return;

                    if (row) {
                        if (typeof response.status !== 'undefined') {
                            row.setAttribute('data-status', response.status);

                            if (response.status === 'approved') {
                                row.setAttribute('data-read', '1');

                                // Update row styling explicitly
                                row.classList.remove('bg-yellow-50');
                                // row.classList.add('bg-gray-50/50'); // Don't force gray bg, let default css handle it

                                // Also update master checkbox logic in case user selected rows
                                const checkbox = row.querySelector('.comment-checkbox');
                                if (checkbox && checkbox.checked) {
                                    // Re-apply selection UI to ensure correct color (green if selected)
                                    // But since we just approved, base style should be gray
                                    row.classList.remove('bg-yellow-50');
                                }

                                const approveBtn = row.querySelector('.action-btn-ajax[title="Setujui"]');
                                if (approveBtn) approveBtn.remove();

                                // Hapus icon checkmark jika ada (jika digunakan icon berbeda untuk pending)
                                // Di sini kita menghapus tombol setujui, itu sudah benar.
                                // Tapi pastikan status data-status juga diupdate
                                row.setAttribute('data-status', 'approved');

                                const nameEl = row.querySelector('[data-comment-name]');
                                const typeEl = row.querySelector('[data-comment-type]');
                                [nameEl, typeEl].forEach(el => {
                                    if (!el) return;
                                    el.classList.remove('font-bold', 'text-black');
                                    el.classList.add('text-black');
                                });
                            }
                        }
                        if (typeof response.is_read !== 'undefined') {
                            row.setAttribute('data-read', response.is_read ? '1' : '0');

                            const status = row.getAttribute('data-status');
                            const isRead = !!response.is_read;

                            row.classList.toggle('font-bold', !isRead);
                            row.classList.toggle('font-normal', isRead);

                            const nameEl = row.querySelector('[data-comment-name]');
                            const typeEl = row.querySelector('[data-comment-type]');
                            [nameEl, typeEl].forEach(el => {
                                if (!el) return;
                                el.classList.toggle('font-bold', !isRead);
                                el.classList.toggle('text-black', true); // Always black
                                // el.classList.toggle('text-black/70', isRead && status !== 'pending'); // Remove gray logic
                            });

                            if (typeof response.unreadCount !== 'undefined') {
                                updateUnreadBadges(response.unreadCount);
                            }

                            // Update other stats widgets if available in response
                            if (response.pendingCount !== undefined || response.approvedCount !== undefined) {
                                updateStatsWidgets(response);
                            }

                            if (btn) {
                                const currentUrl = btn.getAttribute('data-url') || '';
                                if (isRead) {
                                    const nextUrl = currentUrl.replace(/\/read$/, '/unread').replace(/\/unread$/, '/unread');
                                    btn.setAttribute('data-url', nextUrl);
                                    btn.title = 'Tandai Belum Dibaca';
                                    btn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>';
                                } else {
                                    const nextUrl = currentUrl.replace(/\/unread$/, '/read').replace(/\/read$/, '/read');
                                    btn.setAttribute('data-url', nextUrl);
                                    btn.title = 'Tandai Dibaca';
                                    btn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path></svg>';
                                }
                            }
                        }
                    }

                    if (typeof response.unreadCount !== 'undefined') {
                        updateUnreadBadges(response.unreadCount);
                    }

                    // this.refreshList(); // Hapus refresh list agar tidak reload
                } catch (error) {
                    console.error('Comment action failed:', error);
                } finally {
                    btn.disabled = false;
                    btn.classList.remove('processing');
                }
            });
        });
    },

    bindCheckboxLogic() {
        const masterCheckboxContainer = document.querySelector('.master-checkbox');
        if (!masterCheckboxContainer) return;

        const masterCheckbox = masterCheckboxContainer.querySelector('input[type="checkbox"]');
        const masterIcon = masterCheckboxContainer.querySelector('svg');
        const dropdownBtn = document.getElementById('master-dropdown-btn');
        const dropdownMenu = document.getElementById('master-dropdown-menu');

        const defaultToolbarBtns = document.querySelectorAll('.toolbar-btn-default');
        const bulkActionsContainer = document.querySelector('.toolbar-bulk-actions');
        const bulkDeleteBtn = bulkActionsContainer?.querySelector('button[title="Hapus Terpilih"]');
        const bulkToggleStatusBtn = document.getElementById('bulk-toggle-status-btn');
        const bulkToggleReadBtn = document.getElementById('bulk-toggle-read-btn');
        const markAllReadBtn = document.querySelector('button[title="Tandai Semua Dibaca"]');

        const originalCheckIcon = '<path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>';
        const minusIcon = '<rect x="4" y="9" width="12" height="2" rx="1" fill="currentColor" />';

        const getCheckboxes = () => Array.from(document.querySelectorAll('.comment-checkbox'));
        const getSelectedCheckboxes = () => getCheckboxes().filter(cb => cb.checked);
        const getSelectedIds = () => getSelectedCheckboxes().map(cb => cb.value);

        const setRowSelectionUI = (checkbox, isChecked) => {
            const row = checkbox.closest('.comment-row');
            if (!row) return;
            const icon = checkbox.parentElement.querySelector('svg');
            const status = row.getAttribute('data-status');

            if (isChecked) {
                icon?.classList.remove('hidden');
                row.classList.add('bg-green-50', 'hover:bg-green-100');
                row.classList.remove('bg-yellow-50', 'bg-gray-50/50');
                return;
            }

            icon?.classList.add('hidden');
            row.classList.remove('bg-green-50', 'hover:bg-green-100');

            if (status === 'pending') {
                row.classList.add('bg-yellow-50');
                row.classList.remove('bg-gray-50/50');
            } else {
                row.classList.add('bg-gray-50/50');
                row.classList.remove('bg-yellow-50');
            }
        };

        const updateToolbarState = () => {
            const selectedRows = getSelectedCheckboxes().map(cb => cb.closest('.comment-row')).filter(Boolean);
            const anyChecked = selectedRows.length > 0;

            if (anyChecked) {
                defaultToolbarBtns.forEach(btn => btn.classList.add('hidden'));
                bulkActionsContainer?.classList.remove('hidden');
                bulkActionsContainer?.classList.add('flex');

                const hasUnread = selectedRows.some(row => row?.getAttribute('data-read') !== '1');
                if (bulkToggleReadBtn) {
                    bulkToggleReadBtn.dataset.action = hasUnread ? 'read' : 'unread';
                    bulkToggleReadBtn.title = hasUnread ? 'Tandai Dibaca' : 'Tandai Belum Dibaca';
                    bulkToggleReadBtn.innerHTML = hasUnread
                        ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path></svg>'
                        : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>';
                }

                if (bulkToggleStatusBtn) {
                    const allApproved = selectedRows.every(row => row?.getAttribute('data-status') === 'approved');
                    if (allApproved) {
                        bulkToggleStatusBtn.classList.add('hidden');
                    } else {
                        bulkToggleStatusBtn.classList.remove('hidden');
                        bulkToggleStatusBtn.dataset.action = 'approved';
                        bulkToggleStatusBtn.title = 'Setujui Terpilih';
                    }
                }
            } else {
                bulkActionsContainer?.classList.add('hidden');
                bulkActionsContainer?.classList.remove('flex');
                defaultToolbarBtns.forEach(btn => btn.classList.remove('hidden'));
            }
        };

        const updateMasterCheckboxVisual = () => {
            const checkboxes = getCheckboxes();
            const someChecked = checkboxes.some(cb => cb.checked);
            const allChecked = checkboxes.length > 0 && checkboxes.every(cb => cb.checked);

            if (allChecked) {
                masterIcon.classList.remove('hidden');
                masterIcon.innerHTML = originalCheckIcon;
                masterCheckbox.checked = true;
                masterCheckbox.indeterminate = false;
                return;
            }

            if (someChecked) {
                masterIcon.classList.remove('hidden');
                masterIcon.innerHTML = minusIcon;
                masterCheckbox.checked = false;
                masterCheckbox.indeterminate = true;
                return;
            }

            masterIcon.classList.add('hidden');
            masterCheckbox.checked = false;
            masterCheckbox.indeterminate = false;
        };

        const applySelection = (mode) => {
            const checkboxes = getCheckboxes();
            checkboxes.forEach(cb => {
                const row = cb.closest('.comment-row');
                const status = row?.getAttribute('data-status');
                const isRead = row?.getAttribute('data-read') === '1';

                let shouldCheck = false;
                if (mode === 'all') shouldCheck = true;
                if (mode === 'none') shouldCheck = false;
                if (mode === 'read') shouldCheck = isRead;
                if (mode === 'unread') shouldCheck = !isRead;

                cb.checked = shouldCheck;
                setRowSelectionUI(cb, shouldCheck);
            });

            updateToolbarState();
            updateMasterCheckboxVisual();
        };

        if (dropdownBtn && dropdownMenu && dropdownBtn.dataset.commentDropdownBound !== '1') {
            dropdownBtn.dataset.commentDropdownBound = '1';

            on(dropdownBtn, 'click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });

            on(document, 'click', (e) => {
                if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });

            dropdownMenu.querySelectorAll('button').forEach(btn => {
                on(btn, 'click', () => {
                    const type = btn.textContent.trim().toLowerCase();
                    if (type === 'semua') applySelection('all');
                    if (type === 'tidak ada') applySelection('none');
                    if (type === 'belum dibaca') applySelection('unread');
                    if (type === 'dibaca') applySelection('read');
                    dropdownMenu.classList.add('hidden');
                });
            });
        }

        if (masterCheckbox && masterCheckbox.dataset.commentBound !== '1') {
            masterCheckbox.dataset.commentBound = '1';
            on(masterCheckbox, 'change', (e) => {
                applySelection(e.target.checked ? 'all' : 'none');
            });
        }

        if (!this._commentCheckboxDelegationBound) {
            this._commentCheckboxDelegationBound = true;
            on(document, 'change', (e) => {
                const target = e.target;
                if (!(target instanceof HTMLInputElement)) return;
                if (target.type !== 'checkbox') return;
                if (!target.classList.contains('comment-checkbox')) return;
                setRowSelectionUI(target, target.checked);
                updateToolbarState();
                updateMasterCheckboxVisual();
            });
        }

        if (bulkToggleStatusBtn && bulkToggleStatusBtn.dataset.commentBound !== '1') {
            bulkToggleStatusBtn.dataset.commentBound = '1';
            on(bulkToggleStatusBtn, 'click', async () => {
                const selectedIds = getSelectedIds();
                if (selectedIds.length === 0) return;

                const confirmed = await openConfirm({
                    title: 'Konfirmasi',
                    message: `Apakah Anda yakin ingin menyetujui ${selectedIds.length} komentar terpilih?`,
                    okText: 'Setujui',
                    cancelText: 'Batal',
                    variant: 'primary',
                });
                if (!confirmed) return;

                const status = 'approved';
                const url = '/admin/interaksi/komentar/bulk-status';

                try {
                    bulkToggleStatusBtn.disabled = true;
                    const response = await api.post(url, { ids: selectedIds, status });
                    if (response?.success) {
                        if (typeof response.unreadCount !== 'undefined') {
                            updateUnreadBadges(response.unreadCount);
                        }

                        // Update other stats widgets if available in response
                        if (response.pendingCount !== undefined || response.approvedCount !== undefined) {
                            updateStatsWidgets(response);
                        }

                        selectedIds.forEach(id => {
                            const checkbox = document.querySelector(`.comment-checkbox[value="${id}"]`);
                            const row = checkbox?.closest('.comment-row');
                            if (!row) return;

                            row.setAttribute('data-status', 'approved');
                            row.setAttribute('data-read', '1');

                            const approveBtn = row.querySelector('.action-btn-ajax[title="Setujui"]');
                            if (approveBtn) approveBtn.remove();

                            const readBtn = row.querySelector('.action-btn-ajax[title="Tandai Dibaca"], .action-btn-ajax[title="Tandai Belum Dibaca"]');
                            if (readBtn) {
                                const currentUrl = readBtn.getAttribute('data-url') || '';
                                const nextUrl = currentUrl.replace(/\/read$/, '/unread').replace(/\/unread$/, '/unread');
                                readBtn.setAttribute('data-url', nextUrl);
                                readBtn.title = 'Tandai Belum Dibaca';
                                readBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>';
                            }

                            const nameEl = row.querySelector('[data-comment-name]');
                            const typeEl = row.querySelector('[data-comment-type]');
                            [nameEl, typeEl].forEach(el => {
                                if (!el) return;
                                el.classList.remove('font-bold', 'text-black');
                                el.classList.add('text-black');
                            });

                            row.classList.remove('font-bold');
                            row.classList.add('font-normal');
                            row.classList.remove('bg-yellow-50');
                            row.classList.add('bg-gray-50/50');
                        });

                        updateToolbarState();
                        updateMasterCheckboxVisual();
                    }
                } catch (error) {
                    console.error('Bulk status failed:', error);
                    showToast('Gagal memproses aksi massal', { type: 'error', duration: 4000 });
                } finally {
                    bulkToggleStatusBtn.disabled = false;
                }
            });
        }

        if (bulkToggleReadBtn && bulkToggleReadBtn.dataset.commentBound !== '1') {
            bulkToggleReadBtn.dataset.commentBound = '1';
            on(bulkToggleReadBtn, 'click', async () => {
                const selectedIds = getSelectedIds();
                if (selectedIds.length === 0) return;

                const action = bulkToggleReadBtn.dataset.action;
                const url = '/admin/interaksi/komentar/bulk-read';
                const is_read = action === 'read' ? 1 : 0;

                try {
                    bulkToggleReadBtn.disabled = true;
                    const response = await api.post(url, { ids: selectedIds, is_read });
                    if (response?.success) {
                        if (typeof response.unreadCount !== 'undefined') {
                            updateUnreadBadges(response.unreadCount);
                        }
                        selectedIds.forEach(id => {
                            const checkbox = document.querySelector(`.comment-checkbox[value="${id}"]`);
                            const row = checkbox?.closest('.comment-row');
                            if (!row) return;

                            row.setAttribute('data-read', is_read ? '1' : '0');

                            const readBtn = row.querySelector('.action-btn-ajax[title="Tandai Dibaca"], .action-btn-ajax[title="Tandai Belum Dibaca"]');
                            if (readBtn) {
                                if (is_read) {
                                    const currentUrl = readBtn.getAttribute('data-url') || '';
                                    const nextUrl = currentUrl.replace(/\/read$/, '/unread').replace(/\/unread$/, '/unread');
                                    readBtn.setAttribute('data-url', nextUrl);
                                    readBtn.title = 'Tandai Belum Dibaca';
                                    readBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>';
                                } else {
                                    const currentUrl = readBtn.getAttribute('data-url') || '';
                                    const nextUrl = currentUrl.replace(/\/unread$/, '/read').replace(/\/read$/, '/read');
                                    readBtn.setAttribute('data-url', nextUrl);
                                    readBtn.title = 'Tandai Dibaca';
                                    readBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path></svg>';
                                }
                            }

                            const status = row.getAttribute('data-status');
                            const isReadNow = Boolean(is_read);

                            row.classList.toggle('font-bold', !isReadNow);
                            row.classList.toggle('font-normal', isReadNow);

                            const nameEl = row.querySelector('[data-comment-name]');
                            const typeEl = row.querySelector('[data-comment-type]');
                            [nameEl, typeEl].forEach(el => {
                                if (!el) return;
                                el.classList.toggle('font-bold', !isReadNow);
                                el.classList.toggle('text-black', true); // Always black
                                // el.classList.toggle('text-black/70', isReadNow && status !== 'pending'); // Remove gray logic
                            });
                        });

                        updateToolbarState();
                        updateMasterCheckboxVisual();
                    }
                } catch (error) {
                    console.error('Bulk read failed:', error);
                    showToast('Gagal memproses aksi massal', { type: 'error', duration: 4000 });
                } finally {
                    bulkToggleReadBtn.disabled = false;
                }
            });
        }

        if (bulkDeleteBtn && bulkDeleteBtn.dataset.commentBound !== '1') {
            bulkDeleteBtn.dataset.commentBound = '1';
            on(bulkDeleteBtn, 'click', async () => {
                const selectedIds = getSelectedIds();
                if (selectedIds.length === 0) return;
                const confirmed = await openConfirm({
                    title: 'Konfirmasi Hapus',
                    message: `Hapus ${selectedIds.length} komentar terpilih?`,
                    okText: 'Hapus',
                    cancelText: 'Batal',
                    variant: 'danger',
                });
                if (!confirmed) return;

                const url = '/admin/interaksi/komentar/bulk-delete';
                try {
                    bulkDeleteBtn.disabled = true;
                    const response = await api.post(url, { ids: selectedIds });
                    if (response?.success) {
                        if (typeof response.unreadCount !== 'undefined') {
                            updateUnreadBadges(response.unreadCount);
                        }
                        this.refreshList();
                    }
                } catch (error) {
                    console.error('Bulk delete failed:', error);
                    showToast('Gagal menghapus komentar', { type: 'error', duration: 4000 });
                } finally {
                    bulkDeleteBtn.disabled = false;
                }
            });
        }

        if (markAllReadBtn && markAllReadBtn.dataset.commentBound !== '1') {
            markAllReadBtn.dataset.commentBound = '1';
            on(markAllReadBtn, 'click', async () => {
                const url = markAllReadBtn.getAttribute('data-url');
                const method = (markAllReadBtn.getAttribute('data-method') || 'PUT').toLowerCase();

                if (!url) return;

                try {
                    markAllReadBtn.disabled = true;
                    if (method === 'put') {
                        const response = await api.put(url, {});
                        if (response?.success) {
                            if (typeof response.unreadCount !== 'undefined') {
                                updateUnreadBadges(response.unreadCount);
                            }
                            this.refreshList();
                        }
                    }
                } catch (error) {
                    console.error('Mark all read failed:', error);
                    showToast('Gagal menandai semua komentar sebagai dibaca', { type: 'error', duration: 4000 });
                } finally {
                    markAllReadBtn.disabled = false;
                }
            });
        }

        updateToolbarState();
        updateMasterCheckboxVisual();
    }
};
