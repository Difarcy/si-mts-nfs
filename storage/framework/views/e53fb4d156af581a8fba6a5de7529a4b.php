

<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
    <h2 class="text-xl sm:text-2xl font-bold text-center text-green-800">LOGIN</h2>
    <p class="text-[11px] sm:text-sm text-center text-gray-500 mb-4 sm:mb-6">Silakan login untuk mengelola website.</p>

    <?php if($errors->any()): ?>
        <div
            class="bg-red-100 border border-red-400 text-red-700 px-3 sm:px-4 py-2 sm:py-3 rounded relative mb-3 sm:mb-4 text-[11px] sm:text-sm">
            <span class="block sm:inline"><?php echo e($errors->first()); ?></span>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('auth.authenticate')); ?>" method="POST" class="space-y-3 sm:space-y-4">
        <?php echo csrf_field(); ?>

        <div>
            <label for="username"
                class="block text-gray-700 text-[11px] sm:text-sm mb-1 sm:mb-2 font-semibold">Username</label>
            <input type="text" name="username" id="username"
                class="shadow appearance-none border rounded w-full py-1.5 sm:py-2 px-3 text-[12px] sm:text-base text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition-colors"
                required autofocus>
        </div>

        <div>
            <label for="password"
                class="block text-gray-700 text-[11px] sm:text-sm mb-1 sm:mb-2 font-semibold">Password</label>
            <input type="password" name="password" id="password"
                class="shadow appearance-none border rounded w-full py-1.5 sm:py-2 px-3 text-[12px] sm:text-base text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition-colors"
                required>
        </div>

        <div class="pt-2">
            <button type="submit"
                class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 sm:py-2.5 px-4 rounded focus:outline-none focus:shadow-outline w-full transition duration-300 text-[12px] sm:text-base">
                LOGIN
            </button>
        </div>
    </form>

    <div class="mt-3 sm:mt-4 text-center">
        <a href="/" class="text-[10px] sm:text-sm text-gray-500 hover:text-green-700 transition-colors">Kembali ke
            Website</a>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/auth/index.blade.php ENDPATH**/ ?>