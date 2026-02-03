<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'items' => null,
    'paginationId' => null,
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
    'items' => null,
    'paginationId' => null,
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
    $from = $hasPaginator && method_exists($paginator, 'firstItem') ? ($paginator->firstItem() ?? 0) : 0;
    $to = $hasPaginator && method_exists($paginator, 'lastItem') ? ($paginator->lastItem() ?? 0) : 0;
    $total = $hasPaginator && method_exists($paginator, 'total') ? ($paginator->total() ?? 0) : 0;
?>

<div class="flex flex-wrap items-center justify-between gap-3 px-3 sm:px-4 py-2 border-b border-gray-200 bg-white sticky top-0 z-20">
    <div class="flex items-center">
        <div class="flex items-stretch h-8">
            <div class="master-checkbox px-2 rounded-l-sm cursor-pointer flex items-center justify-center relative hover:bg-gray-200 transition-colors" title="Pilih Semua">
                <div class="w-4 h-4 border-2 border-gray-500 rounded sm:w-4 sm:h-4 flex items-center justify-center bg-white relative">
                    <input type="checkbox" class="w-full h-full opacity-0 cursor-pointer absolute z-10">
                    <svg class="w-3 h-3 text-gray-600 hidden checked-icon pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                </div>
            </div>

            <div class="relative group h-full">
                <button type="button" id="master-dropdown-btn" class="px-1 h-full text-gray-600 rounded-r-sm hover:bg-gray-200 flex items-center justify-center transition-colors" title="Pilih Opsi">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </button>

                <div id="master-dropdown-menu" class="hidden absolute left-0 top-full mt-1 w-40 bg-white border border-gray-200 shadow-lg rounded-md z-30 py-1">
                    <?php echo e($dropdownItems ?? ''); ?>

                </div>
            </div>
        </div>

        <button type="button" onclick="window.location.reload()" class="p-2 text-gray-600 hover:bg-gray-100 rounded-full transition-colors" title="Refresh">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
        </button>

        <?php echo e($defaultActions ?? ''); ?>


        <div class="toolbar-bulk-actions hidden items-center gap-1">
            <?php echo e($bulkActions ?? ''); ?>

        </div>
    </div>

    <div id="<?php echo e($paginationId); ?>">
        <?php if($hasPaginator && $paginator->count() > 0): ?>
            <div class="flex items-center gap-4 text-xs font-medium text-gray-700">
                <span><?php echo e($from); ?>-<?php echo e($to); ?> dari <?php echo e($total); ?></span>
                <div class="flex items-center gap-1">
                    <?php if($paginator->onFirstPage()): ?>
                        <button type="button" disabled class="p-2 text-gray-300 cursor-not-allowed rounded-full hover:bg-gray-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                    <?php else: ?>
                        <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="p-2 text-black hover:bg-gray-100 rounded-full transition-colors" title="Sebelumnya">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </a>
                    <?php endif; ?>

                    <?php if($paginator->hasMorePages()): ?>
                        <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="p-2 text-black hover:bg-gray-100 rounded-full transition-colors" title="Selanjutnya">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    <?php else: ?>
                        <button type="button" disabled class="p-2 text-gray-300 cursor-not-allowed rounded-full hover:bg-gray-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/interaction/list-toolbar.blade.php ENDPATH**/ ?>