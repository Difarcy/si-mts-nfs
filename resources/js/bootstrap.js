import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Core Utilities Integration
 */
import * as DOM from './core/dom';
import * as Events from './core/event';
import { api } from './core/fetch';
import { getCsrfToken } from './core/csrf';

// Global Assignment
window.DOM = DOM;
window.Events = Events;
window.api = api;
window.getCsrfToken = getCsrfToken;

// Shorthand for DOM
window.$ = DOM.$;
window.$$ = DOM.$$;

/**
 * CSRF Setup for Axios
 */
const token = getCsrfToken();
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}
