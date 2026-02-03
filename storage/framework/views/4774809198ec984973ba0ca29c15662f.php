



<?php if(session('success')): ?>
    <div data-flash-status class="hidden"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('status')): ?>
    <div data-flash-status class="hidden"><?php echo e(session('status')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div data-flash-error class="hidden"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<?php if(session('login_success')): ?>
    <meta name="login-success" content="true">
<?php endif; ?>

<!-- Public Notification Modal (Toast Container) -->
<div id="public-notification-modal"
    class="fixed inset-0 z-[9999] hidden pointer-events-none">
    <div id="public-notification-content"
        class="w-full pointer-events-auto transition-all duration-300 ease-out opacity-0 -translate-y-3">
    </div>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/ui/toast-notifications.blade.php ENDPATH**/ ?>