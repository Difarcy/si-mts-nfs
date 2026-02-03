import { id, addClass, removeClass, show, hide } from '../../core/dom';
import { ready, on } from '../../core/event';

ready(() => {
    const toggleBtn = id('search-toggle-btn');
    const searchContainer = id('search-container');
    const navbarLinks = id('navbar-links');
    const searchIcon = id('search-icon');
    const closeIcon = id('close-icon');
    const searchInput = id('search-input');

    if (!toggleBtn || !searchContainer || !navbarLinks) {
        return;
    }

    let isSearchOpen = false;

    const openSearch = () => {
        isSearchOpen = true;
        addClass(navbarLinks, 'opacity-0', 'invisible');
        show(searchContainer, 'flex');
        hide(searchIcon);
        show(closeIcon, 'block');
        setTimeout(() => { if (searchInput) searchInput.focus(); }, 100);
    };

    const closeSearch = () => {
        isSearchOpen = false;
        hide(searchContainer);
        removeClass(navbarLinks, 'opacity-0', 'invisible');
        show(searchIcon, 'block');
        hide(closeIcon);
    };

    on(toggleBtn, 'click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        if (isSearchOpen) closeSearch();
        else openSearch();
    });

    // Close search when clicking outside
    on(document, 'click', (event) => {
        if (isSearchOpen && !toggleBtn.contains(event.target) && !searchContainer.contains(event.target)) {
            closeSearch();
        }
    });

    // Handle ESC key
    on(document, 'keydown', (e) => {
        if (e.key === 'Escape' && isSearchOpen) {
            closeSearch();
        }
    });
});
