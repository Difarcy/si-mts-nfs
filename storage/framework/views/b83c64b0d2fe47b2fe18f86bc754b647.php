<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => '',
    'id' => '',
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
    'name' => '',
    'id' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<select 
    <?php if($name): ?> name="<?php echo e($name); ?>" <?php endif; ?>
    <?php if($id): ?> id="<?php echo e($id); ?>" <?php endif; ?>
    autocomplete="off"
    <?php echo e($attributes->merge(['class' => 'border border-black rounded-lg px-3 py-1.5 sm:px-3 sm:py-1.5 text-[12px] sm:text-sm focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none bg-white transition-all text-slate-900 min-w-[100px] cursor-pointer'])); ?>

>
    <?php echo e($slot); ?>

</select>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/form/filter-sort.blade.php ENDPATH**/ ?>