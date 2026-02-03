export function initFilePicker() {
    const roots = document.querySelectorAll('[data-component="file-picker"]');

    roots.forEach((root) => {
        if (root.dataset.filePickerInit === '1') return;
        root.dataset.filePickerInit = '1';

        const button = root.querySelector('[data-file-picker-button]');
        const input = root.querySelector('[data-file-picker-input]');
        const display = root.querySelector('[data-file-picker-display]');
        const clearBtn = root.querySelector('[data-file-picker-clear]');

        if (!button || !input || !display) return;

        button.addEventListener('click', () => {
            input.click();
        });

        display.addEventListener('click', () => {
            input.click();
        });

        input.addEventListener('change', () => {
            const files = Array.from(input.files || []);
            if (files.length > 0) {
                display.value = files.map((f) => f.name).join(', ');
                clearBtn?.classList.remove('hidden');
            } else {
                display.value = '';
                clearBtn?.classList.add('hidden');
            }
        });

        clearBtn?.addEventListener('click', () => {
            input.value = ''; // Reset file input
            display.value = ''; // Reset display text
            clearBtn.classList.add('hidden'); // Hide X button
            
            // Trigger change event manually so other listeners know it's cleared
            input.dispatchEvent(new Event('change'));
        });
    });
}

