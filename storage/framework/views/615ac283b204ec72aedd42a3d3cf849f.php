

<?php if(session('success')): ?>
    <div data-flash-status class="hidden"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('status')): ?>
    <div data-flash-status class="hidden"><?php echo e(session('status')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div data-flash-error class="hidden"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<div id="public-notification-modal" class="fixed inset-0 z-[9999] hidden pointer-events-none">
    <div id="public-notification-content" class="w-full pointer-events-auto transition-all duration-300 ease-out opacity-0 -translate-y-3"></div>
</div>

<div id="action-confirm-modal" class="hidden fixed inset-0 z-[9999] items-center justify-center bg-transparent">
    <div class="bg-white shadow-xl max-w-md w-full mx-4 rounded-lg transform transition-all">
        <div class="p-6">
            <h3 id="action-confirm-title" class="text-lg font-semibold text-slate-900 mb-2">Konfirmasi</h3>
            <p id="action-confirm-message" class="text-sm text-slate-600 mb-6"></p>
            <div class="flex items-center justify-end gap-3">
                <button type="button" id="action-confirm-cancel-btn"
                    class="px-4 py-1.5 text-sm font-semibold text-gray-700 bg-gray-200 hover:bg-gray-300 transition-colors min-w-25 rounded">
                    Batal
                </button>
                <button type="button" id="action-confirm-ok-btn"
                    class="px-4 py-1.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 transition-colors min-w-25 rounded">
                    Ya
                </button>
            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/ui/notifications.blade.php ENDPATH**/ ?>