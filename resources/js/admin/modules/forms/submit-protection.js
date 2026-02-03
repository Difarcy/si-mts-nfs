import { on } from '../../../core/event';

export const initSubmitProtection = () => {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        // Skip forms that already have custom submit handling or explicit skip attribute
        if (form.hasAttribute('data-no-submit-protection')) return;
        
        on(form, 'submit', (e) => {
            // Find submit button (supports button outside form with [form="..."])
            const submitBtn =
                (form.id ? document.querySelector(`button[type="submit"][form="${form.id}"]`) : null) ||
                form.querySelector('button[type="submit"]') ||
                (form.id ? document.querySelector(`button[form="${form.id}"]`) : null);
            
            if (submitBtn && !submitBtn.disabled) {
                // Add loading state
                const originalText = submitBtn.innerHTML;
                const loadingText = submitBtn.getAttribute('data-loading-text') || 'Memproses...';
                
                // Disable button to prevent double submit
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                
                // Optional: Change text if you want visual feedback immediately
                // submitBtn.innerHTML = `
                //     <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                //         <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                //         <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                //     </svg>
                //     ${loadingText}
                // `;

                // If the form submission is prevented elsewhere (e.g. validation error), 
                // we need to re-enable the button. This is tricky with standard form submission.
                // For standard synchronous submits, the page will reload so re-enabling isn't strictly necessary 
                // unless the user hits "Stop" or navigation fails.
                
                // For AJAX forms, the specific module should handle re-enabling.
                // This global handler is primarily for standard POST/PUT/DELETE forms.
                
                // Safety timeout: re-enable after 10 seconds in case something stuck
                setTimeout(() => {
                    if (submitBtn && document.body.contains(submitBtn)) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                        // submitBtn.innerHTML = originalText;
                    }
                }, 10000);
            }
        });
    });
};
