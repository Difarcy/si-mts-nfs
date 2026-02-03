/**
 * Sidebar and UI Event Handler (SPA-Friendly with Delegation)
 */
export function initSidebarHandlers() {
    // We only need to attach these once to the document
    if (window.sidebarHandlersInitialized) return;

    // Handle Sidebar Toggles & Dropdowns via Event Delegation
    document.addEventListener('click', (e) => {
        const target = e.target;

        // 1. Sidebar Toggle Button (Open)
        const toggleBtn = target.closest('#sidebar-toggle-btn');
        if (toggleBtn) {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar && overlay) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                toggleBtn.setAttribute('aria-expanded', 'true');
            }
            return;
        }

        // 2. Close Sidebar (Overlay or Close Button)
        const isCloseAction = target.closest('#close-sidebar-btn') || target.closest('#sidebar-overlay');
        if (isCloseAction) {
            closeSidebar();
            return;
        }

        // 3. Dropdown Menu Toggles
        const dropTrigger = target.closest('[data-collapse-toggle]');
        if (dropTrigger) {
            const targetId = dropTrigger.getAttribute('data-collapse-toggle');
            const targetContent = document.getElementById(targetId);
            const arrow = dropTrigger.querySelector('[data-accordion-icon]');

            if (targetContent) {
                const isExpanded = dropTrigger.getAttribute('aria-expanded') === 'true';
                dropTrigger.setAttribute('aria-expanded', !isExpanded);
                targetContent.classList.toggle('hidden');
                if (arrow) arrow.classList.toggle('rotate-180');
            }
            return;
        }
    });

    // Close on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeSidebar();
    });

    function closeSidebar() {
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggleBtn = document.getElementById('sidebar-toggle-btn');
        if (sidebar) sidebar.classList.add('-translate-x-full');
        if (overlay) overlay.classList.add('hidden');
        if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
    }

    window.sidebarHandlersInitialized = true;
}

// Keep legacy export for compatibility if needed elsewhere
export function initSidebarToggle() { initSidebarHandlers(); }
export function initSidebarDropdown() { initSidebarHandlers(); }
