<header class="sticky top-0 z-40 bg-white border-b border-gray-200 px-3 sm:px-6 h-18 overflow-hidden">
    <div class="h-full flex flex-nowrap items-center justify-between gap-2">
        <div class="flex items-center gap-2 min-w-0">
            
            <button type="button" id="sidebar-toggle-btn"
                class="inline-flex items-center justify-center p-2 text-slate-900 hover:text-yellow-400 shrink-0 lg:hidden focus:outline-none transition-colors"
                aria-label="Buka menu sidebar" aria-controls="admin-sidebar" aria-expanded="false">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
            

            
            <div class="min-w-0 flex-1 sm:flex-initial">
                <p class="text-sm sm:text-lg font-bold tracking-tight text-slate-900 truncate">
                    <?php echo $__env->yieldContent('title', 'Admin'); ?>
                </p>
            </div>
        </div>

        <?php echo $__env->make('admin.components.layout.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</header>

<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/layout/header.blade.php ENDPATH**/ ?>