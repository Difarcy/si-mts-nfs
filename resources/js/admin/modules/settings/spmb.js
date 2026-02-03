import { SimpleChangeDetection } from '../forms/simple-change-detection';

export function initSpmbPpdbSettings() {
    const form = document.getElementById('spmb-form');
    if (!form) return;

    const changeDetection = new SimpleChangeDetection(form, {
        submitButtonSelector: '[form="spmb-form"]',
        confirmNavigation: false
    });

    form.addEventListener('submit', () => {
        changeDetection.reset();
    }, true);
}
