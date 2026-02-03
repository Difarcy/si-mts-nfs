/**
 * Logout Handler (SPA-Friendly with Delegation)
 */
import { openConfirm } from '../ui/notifications';

export function initLogoutHandler() {
    if (window.logoutHandlerInitialized) return;

    document.addEventListener('click', (e) => {
        const logoutBtn = e.target.closest('#btn-logout-trigger');
        if (!logoutBtn) return;

        e.preventDefault();
        const logoutForm = document.getElementById('logout-form');

        if (!logoutForm) return;

        openConfirm({
            title: 'Konfirmasi Keluar',
            message: 'Apakah Anda yakin ingin keluar?',
            okText: 'Keluar',
            cancelText: 'Batal',
            variant: 'danger',
        }).then((confirmed) => {
            if (!confirmed) return;
            localStorage.removeItem('admin_view_type');
            logoutForm.submit();
        });
    });

    window.logoutHandlerInitialized = true;
}
