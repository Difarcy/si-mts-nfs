import { SimpleChangeDetection } from '../forms/simple-change-detection';

export function initProfileForms() {
    const forms = Array.from(document.querySelectorAll('form[id^="profile-"]'));
    if (forms.length === 0) return;

    forms.forEach((form) => {
        if (form.dataset.simpleChangeDetectionInit === '1') return;
        form.dataset.simpleChangeDetectionInit = '1';

        new SimpleChangeDetection(form, {
            submitButtonSelector: `[form="${form.id}"]`,
            confirmNavigation: false,
        });
    });
}
