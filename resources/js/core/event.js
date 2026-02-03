/**
 * Event Handler Utilities
 * Helper functions untuk event handling
 */

// Event delegation
export function on(element, eventType, selector, handler) {
    if (typeof selector === 'function') {
        // Jika selector adalah function, langsung attach event
        handler = selector;
        element.addEventListener(eventType, handler);
        return () => element.removeEventListener(eventType, handler);
    }

    // Event delegation
    const delegationHandler = (event) => {
        const target = event.target.closest(selector);
        if (target && element.contains(target)) {
            handler.call(target, event);
        }
    };

    element.addEventListener(eventType, delegationHandler);
    return () => element.removeEventListener(eventType, delegationHandler);
}

// One-time event
export function once(element, eventType, handler) {
    const onceHandler = (event) => {
        handler.call(element, event);
        element.removeEventListener(eventType, onceHandler);
    };
    element.addEventListener(eventType, onceHandler);
}

// Emit custom event
export function emit(element, eventType, detail = {}) {
    const event = new CustomEvent(eventType, {
        bubbles: true,
        cancelable: true,
        detail
    });
    element.dispatchEvent(event);
}

// Debounce function
export function debounce(func, wait = 300) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Throttle function
export function throttle(func, limit = 300) {
    let inThrottle;
    return function executedFunction(...args) {
        if (!inThrottle) {
            func(...args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Click outside handler
export function onClickOutside(element, handler) {
    const outsideClickListener = (event) => {
        if (!element.contains(event.target)) {
            handler(event);
        }
    };
    document.addEventListener('click', outsideClickListener);
    return () => document.removeEventListener('click', outsideClickListener);
}

/**
 * Wait for DOM ready
 */
export function ready(callback) {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback);
    } else {
        callback();
    }
}
