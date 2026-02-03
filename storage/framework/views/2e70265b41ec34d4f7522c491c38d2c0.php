<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['items' => []]));

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

foreach (array_filter((['items' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<nav aria-label="Breadcrumb" class="mb-2">
    <ol class="flex flex-wrap items-center gap-1 text-[9px] sm:text-[12px] text-black uppercase tracking-tight">
        
        <li>
            <a href="<?php echo e(route('web.home')); ?>" class="hover:text-green-700 transition-colors font-medium">BERANDA</a>
        </li>

        <?php if(count($items) > 0): ?>
            <li>
                <svg class="w-1.5 h-1.5 sm:w-2.5 sm:h-2.5 text-black shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </li>
        <?php endif; ?>

        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php ($isLast = $i === count($items) - 1); ?>
        <?php if(!empty($item['url']) && !$isLast): ?>
            <li>
                <a href="<?php echo e($item['url']); ?>"
                    class="hover:text-green-700 transition-colors font-medium"><?php echo e($item['label']); ?></a>
            </li>
        <?php else: ?>
            <li class="<?php echo e($isLast ? 'font-bold' : 'font-medium'); ?> truncate max-w-[120px] sm:max-w-none">
                <?php echo e($item['label']); ?>

            </li>
        <?php endif; ?>
        <?php if(!$isLast): ?>
            <li>
                <svg class="w-1.5 h-1.5 sm:w-2.5 sm:h-2.5 text-black shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </li>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
</nav><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/components/layout/breadcrumb.blade.php ENDPATH**/ ?>