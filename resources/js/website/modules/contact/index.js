import { api } from '../../../core/fetch';
import { on } from '../../../core/event';
import { $ } from '../../../core/dom';
import { showToast } from '../../ui/notifications';

/**
 * Handle Contact Form Interaction
 */
export function initContactForm() {
    const contactForm = $('#contact-form');
    if (!contactForm) return;

    // Handle form submit
    on(contactForm, 'submit', async (e) => {
        e.preventDefault();

        const submitBtn = contactForm.querySelector('button[type="submit"]') || contactForm.querySelector('button');
        if (!submitBtn) return;

        try {
            submitBtn.disabled = true;

            const formData = new FormData(contactForm);
            const url = contactForm.getAttribute('action') || window.location.href;

            const response = await api.postForm(url, formData);

            if (response.success) {
                showToast(response.message || 'Pesan Anda telah berhasil dikirim!', { type: 'success', duration: 3500 });
                contactForm.reset();
            } else {
                showToast('Gagal: ' + (response.message || 'Terjadi kesalahan'), { type: 'error', duration: 4500 });
            }

        } catch (error) {
            console.error('Submit Error:', error);

            if (error.status === 422 && error.data.errors) {
                const errors = error.data.errors;
                const first = Object.values(errors)[0]?.[0];
                showToast(first || 'Harap periksa kembali form.', { type: 'error', duration: 4500 });
            } else {
                showToast('Gagal: ' + (error.data?.message || error.message), { type: 'error', duration: 4500 });
            }
        } finally {
            submitBtn.disabled = false;
        }
    });
}
