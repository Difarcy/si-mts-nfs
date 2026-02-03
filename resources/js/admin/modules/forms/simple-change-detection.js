/**
 * Simple Change Detection
 * Khusus untuk halaman pengaturan sederhana (Hero, Logo, Banner)
 * yang tidak memiliki status Draft/Publish kompleks.
 */

export class SimpleChangeDetection {
    constructor(form, options = {}) {
        this.form = form;
        this.submitBtn = document.querySelector(options.submitButtonSelector) || 
                         form.querySelector('button[type="submit"]');

        this.initialState = this.getFormState();
        
        this.init();
    }

    init() {
        if (!this.submitBtn) return;

        // Set initial button state
        this.updateButtonState();

        // Listen for changes
        this.form.addEventListener('input', () => this.scheduleUpdate());
        this.form.addEventListener('change', () => this.scheduleUpdate());
    }

    getFormState() {
        const formData = new FormData(this.form);
        const data = {};
        
        for (let [key, value] of formData.entries()) {
            // Ignore _token and other internal fields if needed
            if (key === '_token' || key === '_method') continue;
            
            // For files, we only care if they have content (name/size), not the file object itself for comparison
            if (value instanceof File) {
                if (value.name && value.size > 0) {
                    data[key] = `${value.name}-${value.size}`;
                } else {
                    data[key] = ''; // Empty file input
                }
            } else {
                data[key] = value;
            }
        }
        
        return JSON.stringify(data);
    }

    scheduleUpdate() {
        if (this.timer) clearTimeout(this.timer);
        this.timer = setTimeout(() => this.updateButtonState(), 100);
    }

    updateButtonState() {
        const currentState = this.getFormState();
        const hasChanges = currentState !== this.initialState;

        if (hasChanges) {
            this.submitBtn.disabled = false;
            this.submitBtn.classList.remove('cursor-not-allowed', 'opacity-50');
        } else {
            this.submitBtn.disabled = true;
            this.submitBtn.classList.add('cursor-not-allowed', 'opacity-50');
        }
    }

    reset() {
        this.initialState = this.getFormState();
        this.updateButtonState();
    }

}
