/**
 * DOM Utility Functions
 * Helper functions untuk manipulasi DOM
 */

// Query selector helpers
export function $(selector, parent = document) {
    return parent.querySelector(selector);
}

export function $$(selector, parent = document) {
    return Array.from(parent.querySelectorAll(selector));
}

// Element creation
export function createElement(tag, attributes = {}, children = []) {
    const element = document.createElement(tag);

    Object.entries(attributes).forEach(([key, value]) => {
        if (key === 'className') {
            element.className = value;
        } else if (key === 'dataset') {
            Object.entries(value).forEach(([dataKey, dataValue]) => {
                element.dataset[dataKey] = dataValue;
            });
        } else if (key.startsWith('on')) {
            element.addEventListener(key.slice(2).toLowerCase(), value);
        } else {
            element.setAttribute(key, value);
        }
    });

    children.forEach(child => {
        if (typeof child === 'string') {
            element.appendChild(document.createTextNode(child));
        } else if (child instanceof Node) {
            element.appendChild(child);
        }
    });

    return element;
}

// Class helpers
export function addClass(element, ...classes) {
    element.classList.add(...classes);
}

export function removeClass(element, ...classes) {
    element.classList.remove(...classes);
}

export function toggleClass(element, className) {
    element.classList.toggle(className);
}

export function hasClass(element, className) {
    return element.classList.contains(className);
}

// Show/Hide helpers
export function show(element, display = 'block') {
    if (!element) return;
    element.style.display = display;
    element.classList.remove('hidden');
}

export function hide(element) {
    if (!element) return;
    element.style.display = 'none';
    element.classList.add('hidden');
}

export function toggle(element, display = 'block') {
    if (!element) return;
    if (element.style.display === 'none' || element.classList.contains('hidden')) {
        show(element, display);
    } else {
        hide(element);
    }
}

// Get by ID shorthand
export function id(elementId) {
    return document.getElementById(elementId);
}
