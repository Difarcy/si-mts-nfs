import { $$ } from '../../core/dom';
import { ready, on, debounce } from '../../core/event';

function normalize(text) {
    return (text ?? '')
        .toString()
        .toLowerCase()
        .replace(/\s+/g, ' ')
        .trim();
}

ready(() => {
    const forms = $$('[data-website-search-form]');
    if (forms.length === 0) return;

    forms.forEach((form) => {
        const input = form.querySelector('[data-website-search-input]');
        if (!input) return;

        const emptyState = form.querySelector('[data-website-search-empty]');

        const scope = form.closest('[data-website-search-scope]') ?? document;
        const items = () => Array.from(scope.querySelectorAll('[data-website-search-item]'));

        const apply = () => {
            const query = normalize(input.value);
            const list = items();
            if (list.length === 0) return;

            let visibleCount = 0;

            list.forEach((el) => {
                const hay = normalize(el.getAttribute('data-search') || el.textContent);
                const match = query.length === 0 || hay.includes(query);
                el.style.display = match ? '' : 'none';
                if (match) visibleCount += 1;
            });

            if (emptyState) {
                const shouldShow = query.length > 0 && visibleCount === 0;
                emptyState.classList.toggle('hidden', !shouldShow);
            }
        };

        const debouncedApply = debounce(apply, 80);

        on(input, 'input', () => debouncedApply());
        on(form, 'submit', (e) => {
            e.preventDefault();
            apply();
        });

        apply();
    });
});
