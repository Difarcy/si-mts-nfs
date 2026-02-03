export class ListManager {
    constructor({
        pageAttribute,
        listContainerId,
        paginationContainerId,
        onRender // Callback function to re-init components (like delete buttons)
    }) {
        this.pageRoot = document.querySelector(`[data-page="${pageAttribute}"]`);
        if (!this.pageRoot) return;

        this.listContainer = document.getElementById(listContainerId);
        this.paginationContainer = document.getElementById(paginationContainerId);
        this.onRender = onRender || (() => {});

        if (!this.listContainer || !this.paginationContainer) return;

        this.init();
    }

    init() {
        if (this.pageRoot.dataset.listManagerInit === '1') return;
        this.pageRoot.dataset.listManagerInit = '1';

        this.searchInput = this.pageRoot.querySelector('input[name="search"]');
        this.statusSelect = this.pageRoot.querySelector('select[name="status"]');
        this.sortSelect = this.pageRoot.querySelector('select[name="sort"]');
        this.resetBtn = this.pageRoot.querySelector('[data-admin-reset-button="true"]');

        this.bindEvents();

        this.updateResetVisibility();

        this.onRender();
    }

    bindEvents() {
        if (this.searchInput) {
            let typingTimer;
            let composing = false;

            this.searchInput.addEventListener('compositionstart', () => composing = true);
            this.searchInput.addEventListener('compositionend', () => composing = false);

            this.searchInput.addEventListener('input', () => {
                if (composing) return;
                this.updateResetVisibility();

                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    this.runUpdate({ page: 1, historyMode: 'replace' });
                }, 300);
            });

            this.searchInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(typingTimer);
                    this.runUpdate({ page: 1, historyMode: 'replace' });
                }
            });
        }

        [this.statusSelect, this.sortSelect].forEach(select => {
            select?.addEventListener('change', () => {
                this.updateResetVisibility();
                this.runUpdate({ page: 1, historyMode: 'replace' });
            });
        });

        this.resetBtn?.addEventListener('click', (e) => {
            e.preventDefault();
            if (this.searchInput) this.searchInput.value = '';
            if (this.statusSelect) this.statusSelect.value = '';
            if (this.sortSelect) this.sortSelect.value = 'latest';

            this.updateResetVisibility();
            this.runUpdate({ page: 1, historyMode: 'replace' });
        });

        this.paginationContainer.addEventListener('click', (e) => {
            const link = e.target.closest('a[href]');
            if (!link) return;

            e.preventDefault();
            const url = new URL(link.href);
            const page = url.searchParams.get('page') || '1';

            this.runUpdate({ page, historyMode: 'push' });
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        window.addEventListener('popstate', () => {
            const url = new URL(window.location.href);
            this.syncControlsFromUrl(url);
            this.updateResetVisibility();

            const page = url.searchParams.get('page') || '1';
            this.runUpdate({ page, historyMode: 'replace', isPopState: true });
        });
    }

    normalize(value) {
        return String(value || '').trim();
    }

    buildUrl({ page }) {
        const baseUrl = new URL(window.location.pathname, window.location.origin);
        
        const search = this.normalize(this.searchInput?.value);
        const status = this.normalize(this.statusSelect?.value);
        const sort = this.normalize(this.sortSelect?.value);

        if (search) baseUrl.searchParams.set('search', search);
        if (status) baseUrl.searchParams.set('status', status);
        if (sort && sort !== 'latest') baseUrl.searchParams.set('sort', sort);
        if (page && Number(page) > 1) baseUrl.searchParams.set('page', String(page));

        return baseUrl;
    }

    syncControlsFromUrl(url) {
        const search = url.searchParams.get('search') || '';
        const status = url.searchParams.get('status') || '';
        const sort = url.searchParams.get('sort') || 'latest';

        if (this.searchInput) this.searchInput.value = search;
        if (this.statusSelect) this.statusSelect.value = status;
        if (this.sortSelect) this.sortSelect.value = sort;
    }

    computeDirty() {
        const search = this.normalize(this.searchInput?.value);
        const status = this.normalize(this.statusSelect?.value);
        const sort = this.normalize(this.sortSelect?.value);
        
        return search !== '' || status !== '' || (sort !== '' && sort !== 'latest');
    }

    updateResetVisibility() {
        if (this.resetBtn) {
            this.resetBtn.hidden = !this.computeDirty();
        }
    }

    async runUpdate({ page, historyMode, isPopState = false }) {
        const targetUrl = this.buildUrl({ page });

        if (!isPopState) {
            if (historyMode === 'push') {
                window.history.pushState({}, '', targetUrl.toString());
            } else {
                window.history.replaceState({}, '', targetUrl.toString());
            }
        }

        if (this.activeController) this.activeController.abort();
        this.activeController = new AbortController();

        try {
            this.setLoading(true);

            const res = await fetch(targetUrl.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                signal: this.activeController.signal
            });

            if (res.redirected) {
                window.location.href = res.url;
                return;
            }

            if (!res.ok) throw new Error(`HTTP ${res.status}`);

            const html = await res.text();
            const doc = new DOMParser().parseFromString(html, 'text/html');

            const newList = doc.getElementById(this.listContainer.id);
            const newPagination = doc.getElementById(this.paginationContainer.id);

            if (newList && newPagination) {
                this.listContainer.innerHTML = newList.innerHTML;
                this.paginationContainer.innerHTML = newPagination.innerHTML;

                this.onRender();

                if (window.Alpine && typeof window.Alpine.initTree === 'function') {
                    window.Alpine.initTree(this.listContainer);
                }
            }

        } catch (error) {
            if (error.name === 'AbortError') return;
            console.error('List update failed:', error);
        } finally {
            this.setLoading(false);
        }
    }

    setLoading(isLoading) {
        if (this.listContainer) {
            this.listContainer.style.opacity = isLoading ? '0.5' : '1';
            this.listContainer.style.pointerEvents = isLoading ? 'none' : 'auto';
        }
    }
}
