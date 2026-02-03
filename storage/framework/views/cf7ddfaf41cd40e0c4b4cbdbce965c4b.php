<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => '',
    'name' => '',
    'checked' => false,
    'value' => '1',
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
    'label' => '',
    'name' => '',
    'checked' => false,
    'value' => '1',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="flex items-start">
    <div class="flex items-center h-5">
        <input 
            id="<?php echo e($name); ?>" 
            name="<?php echo e($name); ?>" 
            type="checkbox" 
            value="<?php echo e($value); ?>"
            <?php echo e($checked ? 'checked' : ''); ?>

            <?php echo e($attributes->merge(['class' => 'w-3.5 h-3.5 sm:w-4 sm:h-4 border border-black rounded bg-gray-50 text-green-700 transition-all cursor-pointer focus:ring-0 focus:ring-offset-0'])); ?>

        >
    </div>
    <div class="ml-2 text-[11px] sm:text-sm">
        <label for="<?php echo e($name); ?>" class="font-normal text-gray-700 select-none cursor-pointer"><?php echo e($label); ?></label>
    </div>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/form/checkbox.blade.php ENDPATH**/ ?>