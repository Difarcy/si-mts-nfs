/**
 * Fetch API Wrapper
 * Wrapper untuk Fetch API dengan CSRF token dan error handling
 */

import { getCsrfToken } from './csrf';

// Default options
const defaultOptions = {
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
};

// Helper untuk merge options
function mergeOptions(options = {}) {
    const token = getCsrfToken();
    const merged = {
        ...defaultOptions,
        ...options,
        headers: {
            ...defaultOptions.headers,
            ...(options.headers || {}),
            'X-CSRF-TOKEN': token
        }
    };
    return merged;
}

// GET request
export async function get(url, options = {}) {
    const response = await fetch(url, mergeOptions({
        ...options,
        method: 'GET'
    }));
    return handleResponse(response);
}

// POST request
export async function post(url, data = {}, options = {}) {
    const response = await fetch(url, mergeOptions({
        ...options,
        method: 'POST',
        body: JSON.stringify(data)
    }));
    return handleResponse(response);
}

// PUT request
export async function put(url, data = {}, options = {}) {
    const response = await fetch(url, mergeOptions({
        ...options,
        method: 'PUT',
        body: JSON.stringify(data)
    }));
    return handleResponse(response);
}

// DELETE request
export async function del(url, options = {}) {
    const response = await fetch(url, mergeOptions({
        ...options,
        method: 'DELETE'
    }));
    return handleResponse(response);
}

// Form data POST (untuk upload file)
export async function postForm(url, formData, options = {}) {
    const token = getCsrfToken();
    const response = await fetch(url, {
        ...options,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest',
            ...(options.headers || {})
        },
        body: formData
    });
    return handleResponse(response);
}

// Response handler
async function handleResponse(response) {
    const contentType = response.headers.get('content-type');
    const isJson = contentType && contentType.includes('application/json');

    const data = isJson ? await response.json() : await response.text();

    if (!response.ok) {
        const error = new Error(data.message || 'Request failed');
        error.status = response.status;
        error.data = data;
        throw error;
    }

    return data;
}

// Export as named 'api'
export const api = {
    get,
    post,
    put,
    delete: del,
    postForm
};

// Export sebagai default object
export default api;
