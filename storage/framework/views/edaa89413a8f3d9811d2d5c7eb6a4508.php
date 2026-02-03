<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'header' => null,
    'footer' => null,
    'bodyClass' => '',
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
    'header' => null,
    'footer' => null,
    'bodyClass' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'bg-white border border-gray-200 rounded shadow-sm overflow-hidden'])); ?>>
    
    <?php if($header): ?>
        <div class="p-3 sm:p-4 border-b border-gray-100 bg-gray-50">
            <?php echo e($header); ?>

        </div>
    <?php endif; ?>

    
    <div class="<?php echo e($bodyClass); ?>">
        <?php echo e($slot); ?>

    </div>

    
    <?php if($footer): ?>
        <div class="px-4 py-3 sm:px-6 sm:py-4 bg-gray-50 border-t border-gray-200">
            <?php echo e($footer); ?>

        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/ui/card.blade.php ENDPATH**/ ?>