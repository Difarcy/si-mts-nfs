import { id, addClass, removeClass, hasClass } from '../../core/dom';
import { ready, on } from '../../core/event';

ready(() => {
    const toggleBtn = id('mobile-menu-toggle');
    const sidebar = id('mobile-sidebar');
    const sidebarContent = id('sidebar-content');
    const overlay = id('sidebar-overlay');
    const closeBtn = id('close-sidebar');
    const dropdownToggles = document.querySelectorAll('.sidebar-dropdown-toggle');

    if (!toggleBtn || !sidebar || !sidebarContent) return;

    const openSidebar = () => {
        removeClass(sidebar, 'hidden');
        setTimeout(() => {
            // Posisi kanan: hapus translate-x-full (kembali ke 0)
            removeClass(sidebarContent, 'translate-x-full');
        }, 10);
    };

    const closeSidebar = () => {
        // Kembali ke kanan luar layar
        addClass(sidebarContent, 'translate-x-full');
        setTimeout(() => {
            addClass(sidebar, 'hidden');
        }, 300);
    };

    on(toggleBtn, 'click', (e) => {
        e.preventDefault();
        openSidebar();
    });

    if (closeBtn) on(closeBtn, 'click', closeSidebar);
    if (overlay) on(overlay, 'click', closeSidebar);

    // Dropdown/Accordion Logic
    dropdownToggles.forEach(toggle => {
        on(toggle, 'click', () => {
            const menu = toggle.nextElementSibling;
            const icon = toggle.querySelector('.sidebar-dropdown-icon');

            if (hasClass(menu, 'hidden')) {
                removeClass(menu, 'hidden');
                addClass(icon, 'rotate-180');
            } else {
                addClass(menu, 'hidden');
                removeClass(icon, 'rotate-180');
            }
        });
    });
});
