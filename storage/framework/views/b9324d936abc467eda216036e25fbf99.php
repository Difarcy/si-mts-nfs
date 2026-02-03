<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'items' => null, // The paginator object
    'total' => 0,    
    'current' => 1,  
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'items' => null, // The paginator object
    'total' => 0,    
    'current' => 1,  
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $paginator = $items;
    $hasPaginator = $paginator instanceof \Illuminate\Pagination\LengthAwarePaginator || $paginator instanceof \Illuminate\Pagination\Paginator;
    $isLengthAware = $paginator instanceof \Illuminate\Pagination\LengthAwarePaginator;
    
    // Fallback data if no paginator provided
    $totalData = $hasPaginator && method_exists($paginator, 'total') ? $paginator->total() : $total;
    $currentPage = $hasPaginator ? $paginator->currentPage() : $current;
    $from = $hasPaginator && method_exists($paginator, 'firstItem') ? ($paginator->firstItem() ?? 0) : 0;
    $to = $hasPaginator && method_exists($paginator, 'lastItem') ? ($paginator->lastItem() ?? 0) : 0;

    $pageLinks = [];
    $lastPage = $isLengthAware ? $paginator->lastPage() : null;
    if ($isLengthAware && $lastPage > 1) {
        $window = 2;
        $left = max(1, $currentPage - $window);
        $right = min($lastPage, $currentPage + $window);

        $pageLinks[] = 1;

        if ($left > 2) {
            $pageLinks[] = '...';
        }

        for ($i = max(2, $left); $i <= min($lastPage - 1, $right); $i++) {
            $pageLinks[] = $i;
        }

        if ($right < $lastPage - 1) {
            $pageLinks[] = '...';
        }

        if ($lastPage > 1) {
            $pageLinks[] = $lastPage;
        }
    }
?>

<div <?php echo e($attributes->merge(['class' => 'flex items-center justify-between gap-2'])); ?>>
    
    <div>
        <p class="text-[10px] sm:text-xs text-black">
            Menampilkan <?php echo e($from); ?>–<?php echo e($to); ?> dari <?php echo e($totalData); ?> data
        </p>
    </div>

    <div class="flex gap-1 text-black items-center">
        <?php if($hasPaginator && !$paginator->onFirstPage()): ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>"
                class="px-2 py-1 sm:px-3 sm:py-1 border border-black rounded text-[10px] sm:text-xs text-black hover:bg-gray-100 transition-colors flex items-center gap-1 cursor-pointer">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span class="hidden sm:inline">Previous</span>
            </a>
        <?php else: ?>
            <span class="px-2 py-1 sm:px-3 sm:py-1 border border-gray-300 rounded text-[10px] sm:text-xs text-gray-400 flex items-center gap-1 cursor-not-allowed">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span class="hidden sm:inline">Previous</span>
            </span>
        <?php endif; ?>

        <?php if($isLengthAware && count($pageLinks) > 0): ?>
            <div class="hidden sm:flex items-center gap-1">
                <?php $__currentLoopData = $pageLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page === '...'): ?>
                        <span class="px-2 py-1 sm:px-3 sm:py-1 border border-gray-300 rounded text-[10px] sm:text-xs text-gray-400 cursor-default">…</span>
                    <?php elseif((int) $page === (int) $currentPage): ?>
                        <button type="button" class="px-2 py-1 sm:px-3 sm:py-1 border border-black rounded text-[10px] sm:text-xs bg-green-700 text-white font-bold cursor-default">
                            <?php echo e($currentPage); ?>

                        </button>
                    <?php else: ?>
                        <a href="<?php echo e($paginator->url($page)); ?>" class="px-2 py-1 sm:px-3 sm:py-1 border border-black rounded text-[10px] sm:text-xs text-black hover:bg-gray-100 transition-colors">
                            <?php echo e($page); ?>

                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <button type="button" class="sm:hidden px-2 py-1 border border-black rounded text-[10px] bg-green-700 text-white font-bold cursor-default">
                <?php echo e($currentPage); ?>

            </button>
        <?php else: ?>
            <button type="button" class="px-2 py-1 sm:px-3 sm:py-1 border border-black rounded text-[10px] sm:text-xs bg-green-700 text-white font-bold cursor-default">
                <?php echo e($currentPage); ?>

            </button>
        <?php endif; ?>

        <?php if($hasPaginator && $paginator->hasMorePages()): ?>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>"
                class="px-2 py-1 sm:px-3 sm:py-1 border border-black rounded text-[10px] sm:text-xs text-black hover:bg-gray-100 transition-colors flex items-center gap-1 cursor-pointer">
                <span class="hidden sm:inline">Next</span>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        <?php else: ?>
            <span class="px-2 py-1 sm:px-3 sm:py-1 border border-gray-300 rounded text-[10px] sm:text-xs text-gray-400 flex items-center gap-1 cursor-not-allowed">
                <span class="hidden sm:inline">Next</span>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </span>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/ui/pagination.blade.php ENDPATH**/ ?>