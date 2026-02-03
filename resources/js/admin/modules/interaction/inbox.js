
// Import dependencies if needed
import { api } from '../../../core/fetch';
import { $ } from '../../../core/dom';
import { on } from '../../../core/event';
import { ListManager } from '../../core/ListManager';
import { openConfirm, showToast } from '../../ui/notifications';

export const InboxModule = {
    init() {
        if (!document.querySelector('[data-page="inbox-list"]')) return;

        this.listManager = new ListManager({
            pageAttribute: 'inbox-list',
            listContainerId: 'inbox-list-container',
            paginationContainerId: 'inbox-pagination-container',
            onRender: () => this.bindInboxList()
        });
    },

    bindInboxList() {
        this.initCheckboxLogic();
        this.initSingleActions();
    },

    refreshList() {
        if (!this.listManager) return;
        const url = new URL(window.location.href);
        const page = url.searchParams.get('page') || '1';
        this.listManager.runUpdate({ page, historyMode: 'replace' });
    },

    initSingleActions() {
        // Handle Mark All Read (Current Page) Button
        const markAllReadBtn = document.querySelector('button[title="Tandai Semua Dibaca"]');
        if (markAllReadBtn && markAllReadBtn.dataset.inboxBound !== '1') {
            markAllReadBtn.dataset.inboxBound = '1';
            markAllReadBtn.removeAttribute('onclick'); // Remove inline alert
            on(markAllReadBtn, 'click', async () => {
                // Get all message IDs on current page from checkboxes
                const allMessageIds = Array.from(document.querySelectorAll('.message-checkbox')).map(cb => cb.value);
                
                if (allMessageIds.length === 0) return;

                try {
                    markAllReadBtn.disabled = true;
                    const url = '/admin/interaksi/pesan-masuk/bulk-status';
                    
                    const response = await api.post(url, {
                        ids: allMessageIds,
                        status: 'read'
                    });

                    if (response.success) {
                        this.refreshList();
                    }
                } catch (error) {
                    console.error('Mark all read failed:', error);
                    showToast('Gagal menandai semua dibaca', { type: 'error', duration: 4000 });
                } finally {
                    markAllReadBtn.disabled = false;
                }
            });
        }

        // Handle Mark Read/Unread buttons
        const actionButtons = document.querySelectorAll('.action-btn-ajax');
        
        // Icons
        const iconMarkRead = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path></svg>';
        const iconMarkUnread = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>';

        const updateSidebarBadge = (change) => {
            const badge = document.getElementById('sidebar-unread-badge');
            if (!badge) return;

            let currentCount = parseInt(badge.textContent.trim()) || 0;
            if (isNaN(currentCount)) currentCount = 0; // Handle '99+' case loosely, or assume if text is number

            // If it was '99+', parsing might fail or give 99. Let's just handle numbers for now.
            // If text is '99+', we can't easily increment. But for small numbers it works.
            // Simple logic:
            if (badge.textContent.includes('+')) {
                 // Do nothing if it's already 99+, unless we are decrementing significantly?
                 // For simplicity, let's just fetch count from server? No, that's an extra request.
                 // Let's just ignore 99+ case update for now or try to parse.
                 return; 
            }

            let newCount = currentCount + change;
            if (newCount < 0) newCount = 0;

            badge.textContent = newCount > 99 ? '99+' : newCount;

            if (newCount > 0) {
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        };

        actionButtons.forEach(btn => {
            if (btn.dataset.inboxBound === '1') return;
            btn.dataset.inboxBound = '1';
            on(btn, 'click', async (e) => {
                e.stopPropagation();
                
                // Prevent double click
                if (btn.disabled || btn.classList.contains('processing')) return;
                
                // Use getAttribute to ensure we get the latest value from DOM
                const url = btn.getAttribute('data-url');
                const method = btn.getAttribute('data-method') || 'POST';
                const row = btn.closest('.message-row');
                
                try {
                    // Disable button temporarily
                    btn.disabled = true;
                    btn.classList.add('processing');
                    
                    let response;
                    const methodLower = method.toLowerCase();

                    if (methodLower === 'put') {
                        response = await api.put(url, {});
                    } else if (methodLower === 'post') {
                        response = await api.post(url, {});
                    } else if (methodLower === 'delete') {
                        response = await api.delete(url);
                    } else {
                        response = await api.get(url);
                    }
                    
                    if (response.success) {
                        const currentStatus = row.getAttribute('data-status');

                        // Update UI based on action
                        if (response.status === 'read') {
                            // Update row style to read
                            row.classList.remove('bg-white', 'font-bold');
                            row.classList.add('bg-gray-50/50', 'font-normal');
                            row.setAttribute('data-status', 'read');
                            
                            // Update text colors
                            row.querySelectorAll('.text-black, .font-bold').forEach(el => {
                                el.classList.remove('text-black', 'font-bold');
                                el.classList.add('text-black/70');
                            });

                            // Update Button to "Mark Unread"
                            let newUrl = url;
                            if (url.endsWith('/read')) {
                                newUrl = url.replace(/\/read$/, '/unread');
                            }
                            
                            // Use setAttribute to ensure DOM is updated
                            btn.setAttribute('data-url', newUrl);
                            btn.title = "Tandai Belum Dibaca";
                            btn.innerHTML = iconMarkUnread;

                            // Update Sidebar Badge (-1) ONLY if status really changed
                            if (currentStatus === 'unread') {
                                updateSidebarBadge(-1);
                            }

                        } else if (response.status === 'unread') {
                            // Update row style to unread
                            row.classList.remove('bg-gray-50/50', 'font-normal');
                            row.classList.add('bg-white', 'font-bold');
                            row.setAttribute('data-status', 'unread');
                            
                            // Update text colors
                            row.querySelectorAll('.text-black\\/70').forEach(el => {
                                el.classList.remove('text-black/70');
                                el.classList.add('text-black');
                            });

                            // Update Button to "Mark Read"
                            let newUrl = url;
                            if (url.endsWith('/unread')) {
                                newUrl = url.replace(/\/unread$/, '/read');
                            }
                            
                            // Use setAttribute
                            btn.setAttribute('data-url', newUrl);
                            btn.title = "Tandai Sudah Dibaca";
                            btn.innerHTML = iconMarkRead;

                            // Update Sidebar Badge (+1) ONLY if status really changed
                            if (currentStatus === 'read') {
                                updateSidebarBadge(1);
                            }
                        }
                    }
                } catch (error) {
                    console.error('Action failed:', error);
                    
                } finally {
                    btn.disabled = false;
                    btn.classList.remove('processing');
                }
            });
        });
    },

    initCheckboxLogic() {
        const masterCheckboxContainer = document.querySelector('.master-checkbox');
        if (!masterCheckboxContainer) return;

        const masterCheckbox = masterCheckboxContainer.querySelector('input[type="checkbox"]');
        const masterIcon = masterCheckboxContainer.querySelector('svg');

        const defaultToolbarBtns = document.querySelectorAll('.toolbar-btn-default');
        const bulkActionsContainer = document.querySelector('.toolbar-bulk-actions');
        const bulkToggleStatusBtn = document.getElementById('bulk-toggle-status-btn');
        const bulkDeleteBtn = bulkActionsContainer?.querySelector('button[title="Hapus Terpilih"]');

        const dropdownBtn = document.getElementById('master-dropdown-btn');
        const dropdownMenu = document.getElementById('master-dropdown-menu');

        const iconMarkRead = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path></svg>';
        const iconMarkUnread = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>';

        const originalCheckIcon = '<path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>';
        const minusIcon = '<rect x="4" y="9" width="12" height="2" rx="1" fill="currentColor" />';

        const getCheckboxes = () => Array.from(document.querySelectorAll('.message-checkbox'));
        const getSelectedCheckboxes = () => getCheckboxes().filter(cb => cb.checked);
        const getSelectedIds = () => getSelectedCheckboxes().map(cb => cb.value);

        const updateSidebarBadge = (change) => {
            const badge = document.getElementById('sidebar-unread-badge');
            if (!badge) return;

            let currentCount = parseInt(badge.textContent.trim()) || 0;
            if (isNaN(currentCount)) currentCount = 0;

            if (badge.textContent.includes('+')) return;

            let newCount = currentCount + change;
            if (newCount < 0) newCount = 0;

            badge.textContent = newCount > 99 ? '99+' : newCount;
            badge.classList.toggle('hidden', newCount === 0);
        };

        const setRowSelectionUI = (checkbox, isChecked) => {
            const row = checkbox.closest('.message-row');
            if (!row) return;
            const icon = checkbox.parentElement.querySelector('svg');
            const status = row.getAttribute('data-status');

            if (isChecked) {
                icon?.classList.remove('hidden');
                row.classList.add('bg-green-50', 'hover:bg-green-100');
                row.classList.remove('bg-white', 'bg-gray-50/50');
                return;
            }

            icon?.classList.add('hidden');
            row.classList.remove('bg-green-50', 'hover:bg-green-100');

            if (status === 'unread') {
                row.classList.add('bg-white');
                row.classList.remove('bg-gray-50/50');
            } else {
                row.classList.add('bg-gray-50/50');
                row.classList.remove('bg-white');
            }
        };

        const updateToolbarState = () => {
            const selectedRows = getSelectedCheckboxes().map(cb => cb.closest('.message-row')).filter(Boolean);
            const anyChecked = selectedRows.length > 0;

            if (anyChecked) {
                defaultToolbarBtns.forEach(btn => btn.classList.add('hidden'));
                bulkActionsContainer?.classList.remove('hidden');
                bulkActionsContainer?.classList.add('flex');

                const hasUnread = selectedRows.some(row => row.getAttribute('data-status') === 'unread');
                if (bulkToggleStatusBtn) {
                    if (hasUnread) {
                        bulkToggleStatusBtn.title = 'Tandai Dibaca';
                        bulkToggleStatusBtn.innerHTML = iconMarkRead;
                        bulkToggleStatusBtn.dataset.action = 'read';
                    } else {
                        bulkToggleStatusBtn.title = 'Tandai Belum Dibaca';
                        bulkToggleStatusBtn.innerHTML = iconMarkUnread;
                        bulkToggleStatusBtn.dataset.action = 'unread';
                    }
                }
            } else {
                defaultToolbarBtns.forEach(btn => btn.classList.remove('hidden'));
                bulkActionsContainer?.classList.add('hidden');
                bulkActionsContainer?.classList.remove('flex');
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
                const row = cb.closest('.message-row');
                const status = row?.getAttribute('data-status');

                let shouldCheck = false;
                if (mode === 'all') shouldCheck = true;
                if (mode === 'none') shouldCheck = false;
                if (mode === 'read') shouldCheck = status === 'read';
                if (mode === 'unread') shouldCheck = status === 'unread';

                cb.checked = shouldCheck;
                setRowSelectionUI(cb, shouldCheck);
            });

            updateToolbarState();
            updateMasterCheckboxVisual();
        };

        if (dropdownBtn && dropdownMenu && dropdownBtn.dataset.inboxBound !== '1') {
            dropdownBtn.dataset.inboxBound = '1';

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
                    if (type === 'dibaca') applySelection('read');
                    if (type === 'belum dibaca') applySelection('unread');
                    dropdownMenu.classList.add('hidden');
                });
            });
        }

        if (masterCheckbox && masterCheckbox.dataset.inboxBound !== '1') {
            masterCheckbox.dataset.inboxBound = '1';
            on(masterCheckbox, 'change', (e) => {
                applySelection(e.target.checked ? 'all' : 'none');
            });
        }

        if (!this._inboxCheckboxDelegationBound) {
            this._inboxCheckboxDelegationBound = true;
            on(document, 'change', (e) => {
                const target = e.target;
                if (!(target instanceof HTMLInputElement)) return;
                if (target.type !== 'checkbox') return;
                if (!target.classList.contains('message-checkbox')) return;
                setRowSelectionUI(target, target.checked);
                updateToolbarState();
                updateMasterCheckboxVisual();
            });
        }

        if (bulkToggleStatusBtn && bulkToggleStatusBtn.dataset.inboxBound !== '1') {
            bulkToggleStatusBtn.dataset.inboxBound = '1';
            on(bulkToggleStatusBtn, 'click', async () => {
                const selectedIds = getSelectedIds();
                if (selectedIds.length === 0) return;

                const action = bulkToggleStatusBtn.dataset.action;
                const url = '/admin/interaksi/pesan-masuk/bulk-status';

                try {
                    bulkToggleStatusBtn.disabled = true;

                    let badgeChange = 0;
                    selectedIds.forEach(id => {
                        const checkbox = document.querySelector(`.message-checkbox[value="${id}"]`);
                        const row = checkbox?.closest('.message-row');
                        const currentStatus = row?.getAttribute('data-status');
                        if (action === 'read' && currentStatus === 'unread') badgeChange--;
                        if (action === 'unread' && currentStatus === 'read') badgeChange++;
                    });

                    const response = await api.post(url, { ids: selectedIds, status: action });
                    if (!response.success) return;

                    selectedIds.forEach(id => {
                        const checkbox = document.querySelector(`.message-checkbox[value="${id}"]`);
                        const row = checkbox?.closest('.message-row');
                        if (!row) return;

                        const actionBtn = row.querySelector('.action-btn-ajax');

                        if (action === 'read') {
                            row.classList.remove('bg-white', 'font-bold');
                            row.classList.add('bg-gray-50/50', 'font-normal');
                            row.setAttribute('data-status', 'read');
                            row.querySelectorAll('.text-black, .font-bold').forEach(el => {
                                el.classList.remove('text-black', 'font-bold');
                                el.classList.add('text-black/70');
                            });

                            if (actionBtn) {
                                const currentUrl = actionBtn.getAttribute('data-url') || '';
                                const nextUrl = currentUrl.replace(/\/read$/, '/unread');
                                actionBtn.setAttribute('data-url', nextUrl);
                                actionBtn.title = 'Tandai Belum Dibaca';
                                actionBtn.innerHTML = iconMarkUnread;
                            }
                        } else {
                            row.classList.remove('bg-gray-50/50', 'font-normal');
                            row.classList.add('bg-white', 'font-bold');
                            row.setAttribute('data-status', 'unread');
                            row.querySelectorAll('.text-black\\/70').forEach(el => {
                                el.classList.remove('text-black/70');
                                el.classList.add('text-black', 'font-bold');
                            });

                            if (actionBtn) {
                                const currentUrl = actionBtn.getAttribute('data-url') || '';
                                const nextUrl = currentUrl.replace(/\/unread$/, '/read');
                                actionBtn.setAttribute('data-url', nextUrl);
                                actionBtn.title = 'Tandai Sudah Dibaca';
                                actionBtn.innerHTML = iconMarkRead;
                            }
                        }
                    });

                    if (badgeChange !== 0) updateSidebarBadge(badgeChange);
                    updateToolbarState();
                    updateMasterCheckboxVisual();
                } catch (error) {
                    console.error('Bulk action failed:', error);
                    showToast('Gagal memproses aksi massal', { type: 'error', duration: 4000 });
                } finally {
                    bulkToggleStatusBtn.disabled = false;
                }
            });
        }

        if (bulkDeleteBtn && bulkDeleteBtn.dataset.inboxBound !== '1') {
            bulkDeleteBtn.dataset.inboxBound = '1';
            on(bulkDeleteBtn, 'click', async () => {
                const selectedIds = getSelectedIds();
                if (selectedIds.length === 0) return;

                const confirmed = await openConfirm({
                    title: 'Konfirmasi Hapus',
                    message: `Hapus ${selectedIds.length} pesan terpilih?`,
                    okText: 'Hapus',
                    cancelText: 'Batal',
                    variant: 'danger',
                });
                if (!confirmed) return;

                const url = '/admin/interaksi/pesan-masuk/bulk-delete';
                try {
                    bulkDeleteBtn.disabled = true;
                    const response = await api.post(url, { ids: selectedIds });
                    if (response.success) {
                        this.refreshList();
                    }
                } catch (error) {
                    console.error('Bulk delete failed:', error);
                    showToast('Gagal menghapus pesan', { type: 'error', duration: 4000 });
                } finally {
                    bulkDeleteBtn.disabled = false;
                }
            });
        }

        updateToolbarState();
        updateMasterCheckboxVisual();
    },

    // Handle single action without reload
    handleSingleAction(url, method = 'POST') {
        return api.fetch(url, { method });
    }
};
